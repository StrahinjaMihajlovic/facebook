<html>
<head>
    <title>Facebook | @yield('title')</title>
    <meta charset="utf-8">
    <meta name="author" content="Vlad">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Facebook,fb,messenger">
    @section('css')
        <link rel="stylesheet" href="{{ asset('css/loginStyle.css') }}">
    @show
</head>
<body>
<div class="general">
    <a href="{{ route('login') }}">
     <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/89/Facebook_Logo_%282019%29.svg/1280px-Facebook_Logo_%282019%29.svg.png" width="248px" alt="Facebook">
    </a>
    <h2>Facebook helps you connect and share <br> with the people in your life.</h2>
</div>
<div class="forms">
@yield('content')
</body>
</div>
</html>
