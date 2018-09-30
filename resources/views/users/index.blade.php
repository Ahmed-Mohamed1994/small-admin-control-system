@extends('layouts.master')

@section('title')
    Profile
@endsection

@section('content')
    @include('includes.message-block')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <img src="{{ Storage::url($user->image) }}" alt="{{ $user->name }}" class="img-responsive">
            <h2>Name: {{ $user->name }}</h2>
            <h4>Phone: {{ $user->phone }}</h4>
            <h4>Email: {{ $user->email }}</h4>
            <h4>Nationality: {{ $user->nationality }}</h4>
            <h4>Birth Day: {{ $user->birthDate }}</h4>
            <h4>Active: @if($user->active == 1) Yes @else No @endif</h4>

            <a href="{{ route('suspendUser',['user' => $user->id]) }}" class="btn btn-info">Suspend My Account</a>
            <a href="{{ route('deleteUser',['user' => $user->id]) }}" class="btn btn-danger">Delete My Account</a>
        </div>
    </div>
@endsection