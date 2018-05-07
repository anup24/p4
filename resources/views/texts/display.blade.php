@extends('layouts.master')

@section('title')
    {{ $text->header }}
@endsection

@push('head')
    <link href='/css/wikitext.css' type='text/css' rel='stylesheet'>
@endpush

@section('content')
    <h1>{{ $text->header }}</h1>

    <div class='text cf'>

        <h2>{{ $text->header }}</h2>
        <p>{{ $text->contents }}</p>

        @if($flag)
        <ul class='textActions'>
            <li><a href='/texts/{{ $text->id }}/edit'><i class="fas fa-pencil-alt"></i> Edit</a>
            <li><a href='/texts/{{ $text->id }}/delete'><i class="fas fa-trash-alt"></i> Delete</a>
        </ul>
        @endif
        <br/>
        <p><b>Note:</b> Logged in users can view any text however can only edit and delete their own texts.</p>
    </div>
@endsection