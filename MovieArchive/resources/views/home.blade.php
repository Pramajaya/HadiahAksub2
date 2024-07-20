<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

    <x-navbar></x-navbar>

    @if (Auth::check())
      Welcome Back, {{ Auth::user()->name }}
    @endif

    @forelse ($movies as $movie)
        <div class="card" style="width: 18rem;">
            <img src="{{ asset('/storage'.'/'.$movie->MovieImage) }}" class="card-img-top" alt="...">
            <div class="card-body">
            <p class="card-text">{{ $movie->MovieName }}</p>
            <p class="card-text">{{ $movie->MovieDuration }}</p>
            <p class="card-text">{{ $movie->MovieDirector }}</p>
            <p class="card-text">{{ $movie->genre->GenreName }}</p>

            @if (Auth::user()->Role == 'Admin')
                <a href="/updateMovie/{{ $movie->id }}">Update Movie</a>
                <form action="/deleteMovie/{{ $movie->id }}" method="POST">
                    @csrf
                    <button type="submit">Delete Movie</button>
                </form>
            @endif

        </div>
    @empty
        <p>Data is emtpy.</p>
    @endforelse

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
