@extends('layouts.master')

@section('title')
    Users
@endsection

@section('style')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
@endsection

@section('content')
    @include('includes.message-block')
    <section class="row">
        <div class="col-md-12">
            <header><h3>All Users</h3></header>


            <table id="myTable" class="display">
                <thead>
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>email</th>
                    <th>phone</th>
                    <th>nationality</th>
                    <th>birthDate</th>
                    <th>Deleted</th>
                    <th>Suspend</th>
                    <th>Restore</th>
                    <th>Force Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->nationality }}</td>
                        <td>{{ $user->birthDate }}</td>
                        <td>@if($user->deleted_at != null) True @else False @endif</td>
                        <th><a href="{{ route('adminSuspendUser',['user'=>$user->id]) }}" class="btn btn-default">
                                @if($user->active == true) Suspend @else Cancel @endif
                            </a></th>
                        <th><a href="{{ route('restoreUser',['user'=>$user->id]) }}" class="btn btn-primary">Restore</a></th>
                        <th><a href="{{ route('forceDeleteUser',['user'=>$user->id]) }}" class="btn btn-danger">Delete</a></th>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </section>


@endsection

@section('script')
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="application/javascript">
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>
@endsection