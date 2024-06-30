@extends('layout.auth-layout')
@section('content')
    <form action="{{ route('UserRegister') }}" method="post">
        @csrf
        @if (\Session::has('error'))
        <p style="color: red">{{ \Session::get('error') }}</p>
        @elseif (\Session::has('success'))
        <p style="color: green">{{ \Session::get('success') }}</p>

        @endif
        <h1>Register</h1>
        <fieldset>
            <label for="mail">Name:</label>
            <input type="text" name="name" required>

            <label for="mail">Email:</label>
            <input type="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

        </fieldset>
        <button type="submit" style="cursor: pointer">Submit</button>
    </form>
@endsection
