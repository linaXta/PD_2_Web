@extends('layout')

@section('content')

    <h1>{{ $title }}</h1>
    <hr>

    @if (count($items) > 0)

        <table class="table table-striped table-hover table-sm">
            <thead class="">
                <tr>
                    <th>ID</th>
                    <th>Vārds</th>
                    <th>Darbības</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $director)
                <tr>
                    <td>{{ $director->id }}</td>
                    <td>{{ $director->name }}</td>
                    <td>
                        <a href="/directors/update/{{ $director->id }}" class="btn btn-outline-primary btn-sm">Labot</a>
                        /
                        <form method="post" action="/directors/delete/{{ $director->id }}" class="deletion-form d-inline">
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

    <a href="/directors/create" class="btn btn-primary">Pievienot jaunu režisoru</a>

@endsection
