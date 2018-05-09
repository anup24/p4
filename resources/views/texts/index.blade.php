@extends('layouts.master')

@push('head')
    <link href='/css/wikitext.css' rel='stylesheet'>
@endpush

@section('title')
    All Texts
@endsection

@section('content')
    <h2>Homepage of existing texts added by other users. </h2>
    @if($texts != null && count($texts) > 0)
        <aside id='texts'>
            <h4>Please login to add, edit or delete your existing texts.</h4>
            <ul>
                @foreach($texts as $text)
                    <li><a href='/texts/{{ $text->id }}'>{{ $text->header }}</a></li>
                @endforeach
            </ul>
        </aside>
    @endif

@endsection