@extends('layouts.app')

@section('title'){{'Жанр #'}} {{$data->id}}@endsection
@section('h1'){{'Жанр #'}} {{$data->id}}@endsection

@section('content')

<div class="album py-5 bg-light">
    <div class="container">

        <form class="row g-3 needs-validation" method="post" action="{{ route('genre-store', $data->id) }}" enctype="multipart/form-data">
            @csrf
            <div class="col-12">
                <label class="form-label" for="validationCustom01">Название</label> 
                <input class="form-control" id="validationCustom01" name="name" required="" type="text" value="{{$data->name}}">
                <div class="valid-feedback">
                    Все хорошо!
                </div>
            </div>
            <div class="col-12">
                <button class="btn btn-primary" type="submit">Обновить</button>
            </div>
        </form>

    </div>
</div>


@endsection
