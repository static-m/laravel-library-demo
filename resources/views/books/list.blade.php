@extends('layouts.app')

@section('title', 'Zoznam kníh')

@section('sidebar')

@section('content')
    <div class='container'>
        @foreach ($books as $book)
            <div class='row'>
                <div class='col-md-12'>
                    <div class='card mb-3'>
                        <div class='card-header'>
                            <h5 class='card-title'>{{ $book['name'] }}</h5>
                        </div>
                        <div class='card-body'>
                            <div class='row'>
                                <div class='col-md-4'><b>ISBN:</b> {{ $book['isbn'] }} </div>
                                <div class='col-md-4'><b>Žáner:</b> {{ $book['genre'] }} </div>
                                <div class='col-md-4'><b>Publikované:</b> {{ $book['published_on'] }} </div>
                                <div class='col-md-4'><b>E-mail autora:</b> {{ $book['author_email'] }} </div>
                                <div class='col-md-4'><b>Počet strán:</b> {{ $book['pages'] }} </div>
                            </div>
                        </div>
                        @if ($book['abstract'])
                            <div class='card-footer'>
                                <b>Abstrakt:</b> {{ $book['abstract'] }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
        <a class="btn btn-info btn-lg mb-3" href="{{ route('books.create') }}">Pridať knihu</a>
    </div>
@endsection
