@extends('layouts.master')

@section('title')
    Tags
@endsection

@section('content')

    <aside id='texts'>
        <h2>List of tags from WikiText</h2>
        <ul>
            @foreach($tags as $tag)
                <li><a href='{{ url('texts/tag/'.$tag->id) }}'>{{ $tag->name }}</a></li>
            @endforeach
        </ul>
    </aside>

@endsection