@extends('layouts.app')

@section('title', 'Pridať knihu')

@section('sidebar')

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <h1>Pridať knihu</h1>

        {!!Form::open()->multipart()!!}

        {!!Form::text('name', 'Názov')->required()->placeholder('Názov knihy')->lg()!!}

        {!!Form::text('isbn', 'ISBN')->placeholder('ISBN')->lg()!!}

        {!!Form::text('genre', 'Žáner')->placeholder('Žáner')->lg()!!}

        {!!Form::textarea('abstract', 'Abstrakt')->placeholder('Abstrakt...')->lg()!!}

        {!!Form::date('published_date', 'Publikované dňa')->lg()!!}
        {!!Form::time('published_time', 'Publikované o hodine')->lg()!!}

        {!!Form::text('author_email', 'E-mail autora')->type('email')->placeholder('E-mail autora')->lg()!!}

        {!!Form::range('pages', 'Počet strán')->type('number')->placeholder('Počet strán')->lg()!!}

        {!!Form::file('image', 'Titulný obrázok')!!}

        {!!Form::submit("Pridať")->lg()!!}

        {!!Form::close()!!}
    </div>
@endsection
