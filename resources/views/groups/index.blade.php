@extends('layouts.master')

@section('title')
    Groups
@endsection

@section('style')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
@endsection

@section('content')
    @include('includes.message-block')
    <section class="row">
        <div class="col-md-12">
            <header><h3>All Groups</h3></header>


            <table id="myTable" class="display">
                <thead>
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>Pages</th>
                    <th>Assign</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach($groups as $group)
                    <tr>
                        <td>{{ $group->id }}</td>
                        <td>{{ $group->name }}</td>
                        <td>
                            <ul>
                                @foreach($group->pages as $page_name)
                                    <li>{{ $page_name->name }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <th><a href="{{ route('assignGroup',['group'=>$group->id]) }}" class="btn btn-info">Assign</a>
                        </th>
                        <th><a href="{{ route('editGroup',['group'=>$group->id]) }}" class="btn btn-primary">Edit</a>
                        </th>
                        <th><a href="{{ route('deleteGroup',['group'=>$group->id]) }}" class="btn btn-danger">Delete</a>
                        </th>
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