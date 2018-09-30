@extends('layouts.master')

@section('title')
    Page Create
@endsection

@section('content')
    @include('includes.message-block')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h3>Page Create</h3>
            <form action="{{ route('storePage') }}" method="post">
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="name">Page Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ request()->old('name') }}">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                {{ csrf_field() }}
            </form>
        </div>
    </div>
@endsection