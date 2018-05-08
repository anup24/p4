@extends('layouts.master')

@push('head')
    <link href='/css/wikitext.css' type='text/css' rel='stylesheet'>
@endpush

@section('content')
    <h2>Register to add, edit and delete your texts.</h2>

    Already have an account? <a href='/login'>Login here...</a>

    <form method='POST' action='{{ route('register') }}'>
        {{ csrf_field() }}

        <label for='name'>First Name</label>
        <input id='first_name' type='text' name='first_name' value='{{ old('first_name') }}' required autofocus>
        @include('modules.error-field', ['field' => 'first_name'])

        <label for='name'>Last Name</label>
        <input id='last_name' type='text' name='last_name' value='{{ old('last_name') }}' required autofocus>
        @include('modules.error-field', ['field' => 'last_name'])

        <label for='email'>E-Mail Address</label>
        <input id='email' type='email' name='email' value='{{ old('email') }}' required>
        @include('modules.error-field', ['field' => 'email'])

        <label for='password'>Password (min: 6)</label>
        <input id='password' type='password' name='password' required>
        @include('modules.error-field', ['field' => 'password'])

        <label for='password-confirm'>Confirm Password</label>
        <input id='password-confirm' type='password' name='password_confirmation' required>

        <button type='submit' class='btn btn-primary'>Register</button>
    </form>
@endsection