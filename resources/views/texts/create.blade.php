@extends('layouts.master')

@section('title')
    New text
@endsection

@push('head')
    <link href='/css/wikitext.css' type='text/css' rel='stylesheet'>
@endpush

@section('content')

    <h1>Add a new Wiki Text. Your online notepad.</h1>

    <form method='POST' action='/texts'>
        {{ csrf_field() }}

        @include('texts.textform')

        <input type='submit' value='Add Wiki Text' class='btn btn-primary'>
    </form>

    @include('modules.error-form')

@endsection