@extends('layouts.app')

@section('title', 'Zoznam kníh')

@section('sidebar')

@section('content')
    <div class="container text-right mb-5">
        {!!Form::open()->formInline()->method('get')->fill($query)!!}

        {!!Form::text('search')->placeholder('Hľadať')!!}

        {!!Form::date('date_from', 'Dátum od:')!!}
        {!!Form::date('date_to', 'Dátum do:')!!}

        {!!Form::select('order_by', 'Zoradiť podla', [
            'name' => 'Názvu',
            'published_on' => 'Dátumu'
                ])!!}

        {!!Form::submit("Zobraziť")!!}

        {!!Form::close()!!}
    </div>
    <div class='container'>
        @foreach ($books as $book)
            <div class='row'>
                <div class='col-md-12'>
                    <div class='card mb-3'>
                        <div class='card-header'>
                            <h5 class='card-title'>{{ $book->name }}</h5>
                        </div>
                        <div class='card-body'>
                            <div class='row'>
                                <div class='col-md-4'>
                                    <b>ISBN:</b> {{ $book->isbn }}<br>
                                    <b>Žáner:</b> {{ $book->genre }}<br>
                                    <b>Publikované:</b> {{ $book->published_on }}
                                </div>
                                <div class='col-md-4'>
                                    <b>E-mail autora:</b> {{ $book->author_email }}<br>
                                    <b>Počet strán:</b> {{ $book->pages }}
                                </div>

                                @if ($book->image)
                                    <div class='col-md-4'>
                                        <img class="img-thumbnail" src="{{ asset('images/'.$book->image) }}">
                                    </div>
                                @endif
                            </div>
                        </div>
                        @if ($book->abstract)
                            <div class='card-footer'>
                                <b>Abstrakt:</b> {{ $book->abstract }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="container">
        {{ $books->appends(request()->input())->links() }}
    </div>

    <div class="container">
        <a class="btn btn-info btn-lg mb-3" href="{{ route('books.create') }}">Pridať knihu</a>
    </div>
@endsection
