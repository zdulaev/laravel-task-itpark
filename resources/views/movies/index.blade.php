@extends('layouts.app')

@section('title'){{'Фильмы'}}@endsection
@section('h1'){{'Фильмы'}}@endsection

@section('content')


<div class="album py-5 bg-light">
    <div class="container">
        <a href="{{ route('movies.create') }}" class="btn btn-primary mb-3">Add movie</a>
        @if (count($data))
        {{ $data->links() }}

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mb-3">

            @foreach ($data as $elem)
            <div class="col">
                <div class="card shadow-sm">
                    <img class="card-img-top" src="{{ '/images/news/thumbnail/'.$elem->img }}">
                    <div class="card-body">
                        <p class="card-text">{{$elem->name}}</p>
                        @if (count($elem->genres))
                        <ul>
                            @foreach ($elem->genres as $genre)
                                <li>{{$genre->name}}</li>
                            @endforeach
                        </ul>
                        @endif
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <a href="{{ route('movies.show', $elem->id) }}" class="btn btn-light">View</a>
                                <a href="{{ route('movies.edit', $elem->id) }}" class="btn btn-light">Edit</a>
                                <form class="d-inline-block" method="post" action="{{ route('movies.destroy', $elem->id) }}">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>

        {{ $data->links() }}
        @else
        no data
        @endif
    </div>
</div>


@endsection
