@extends('layouts.master')

@push('head')
    <link href='/css/wikitext.css' type='text/css' rel='stylesheet'>
@endpush

@section('content')

    <h2>Login to WikiText to add your texts.</h2>

    Don't have an account? <a href='/register'>Create your account here...</a>

    <br/>
    <a href="/login/github"  class="btn btn-default btn-md">Log in with Github</a>

    <form method='POST' action='{{ route('login') }}'>

        {{ csrf_field() }}

        <label for='email'>E-Mail Address</label>
        <input id='email' type='email' name='email' value='{{ old('email') }}' required autofocus>
        @include('modules.error-field', ['field' => 'email'])

        <label for='password'>Password</label>
        <input id='password' type='password' name='password' required>
        @include('modules.error-field', ['field' => 'password'])

        <label>
            <input type='checkbox' name='remember' {{ old('remember') ? 'checked' : '' }}> Remember Me
        </label>

        <button type='submit' class='btn btn-primary'>Login</button>

        <a class='btn btn-link' href='{{ route('password.request') }}'>Forgot Your Password?</a>
    </form>


@endsection