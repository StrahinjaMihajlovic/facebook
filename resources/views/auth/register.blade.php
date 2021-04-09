@extends('layouts.loginLayout')

@section('title')
    Register
@endsection

@section('content')
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="email">
            <input id="email" type="text" name="name" value="{{ old('name') }}" placeholder="Name" required autofocus>
        </div>
        <div class="password">
            <input id="email" type="text" name="email" value="{{ old('email') }}" placeholder="Email address">
        </div>
        <div class="password">
            <input id="pass" type="password" placeholder="Password" name="password" required autocomplete="current-password">
        </div>
        <div class="password">
            <input id="pass" type="password" placeholder="Confirm password" name="password_confirmation" required >
        </div>
        <div>
            <button class="botton" type="botton">Register</button>
        </div>
    </form>
    <div class="password">
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
    </div>
@endsection
