@extends('layouts.master')

@section('title')
    Group Update
@endsection

@section('content')
    @include('includes.message-block')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h3>Group Update</h3>
            <form action="{{ route('updateGroup',['group' => $group->id]) }}" method="post">
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="name">Group Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ $group->name }}">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                {{ csrf_field() }}
            </form>
        </div>
    </div>
@endsection