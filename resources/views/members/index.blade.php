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
            <h4>Group: {{ $user->group->name }}</h4>
            <h4>Active: @if($user->active == 1) Yes @else No @endif</h4>

        </div>
    </div>
@endsection