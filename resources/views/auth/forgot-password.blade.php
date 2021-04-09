@extends('layouts.loginLayout')

@section('title')
    Forgot password
@endsection

@section('content')
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="password">
            <input id="email" type="text" name="email" value="{{ old('email') }}" placeholder="Email address" required autofocus>
        </div>
        <div>
            <button class="botton" type="botton">Email Password Reset Link</button>
        </div>
    </form>
    <div clas="password" style="padding: 20px;">
        Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
    </div>
    <div class="password" style="padding: 20px;">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
    </div>
@endsection
