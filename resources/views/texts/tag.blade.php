@extends('layouts.master')

@section('title')
    Tags
@endsection

@push('head')
    <link href='/css/wikitext.css' type='text/css' rel='stylesheet'>
@endpush

@section('content')

    <aside id='texts'>
        <h2>Select tag to view associated texts from WikiText.</h2>
        <ul>
            @foreach($tags as $tag)
                <li><a href='{{ url('texts/tag/'.$tag->id) }}'>{{ $tag->name }}</a></li>
            @endforeach
        </ul>
    </aside>

@endsection