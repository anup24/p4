@extends('layouts.master')

@push('head')
    <link href='/css/wikitext.css' rel='stylesheet'>
@endpush

@section('title')
    Contact
@endsection

@section('content')
    <h1>Contact</h1>
    <p>
        Questions? Email at {{ $email }}
    </p>
@endsection