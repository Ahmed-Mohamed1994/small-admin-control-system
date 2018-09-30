@extends('layouts.master')

@section('title')
    Register
@endsection

@section('content')
    @include('includes.message-block')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h3>Register</h3>
            <form action="{{ route('storeUser') }}" method="post" enctype="multipart/form-data">
                <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
                    <label for="email">Your Name</label>
                    <input type="text" class="form-control" name="username" id="username" value="{{ request()->old('username') }}">
                </div>

                <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                    <label for="email">Your Phone</label>
                    <input type="text" class="form-control" name="phone" id="phone" value="{{ request()->old('phone') }}">
                </div>

                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label for="email">Your Email</label>
                    <input type="text" class="form-control" name="email" id="email" value="{{ request()->old('email') }}">
                </div>

                <div class="form-group {{ $errors->has('nationality') ? 'has-error' : '' }}">
                    <label for="nationality">Select list:</label>
                    <select class="form-control" name="nationality" id="nationality">
                        <option value="" selected>Select Your Country</option>
                        @foreach($countries as $country)
                            <option value="{{ $country }}" @if(request()->old('nationality') == $country)selected @endif>
                                {{ $country }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                    <label for="password">Your Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>

                <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                    <label for="password_confirmation">Confirm Password</label>
                    <input class="form-control" type="password" name="password_confirmation" id="password_confirmation">
                </div>

                <div class="form-group {{ $errors->has('birthDate') ? 'has-error' : '' }}">
                    <label for="birthDate">Your Birth Day</label>
                    <input type="date" class="form-control" name="birthDate" id="birthDate" value="{{ request()->old('email') }}">
                </div>

                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" class="form-control" id="image">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                {{ csrf_field() }}
            </form>
        </div>
    </div>
@endsection