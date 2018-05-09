@extends('layouts.master')

@push('head')
    <link href='/css/wikitext.css' rel='stylesheet'>
@endpush

@section('title')
    All Texts
@endsection

@section('content')

    @if($texts != null && count($texts) > 0)
        <aside id='texts'>
            <h2>Homepage of existing texts added by other users. <h2>
            <h4>Please login to add, edit or delete your existing texts or click to view existing texts.</h4>
            <ul>
                @foreach($texts as $text)
                    <li><a href='/texts/{{ $text->id }}'>{{ $text->header }}</a></li>
                @endforeach
            </ul>
        </aside>
    @endif

@endsection