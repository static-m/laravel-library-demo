<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title')</title>
    <link href="/css/app.css" rel="stylesheet">
</head>

<body>

@section('navbar')
<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
    <a class="navbar-brand" href="#">Databáza kníh</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item @if(Route::is('books.list')) active @endif">
                <a class="nav-link" href="{{ route('books.list') }}">Zoznam <span class="sr-only"></span></a>
            </li>
            <li class="nav-item @if(Route::is('books.add')) active @endif">
                <a class="nav-link" href="{{ route('books.add') }}">Pridať</a>
            </li>
        </ul>
    </div>
</nav>
@show

<main role="main" class="container">
    @yield('content')
</main>

<script src="/js/app.js"></script>
</body>
</html>
