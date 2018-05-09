<!doctype html>
<html lang='en'>
<head>
    <title>@yield('title', 'WikiText')</title>
    <meta charset='utf-8'>

    <link href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" rel="stylesheet">
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' rel='stylesheet'>
    <link href='/css/wikitext.css' type='text/css' rel='stylesheet'>

    @stack('head')
</head>
<body>

@if(session('alert'))
    <div class='flashAlert'>{{ session('alert') }}</div>
@endif

<header>
    <a href='/'><img src='/images/wikitext.png' id='logo' alt='WikiText Logo'> </a>
    @include('modules.nav')
</header>

<section id='main'>
    @yield('content')
</section>

<footer>
    <a href='http://github.com/anup24/p4'><i class="fab fa-github"></i> View on Github</a>
</footer>

@stack('body')

</body>
</html>