@extends('master')


@section('content')
    <h1>Edit</h1>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <img src="../storage/app/{{ $voucher->image_location }}" class="img-fluid" alt='{{$voucher->name}}'>
    <form method="POST" action="{{ action('VoucherController@update', $voucher->id ) }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name"> 
            <div class="btn btn-default btn-file">
                Upload Image <input type="file" name="image">
            </div>
        <div>
        <input type="submit" value="Submit">
        </div>
        </div>
    </form>

@endsection


