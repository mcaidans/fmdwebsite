@extends('master')


@section('content')
    <h1>Create</h1>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <form method="POST" action="{{ action('VoucherController@store') }}" enctype="multipart/form-data">
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


