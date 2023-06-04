@extends('layout')

@section('content')

    <h1>{{ $title }}</h1>
    <hr>

    @if (count($items) > 0)

        <table class="table table-striped table-hover table-sm">
            <thead class="">
                <tr>
                    <th>ID</th>
                    <th>Nosaukums</th>
                    <th>Režisori</th>
                    <th>Žanri</th>
                    <th>Gads</th>
                    <th>Cena</th>
                    <th>Publicēts</th>
                    <th>Darbības</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $movie)
                <tr>
                    <td>{{ $movie->id }}</td>
                    <td>{{ $movie->name }}</td>
                    <td>{{ $movie->director->name }}</td>
                    <td>{{ $movie->genre ? $movie->genre->name : '' }}</td>
                    <td>{{ $movie->year }}</td>
                    <td>&euro;{{ number_format($movie->price, 2 , '.') }}</td>
                    <td>{!! $movie->display ? '&#10004;&#65039;' : '&#10060;' !!}</td>

                    <td>
                        <a href="/movies/update/{{ $movie->id }}" class="btn btn-outline-primary btn-sm">Labot</a>
                        /
                        <form method="post" action="/movies/delete/{{ $movie->id }}" class="deletion-form d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm">Dzēst</button>
                        </form>

                    </td>
                </tr>    
                @endforeach
            </tbody>
        </table>

    @else

        <p>Nav atrasts neviens ieraksts</p>

    @endif

    <a href="/movies/create" class="btn btn-primary">Pievienot jaunu filmu</a>

@endsection
