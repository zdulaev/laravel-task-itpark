@extends('layouts.app')

@section('title'){{'Создать фильм'}}@endsection
@section('h1'){{'Создать фильм'}}@endsection

@section('content')

<div class="album py-5 bg-light">
    <div class="container">

        <form class="row g-3 needs-validation" method="post" action="{{ route('movies.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="col-12">
                <label class="form-label" for="validationCustom01">Название</label> 
                <input class="form-control" id="validationCustom01" name="name" required="" type="text">
                <div class="valid-feedback">
                    Все хорошо!
                </div>
            </div>
            <div class="col-12">
                @if (count($genres))
                    Жанры:
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
            </div>
            <div class="col-12">
                <a href="{{ route('movies.index') }}" class="btn btn-light">Go back</a>
                <button class="btn btn-primary" type="submit">Создать</button>
            </div>
        </form>

    </div>
</div>


@endsection
