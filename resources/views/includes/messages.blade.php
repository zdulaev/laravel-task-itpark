<section class="text-center container">
    <div class="row">
        <div class="col-lg-6 col-md-8 mx-auto">
            <h1 class="fw-light">@yield('h1')</h1>
            <p class="mb-0">
                <a href="/movies" class="btn btn-primary my-2">All movies</a>
                <a href="/genres" class="btn btn-secondary my-2">All genres</a>
            </p>
        </div>
    </div>
</section>

@if (session()->has('success'))
<div class="alert alert-success mb-0">
    @if(is_array(session('success')))
        <ul>
            @foreach (session('success') as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    @else
        {{ session('success') }}
    @endif
</div>
@endif
