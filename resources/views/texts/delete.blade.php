@extends('layouts.master')

@push('head')
    <link href='/css/wikitext.css' rel='stylesheet'>
@endpush

@section('title')
    Confirm deletion: {{ $text->header }}
@endsection

@section('content')
    <h1>Confirm deletion</h1>

    <p>Are you sure you want to delete <strong>{{ $text->header }}</strong>?</p>

    <form method='POST' action='/texts/{{ $text->id }}'>
        {{ method_field('delete') }}
        {{ csrf_field() }}
        <input type='submit' value='Yes, delete it!' class='btn btn-danger btn-small'>
    </form>

    <p class='cancel'>
        <a href='/texts/{{ $text->id }}'>No, I changed my mind.</a>
    </p>

@endsection