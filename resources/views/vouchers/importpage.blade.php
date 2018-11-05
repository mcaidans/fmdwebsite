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

    <form method="POST" action="{{ action('VoucherController@import') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <div class="btn btn-default btn-file">
                Upload Images <input required type="file" name="images[]" multiple>
            </div>
        <div>
        <input type="submit" value="Submit">
        </div>
        </div>
    </form>

@endsection


