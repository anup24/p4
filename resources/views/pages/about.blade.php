@extends('layouts.master')

@push('head')
    <link href='/css/wikitext.css' rel='stylesheet'>
@endpush

@section('title')
    About WikiText
@endsection

@section('content')
    <h1>About WikiText</h1>

    <h4>
        WikiText is an online notepad for registered users where they can store plain text or any raw text data to share with others, e.g. source code snippets for code review or sharing any text data quickly without email service.
    </h4>
@endsection