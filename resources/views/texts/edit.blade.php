@extends('layouts.master')

@section('title')
    Edit  {{$text->header}}
@endsection

@push('head')
    <link href='/css/wikitext.css' type='text/css' rel='stylesheet'>
@endpush

@section('content')

    <h1>Edit</h1>
    <h2>{{ $text->title }}</h2>

    <form method='POST' action='/texts/{{ $text->id }}'>
        {{ method_field('put') }}
        {{ csrf_field() }}

        @include('texts.textform')

        <input type='submit' value='Save changes' class='btn btn-primary'>
    </form>

    @include('modules.error-form')

@endsection