@extends('layouts.app')

@section('title'){{'Фильм #'}} {{$data->id}}@endsection
@section('h1'){{'Фильм #'}} {{$data->id}}@endsection

@section('content')

<div class="album py-5 bg-light">
    <div class="container">

        <form class="row g-3 needs-validation" method="post" action="{{ route('movies.update', $data->id) }}" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <div class="col-12">
                <label class="form-label" for="validationCustom01">Название</label> 
                <input class="form-control" id="validationCustom01" name="name" required="" type="text" value="{{$data->name}}">
                <div class="valid-feedback">
                    Все хорошо!
                </div>
            </div>
            <div class="col-12">
                Жанры: 
                @if (count($data->genres))
                    @foreach ($data->genres as $genre)
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault{{$genre->id}}" name="genres[{{$genre->id}}]" checked>
                            <label class="form-check-label" for="flexSwitchCheckDefault{{$genre->id}}">{{$genre->name}}</label>
                        </div>
                    @endforeach
                @endif
                @if (count($genres))
                    @foreach ($genres as $genre)
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault{{$genre->id}}" name="genres[{{$genre->id}}]">
                            <label class="form-check-label" for="flexSwitchCheckDefault{{$genre->id}}">{{$genre->name}}</label>
                        </div>
                    @endforeach
                @endif

            </div>
            <div class="col-12">
                <div class="form-file">
                    <label class="form-label" for="customFile">Изображение</label>
                    <input type="file" class="form-file-input" id="customFile" name="image">
                </div>
                <p>Текущее:</p>
                <img class="card-img-top mb-3 w-auto" src="{{ '/images/news/thumbnail/'.$data->img }}">
            </div>
            <div class="col-12">
                <a href="{{ route('movies.show', $data->id) }}" class="btn btn-light">Go back</a>
                <button class="btn btn-primary" type="submit">Обновить</button>
            </div>
        </form>

    </div>
</div>


@endsection
