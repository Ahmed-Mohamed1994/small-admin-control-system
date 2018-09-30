@extends('layouts.master')

@section('title')
    Register
@endsection

@section('content')
    @include('includes.message-block')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h3>Register Member</h3>
            <form action="{{ route('storeMember') }}" method="post" enctype="multipart/form-data">
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="email">Member Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ request()->old('name') }}">
                </div>

                <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                    <label for="email">Member Phone</label>
                    <input type="text" class="form-control" name="phone" id="phone" value="{{ request()->old('phone') }}">
                </div>

                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label for="email">Member Email</label>
                    <input type="text" class="form-control" name="email" id="email" value="{{ request()->old('email') }}">
                </div>

                <div class="form-group {{ $errors->has('group') ? 'has-error' : '' }}">
                    <label for="group">Select Group:</label>
                    <select class="form-control" name="group" id="group">
                        <option value="" selected>Select Member Group</option>
                        @foreach($groups as $group)
                            <option value="{{ $group->id }}" @if(request()->old('group') == $group->id)selected @endif>
                                {{ $group->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="image">Member Image</label>
                    <input type="file" name="image" class="form-control" id="image">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                {{ csrf_field() }}
            </form>
        </div>
    </div>
@endsection