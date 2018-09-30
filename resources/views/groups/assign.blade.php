@extends('layouts.master')

@section('title')
    Assign Group
@endsection

@section('content')
    @include('includes.message-block')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h3>Assign Group ({{ $group->name }})</h3>
            <form action="{{ route('storeAssignGroup',['group' => $group->id]) }}" method="post">
                @foreach($pages as $page)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="checked_pages[]" value="{{ $page->id }}" id="defaultCheck{{ $page->id }}">
                        <label class="form-check-label" for="defaultCheck{{ $page->id }}">
                            {{ $page->name }}
                        </label>
                    </div>
                @endforeach

                <button type="submit" class="btn btn-primary">Submit</button>
                {{ csrf_field() }}
            </form>
        </div>
    </div>
@endsection