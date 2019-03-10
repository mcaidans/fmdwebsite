@extends('master')

@section('content')

    <div class="row responsive-center">
        @if(!empty($vouchers))
            @foreach($vouchers as $voucher) 
                <div class="col-sm-6 col-lg-4 col-xl-3">
                    <div class="card" style=";margin-right:15px;padding:5px;">
                        <a href="#voucher{{$voucher->id}}" role="button" data-toggle="modal">
                            <img class="card-img-top" class="img-fluid" src="{{url('storage/' . $voucher->image_location)}}" alt='{{$voucher->name}}'>
                        </a>
                        <div class="card-body text-center">
                            <button type="button" class="btn greencode" data-toggle="modal" data-target="#voucher{{$voucher->id}}">Open Voucher</button>
                        </div>
                    </div>
                </div>
                
                <div class="modal fade" id="voucher{{$voucher->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <!-- <h5 class="modal-title" id="exampleModalLabel">{{ $voucher->name }}</h5> -->
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <img  id="modal_image_{{$voucher->id}}" src="{{url('storage/' . $voucher->image_location)}}" class="img-fluid" alt='{{$voucher->name}}'
                                    @if ($voucher->isRedeemed)
                                        style="opacity:0.4;"
                                    @endif
                                >
                                @if ($voucher->isRedeemed)
                                    <div class="redeem-overlay redeem-overlay-previous">
                                        <p class="redeem-text">Voucher Redeemed Already</p>   
                                        
                                        <p>Voucher available again after <span style="font-weight:500">{{$voucher->redeemAvailable}}</span></p>
                                    </div>
                                @else
                                <div id="redeem-current-{{$voucher->id}}" class="redeem-overlay redeem-overlay-current" style="display:none">
                                    <p class="redeem-text">Voucher Redeemed!</p>
                                    <span class="fas fa-check-circle fa-3x check-circle"></span>
                                    <p>Voucher redeemed at <span id="redeem-current-time-{{$voucher->id}}" style="font-weight:500"></span></p>
                                    <p style="font-style:italic;margin-bottom:0px;">Voucher next available: <span id="redeem-next-time-{{$voucher->id}}"></span></p>
                                </div>
                                @endif
                            </div>
                            
                            <div class="modal-footer">
                                @if (Auth::check() && (Auth::user()->admin))
                                    <form style="margin-bottom:0px;" method="POST" action="{{ action('VoucherController@destroy', $voucher->id ) }}">
                                        @csrf
                                        @method("DELETE")
                                        <input type="submit" class="btn btn-danger" href="{{ route('vouchers.destroy', $voucher->id) }}" value="Delete">
                                    </form>
                                    <a class="btn btn-warning" href="{{ route('vouchers.edit', $voucher->id) }}">Edit</a>
                                @elseif(Auth::check())
                                    @if (empty($voucher->link))
                                        <button id="redeem_btn_{{$voucher->id}}" class="btn greencode" onclick="ajaxRedeem({{$voucher->id}}, {{ Auth::user()->id }})"
                                        @if ($voucher->isRedeemed)
                                            disabled
                                        @endif>
                                        Redeem</button>
                                    @else
                                        <button class="btn greencode" onclick="location.href='http://{{$voucher->link}}'" type="button">
                                             Visit Websit
                                        </button>
                                    @endif
                                @else
                                    <p>Must be logged in to redeem</p>
                                @endif
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            
        @endif
    </div>
    <div class="text-center">
                {{ $vouchers->links() }}
            </div>

    <script>
    $(document).ready(function () {
        $(".pagination").rPage();
    });

    function currentRedeem(voucher_id, user_id, times){
        $("#redeem-current-" + voucher_id).css("display", "inline");
        $("#redeem_btn_" + voucher_id).attr("disabled", "disabled");// + voucher_id).hide();
        $("#modal_image_" + voucher_id).css("opacity", "0.4");
        $("#redeem-current-time-" + voucher_id).html(times['dateRedeemed']);
        $("#redeem-next-time-" + voucher_id).html(times['dateAvailable']);
    }
        function ajaxRedeem(voucher_id, user_id){
            $.ajax({
                method: 'POST',
                url: 'vouchers/redeem',
                data: {'voucher_id' : voucher_id, 'user_id' : user_id},
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(response){
                    //console.log(response['dateRedeemed']);
                    currentRedeem(voucher_id, user_id, response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(JSON.stringify(jqXHR));
                    console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                }
            });
        }
    </script>
@stop


