@extends('master')

@section('content')

<h2>Meal Deals</h2>
<div class="row responsive-center">
@for ($i = 0; $i < 7; $i++)
    <div class="col-sm-4 col-lg-3 col-xl-2">
        <div class="card" style=";margin-right:15px;padding:5px;">
            <a href="#exampleModal" role="button" data-toggle="modal">
                <img class="card-img-top" class="img-fluid" src="../storage/app/{{ $vouchers[0]->image_location }}" alt='{{$vouchers[0]->name}}'>
            </a>
            <div class="card-body text-center">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                  Open Voucher
                </button>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ $vouchers[0]->name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="../storage/app/{{ $vouchers[0]->image_location }}" class="img-fluid" alt='{{$vouchers[0]->name}}'>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Redeem</button>
                </div>
            </div>
        </div>
    </div>
@endfor
</div>

<h2 style="margin-top:20px;">Local Service Discounts</h2>
<div class="row responsive-center">
@for ($i = 0; $i < 7; $i++)
    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
        <div class="card" style=";margin-right:15px;padding:5px;">
            <a href="#exampleModal" role="button" data-toggle="modal">
                <img class="card-img-top" class="img-fluid" src="../storage/app/{{ $vouchers[0]->image_location }}" alt='{{$vouchers[0]->name}}'>
            </a>
            <div class="card-body text-center">
                <button type="button" class="btn greencode" data-toggle="modal" data-target="#exampleModal">
                  Open Voucher
                </button>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">test</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="../storage/app/{{ $vouchers[0]->image_location }}" class="img-fluid" alt='{{$vouchers[0]->name}}'>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Redeem</button>
                </div>
            </div>
        </div>
    </div>
@endfor
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


