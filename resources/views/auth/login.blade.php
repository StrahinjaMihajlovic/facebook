@extends('layouts.loginLayout')

@section('title')
    Login
@endsection

@section('content')
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="email">
            <input id="email" type="text" name="email" value="{{ old('email') }}" placeholder="Email address" required autofocus>
        </div>
        <div class="password">
            <input id="pass" type="password" placeholder="Password" name="password" required autocomplete="current-password">
        </div>
        <div class="password">
            <input id="remember" type="checkbox" name="remember"> Remember me
        </div>
        <div>
            <button class="botton" type="botton">Login</button>
        </div>
        <div class="fgt">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 forget" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>
        <div id="br"> <br> </div>
        <div class="acc">
            <div> <botton><a class="newacc" id="new" href="{{ route('register') }}">Create New Account</a></botton> </div>
        </div>
    </form>
@endsection
