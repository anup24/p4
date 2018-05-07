@extends('layouts.master')

@section('title')
    Search
@endsection

@section('content')
    <h1>Search</h1>

    <form method='GET' action='/texts/search'>

        <fieldset>
            <label for='searchTerm'>Search by header:</label>
            <input type='text' name='searchTerm' id='searchTerm' value='{{ $searchTerm or 'My Text' }}'>

            <input type='checkbox' name='caseSensitive' {{ ($caseSensitive) ? 'checked' : '' }}>
            <label>case sensitive</label>
        </fieldset>

        <input type='submit' value='Search' class='btn btn-primary btn-small'>
    </form>

    @if($searchTerm)
        <h2>Results for query: <em>{{ $searchTerm }}</em></h2>

        @if(count($searchResults) == 0)
            No matches found.
        @else
            @foreach($searchResults as $header => $text)
                <div class='text'>
                    <h3>{{ $header }}</h3>
                    <h4>by {{ $text['user_id'] }}</h4>
                </div>
            @endforeach
        @endif
    @endif

@endsection