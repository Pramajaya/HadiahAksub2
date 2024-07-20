<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Movie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>

    <x-navbar></x-navbar>

    <form action="/storeMovie" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="MovieName" class="form-label">Movie Name</label>
          <input type="text" class="form-control" id="MovieName" aria-describedby="emailHelp" name="MovieName" value="{{ old('MovieName') }}">
        </div>
        @error('MovieName')
            <p style="color: red;">{{ $message }}</p>
        @enderror
        <div class="mb-3">
            <label for="MovieDuration" class="form-label">Movie Duration in Minute</label>
            <input type="number" class="form-control" id="MovieDuration" aria-describedby="emailHelp" name="MovieDuration" value="{{ old('MovieDuration') }}">
          </div>
          @error('MovieDuration')
            <p style="color: red;">{{ $message }}</p>
        @enderror
          <div class="mb-3">
            <label for="MovieImage" class="form-label">Movie Poster</label>
            <input type="file" class="form-control" id="MovieImage" aria-describedby="emailHelp" name="MovieImage">
          </div>
          @error('MovieImage')
            <p style="color: red;">{{ $message }}</p>
        @enderror
        <div class="mb-3">
            <label for="MovieDirector" class="form-label">Movie Director</label>
            <input type="text" class="form-control" id="MovieDirector" aria-describedby="emailHelp" name="MovieDirector" value="{{ old('MovieDirector') }}">
          </div>
          @error('MovieDirector')
              <p style="color: red;">{{ $message }}</p>
          @enderror

        <div class="mb-3">
          <label for="GenreName" class="form-label">Genre</label>
          <select name="GenreName" id="GenreName">
            @forelse ($genres as $genre)
                <option value="{{ $genre->id }}">{{ $genre->GenreName }}</option>
            @empty
                <p>Data is empty.</p>
            @endforelse
          </select>
        </div>
        @error('GenreName')
          <p style="color: red;">{{ $message }}</p>
      @enderror

        <button type="submit" class="btn btn-primary">Submit</button>
      </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
