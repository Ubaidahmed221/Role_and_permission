@extends('layout.auth-layout')
@section('content')
    <form action="{{ route('userlogin') }}" method="post">
        @csrf
        @if (\Session::has('error'))
        <p style="color: red">{{ \Session::get('error') }}</p>
        @endif
        <h1>Login</h1>
        <fieldset>

            <label for="mail">Email:</label>
            <input type="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

        </fieldset>
        <button type="submit" style="cursor: pointer">Login</button>
    </form>
@endsection
