
@extends('layout')

@section('content')

    <h1>{{ $title }}</h1>
    <hr>

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            Lūdzu, novērsiet radušās kļūdas!
        </div>
    @endif


    <form method="post" action="{{ $movie->exists ? '/movies/patch/' . $movie->id : '/movies/put' }}" enctype="multipart/form-data"
    >
    <div class="mb-3">
        <label for="movie-image" class="form-label">Attēls</label>
        @if ($movie->image)
        <img
        src="{{ asset('images/' . $movie->image) }}"
        class="img-fluid img-thumbnail d-block mb-2"
        alt="{{ $movie->name }}"
        >
        @endif
        <input
        type="file" accept="image/png, image/jpeg"
        id="movie-image"
        name="image"
        class="form-control @error('image') is-invalid @enderror"
        >
        @error('image')
        <p class="invalid-feedback">{{ $errors->first('image') }}</p>
        @enderror
    </div>

        @csrf


        <div class="mb-3">
            <label for="movie-name" class="form-label">Filmas nosaukums</label>

            <input
                type="text"
                id="movie-name"
                name="name"
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $movie->name) }}"
            >

            @error('name')
                <p class="invalid-feedback">{{ $errors->first('name') }}</p>
            @enderror
        </div>


        <div class="mb-3">
            <label for="movie-director" class="form-label">Režisors</label>

            <select
                id="movie-director"
                name="director_id"
                class="form-select @error('director_id') is-invalid @enderror"
            >
                <option value="">Norādiet režisoru!</option>
                    @foreach($directors as $director)
                        <option
                            value="{{ $director->id }}"
                            @if ($director->id == old('director_id', $movie->director->id ?? false)) selected @endif
                        >{{ $director->name }}</option>
                    @endforeach
            </select>

            @error('director_id')
                <p class="invalid-feedback">{{ $errors->first('director_id') }}</p>
            @enderror
        </div>


        <div class="mb-3">
            <label for="movie-description" class="form-label">Apraksts</label>

            <textarea
                id="movie-description"
                name="description"
                class="form-control @error('description') is-invalid @enderror"
            >{{ old('description', $movie->description) }}</textarea>

            @error('description')
                <p class="invalid-feedback">{{ $errors->first('description') }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="movie-year" class="form-label">Izdošanas gads</label>

            <input
                type="number" max="{{ date('Y') + 1 }}" step="1"
                id="movie-year"
                name="year"
                value="{{ old('year', $movie->year) }}"
                class="form-control @error('year') is-invalid @enderror"
            >

            @error('year')
                <p class="invalid-feedback">{{ $errors->first('year') }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="movie-price" class="form-label">Cena</label>

            <input
                type="number" min="0.00" step="0.01" lang="en"
                id="movie-price"
                name="price"
                value="{{ old('price', $movie->price) }}"
                class="form-control @error('price') is-invalid @enderror"
            >

            @error('price')
                <p class="invalid-feedback">{{ $errors->first('price') }}</p>
            @enderror
        </div>

        //

        <div class="mb-3">
            <div class="form-check">
                <input
                    type="checkbox"
                    id="movie-display"
                    name="display"
                    value="1"
                    class="form-check-input @error('display') is-invalid @enderror"
                    @if (old('display', $movie->display)) checked @endif
                >
                <label class="form-check-label" for="movie-display">
                    Publicēt ierakstu
                </label>

                @error('display')
                    <p class="invalid-feedback">{{ $errors->first('display') }}</p>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn btn-primary">{{ $movie->exists ? 'Atjaunot' : 'Pievienot' }}</button>

    </form>

@endsection
