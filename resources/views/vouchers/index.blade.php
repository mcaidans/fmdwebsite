@extends('master')

@section('content')

<div class="row responsive-center">
    @if(!empty($vouchers))
        <!-- MANUAL CHANGE DELETE -->
        <div class="col-sm-6 col-lg-4 col-xl-3">
                <div class="card" style=";margin-right:15px;padding:5px;">
                    <a href="#voucher{{$t->id}}" role="button" data-toggle="modal">
                        <img class="card-img-top" class="img-fluid" src="../storage/app/{{ $t->image_location }}" alt='{{$t->name}}'>
                    </a>
                    <div class="card-body text-center">
                        <button type="button" class="btn greencode" data-toggle="modal" data-target="#voucher{{$t->id}}">Open Voucher</button>
                    </div>
                </div>
            </div>
            
            <div class="modal fade" id="voucher{{$t->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <!-- <h5 class="modal-title" id="exampleModalLabel">{{ $t->name }}</h5> -->
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <img src="../storage/app/{{ $t->image_location }}" class="img-fluid" alt='{{$t->name}}'>
                        </div>
                        <div class="modal-footer">
                            @if (Auth::check() && (Auth::user()->admin))
                                <form style="margin-bottom:0px;" method="POST" action="{{ action('VoucherController@destroy', $t->id ) }}">
                                    @csrf
                                    @method("DELETE")
                                    <input type="submit" class="btn btn-danger" href="{{ route('vouchers.destroy', $t->id) }}" value="Delete">
                                </form>
                                <a class="btn btn-warning" href="#">Edit</a>
                            @else                    
                                <button type="button" class="btn btn-primary">Redeem</button>
                            @endif
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        
        
        <!-- END CHANGE DELETE -->
        
        @foreach($vouchers as $voucher) 
            <div class="col-sm-6 col-lg-4 col-xl-3">
                <div class="card" style=";margin-right:15px;padding:5px;">
                    <a href="#voucher{{$voucher->id}}" role="button" data-toggle="modal">
                        <img class="card-img-top" class="img-fluid" src="../storage/app/{{ $voucher->image_location }}" alt='{{$voucher->name}}'>
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
                            <img src="../storage/app/{{ $voucher->image_location }}" class="img-fluid" alt='{{$voucher->name}}'>
                        </div>
                        <div class="modal-footer">
                            @if (Auth::check() && (Auth::user()->admin))
                                <form style="margin-bottom:0px;" method="POST" action="{{ action('VoucherController@destroy', $voucher->id ) }}">
                                    @csrf
                                    @method("DELETE")
                                    <input type="submit" class="btn btn-danger" href="{{ route('vouchers.destroy', $voucher->id) }}" value="Delete">
                                </form>
                                <a class="btn btn-warning" href="#">Edit</a>
                            @else                    
                                <button type="button" class="btn btn-primary">Redeem</button>
                            @endif
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>

<?php 

/*
    <div class="row">
        @if(!empty($vouchers))
            @foreach($vouchers as $voucher)            
                <div class="card" style="width:200px;margin-right:15px;">
                    <img class="card-img-top" src="../storage/app/{{ $voucher->image_location }}" alt='{{$voucher->name}}'>
                    <div class="card-body">
                        {{ $voucher }}
                    </div>
                </div>
            @endforeach
        
        @else
            <p>No Vouchers</p>
        @endif
    </div>
*/ ?>
@stop


