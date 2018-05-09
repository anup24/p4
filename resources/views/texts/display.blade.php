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
        <label for='header'>Header</label>
        <h2>{{ $text->header }}</h2>
        <label for='Contents'>Contents</label>
        <p>{{ $text->contents }}</p>
        <label for='tags'>Associated Tags</label>
        @foreach($tags as $tag)
            <li><a href='{{ url('texts/tag/'.$tag->id) }}'>{{ $tag->name }}</a></li>
        @endforeach
        <br/>
        <br/>
        @if($sameUser)
        <ul class='text'>
            <li><a href='/texts/{{ $text->id }}/edit'><i class="fas fa-pencil-alt"></i> Edit</a>
            <li><a href='/texts/{{ $text->id }}/delete'><i class="fas fa-trash-alt"></i> Delete</a>
        </ul>
        @endif
        <br/>
        <p><b>Note:</b> Logged in users can view any text but can only edit/delete their own texts.</p>
    </div>
@endsection