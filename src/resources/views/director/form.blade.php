@extends('layout')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            Lūdzu, novērsiet radušās kļūdas!
        </div>
    @endif


    <form method="post" action="{{ $director->exists ? '/directors/patch/' . $director->id : '/directors/put'}}">
        @csrf

        <div class="mb-3">
            <label for="director-name" class="form-label">Režisora vārds</label>

            <input
                type="text"
                id="director-name"
                name="name"
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $director->name) }}"
            >

            @error('name')
                <p class="invalid-feedback">{{ $errors->first('name') }}</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">{{ $director->exists ? 'Atjaunot' : 'Pievienot' }}</button>

    </form>

@endsection
