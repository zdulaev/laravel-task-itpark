@extends('layouts.app')

@section('title'){{'Добавить жанр'}} @endsection
@section('h1'){{'Добавить жанр'}} @endsection

@section('content')

<div class="album py-5 bg-light">
    <div class="container">

        <form class="row g-3 needs-validation" method="post" action="{{ route('genre-create') }}">
            @csrf
            <div class="col-12">
                <label class="form-label" for="validationCustom01">Название</label> 
                <input class="form-control" id="validationCustom01" name="name" required="" type="text" value="">
                <div class="valid-feedback">
                    Все хорошо!
                </div>
            </div>
            <div class="col-12">
                <button class="btn btn-primary" type="submit">Создать</button>
            </div>
        </form>

    </div>
</div>


@endsection
