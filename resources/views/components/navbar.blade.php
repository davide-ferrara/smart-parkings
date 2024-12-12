<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <nav>
        <x-navbar-link href="/" :active="request()->is('/')">Home</x-navbar-link>
        <x-navbar-link href="/login" :active="request()->is('login')">Login</x-navbar-link>
        <x-navbar-link href="/register" :active="request()->is('register')">Register</x-navbar-link>
    </nav>

    {{$slot}}

</body>
</html>
