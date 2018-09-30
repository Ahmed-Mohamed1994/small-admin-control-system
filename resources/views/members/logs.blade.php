@extends('layouts.master')

@section('title')
    Logs
@endsection

@section('style')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
@endsection

@section('content')
    @include('includes.message-block')
    <section class="row">
        <div class="col-md-12">
            <header><h3>All Member Logs</h3></header>


            <table id="myTable" class="display">
                <thead>
                <tr>
                    <th>name</th>
                    <th>phone</th>
                    <th>Created At</th>
                    <th>Update Account</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach($logs as $log)
                    <tr>
                        <td>{{ $log->name }}</td>
                        <td>{{ $log->phone }}</td>
                        <td>{{ $log->created_at }}</td>
                        <th><a href="{{ route('updateLog',['log'=>$log->id]) }}" class="btn btn-primary">Update to this</a></th>
                        <th><a href="{{ route('deleteLog',['log'=>$log->id]) }}" class="btn btn-danger">Delete this</a></th>
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