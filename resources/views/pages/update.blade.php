@extends('layouts.master')

@section('title')
    Page Update
@endsection

@section('content')
    @include('includes.message-block')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h3>Page Update</h3>
            <form action="{{ route('updatePage',['page' => $page->id]) }}" method="post">
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="name">Page Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ $page->name }}">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                {{ csrf_field() }}
            </form>
        </div>
    </div>
@endsection