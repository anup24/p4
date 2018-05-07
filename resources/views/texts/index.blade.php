@extends('layouts.master')

@push('head')
    <link href='/css/wikitext.css' rel='stylesheet'>
@endpush

@section('title')
    All Texts
@endsection

@section('content')

    @if(count($newTexts) > 0)
        <aside id='newTexts'>
            <h2>Please login to add, edit or delete your existing texts from WikiText!</h2>
            <h3>Recently Added Text to Wiki Texts. Your Online Notepad.</h3>
            <ul>
                @foreach($newTexts as $text)
                    <li><a href='/texts/{{ $text->id }}'>{{ $text->header }}</a></li>
                @endforeach
            </ul>
        </aside>
    @endif

@endsection