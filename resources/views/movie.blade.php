@extends('layouts.app')

@section('title'){{'Фильм #'}} {{$data->id}}@endsection
@section('h1'){{'Фильм #'}} {{$data->id}}@endsection

@section('content')



<div class="album py-5 bg-light">
    <div class="container">

        <div class="p-5 mb-4 bg-light rounded-3">
            <div class="container-fluid py-5">
                <h1 class="display-5 fw-bold">{{$data->name}}</h1>
                @if (count($data->genres))
                Жанры:
                <ul>
                    @foreach ($data->genres as $genres)
                        <li>{{$genres->name}}</li>
                    @endforeach
                </ul>
                @endif
                <p class="col-md-8 fs-4">Creared at: {{$data->updated_at}}</p>
                <img class="card-img-top mb-3" src="{{ '/images/news/thumbnail/'.$data->img }}">
                <a href="{{ route('movies') }}" class="btn btn-light">Go back</a>
                <a href="{{ route('movie-update', $data->id) }}" class="btn btn-light">Edit</a>
                <a href="{{ route('movie-destroy', $data->id) }}" class="btn btn-danger">Delete</a>
            </div>
        </div>

    </div>
</div>


@endsection
