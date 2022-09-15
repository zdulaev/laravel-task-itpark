@extends('layouts.app')

@section('title'){{'Жанры'}}@endsection
@section('h1'){{'Жанры'}}@endsection

@section('content')


<div class="album py-5 bg-light">
    <div class="container">
        <a href="{{ route('genre-add') }}" class="btn btn-primary mb-3">Add genre</a>
        @if (count($data))

        <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 g-3 mb-3">

            @foreach ($data as $elem)
            <div class="col">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <p class="card-text">{{$elem->name}}</p>

                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <a href="{{ route('genre-update', $elem->id) }}" class="btn btn-light">Edit</a>
                                <a href="{{ route('genre-destroy', $elem->id) }}" class="btn btn-danger">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>

        @else
        no data
        @endif
    </div>
</div>


@endsection
