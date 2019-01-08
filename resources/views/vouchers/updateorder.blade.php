@extends('master')

@section('content')
<style>
    #sortable{ list-style-type: none; margin: 0; padding: 0 0 2.5em; float: left; margin-right: 10px; width:100%}
    #sortable li { padding: 5px; font-size: 1.2em; }
</style>
     <ul id="sortable" class="connectedSortable row responsive-center">
        @if(!empty($vouchers))
           
                @foreach($vouchers as $voucher) 
                <li class="col-sm-6 col-lg-4 col-xl-1" id="{{$voucher->id}}">
                        <div class="card" style="margin-right:15px;padding:5px;">
                            <img class="card-img-top" class="img-fluid" src="{{url('storage/' . $voucher->image_location)}}" alt='{{$voucher->name}}'>
                        </div>
                </li>
                @endforeach
        @endif
        </ul>
        
        <input type="submit" value="saveOrder" onclick="saveOrder()">

                                    
    <script>
        $( function() {
            $( "#sortable" ).sortable();
            $( "#sortable" ).disableSelection();
        });
        
        function saveOrder(voucher_id, user_id){
            var orderArray = $("#sortable").sortable("toArray");
            var jsonData = orderArray; //JSON.stringify(orderArray);
            $.ajax({
                method: 'POST',
                url: 'saveOrder',
                data: {'orderArray': jsonData},
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(response){
                    console.log(response);

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(JSON.stringify(jqXHR));
                    console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                }
            });
        }
    </script>
@stop


