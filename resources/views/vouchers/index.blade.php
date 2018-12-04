@extends('master')

@section('content')

    <div class="row responsive-center">
        @if(!empty($vouchers))
            
<<<<<<< HEAD
            @foreach($vouchers as $voucher) 
                <div class="col-sm-6 col-lg-4 col-xl-3">
                    <div class="card" style=";margin-right:15px;padding:5px;">
                        <a href="#voucher{{$voucher->id}}" role="button" data-toggle="modal">
                            <img class="card-img-top" class="img-fluid" src="{{url('storage/' . $voucher->image_location)}}" alt='{{$voucher->name}}'>
                        </a>
                        <div class="card-body text-center">
                            <button type="button" class="btn greencode" data-toggle="modal" data-target="#voucher{{$voucher->id}}">Open Voucher</button>
=======
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
                            <img src="../storage/app/{{ $voucher->image_location }}" class="img-fluid" alt='{{$voucher->name}}'
                            @if ($voucher->isRedeemed)
                                style="opacity:0.4;"
                            @endif
                            >
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
                                <form style="margin-bottom:0px;" method="POST" action="{{ action('VoucherController@redeem') }}" enctype="multipart/form-data">
                                @csrf
                                    <input name="voucher_id" type="hidden" value="{{$voucher->id}}">
                                    <input name="user_id" type="hidden" value="{{ Auth::user()->id }}">
                                    
                                    <input type="submit" class="btn greencode" value="Redeem"
                                    @if ($voucher->isRedeemed)
                                        disabled
                                    @endif>
                                </form>
                            @else
                                <p>Must be logged in to redeem</p>
                            @endif
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
>>>>>>> prod
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
                                <img src="{{url('storage/' . $voucher->image_location)}}" class="img-fluid" alt='{{$voucher->name}}'>
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
                                    <button class="btn greencode" onclick="ajaxRedeem({{$voucher->id}}, {{ Auth::user()->id }})">Redeem</button>
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

    <script>
        function ajaxRedeem(voucher_id, user_id){
            $.ajax({
                method: 'POST',
                url: 'vouchers/redeem',
                data: {'voucher_id' : voucher_id, 'user_id' : user_id},
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(response){
                    //console.log(response);
                    
                    var date = new Date();
                    var day = date.getDate();
                    var month = date.getMonth() + 1;
                    var year = date.getFullYear();
                    var minute = date.getMinutes();
                    if(minute < 10)
                        minute = "0" + minute;
                    var hour = date.getHours();
                    if(hour < 10)
                        hour = "0" + hour;

                    console.log("Voucher Redeemed at " + hour + ":" + minute + " on " + day + "/" + month + "/" + year);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(JSON.stringify(jqXHR));
                    console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                }
            });
        }
    </script>
@stop


