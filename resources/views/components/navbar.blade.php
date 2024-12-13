<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <nav>

        <x-navbar-link href="/" :active="request()->is('/')">Home</x-navbar-link>

        @guest
        <x-navbar-link href="/login" :active="request()->is('login')">Log In</x-navbar-link>
        <x-navbar-link href="/register" :active="request()->is('register')">Register</x-navbar-link>
        @endguest

        @auth
            {{Auth::user()->name}},
            <x-navbar-link href="/profile/{{Auth::id()}}" :active="request()->is('profile')">Profile</x-navbar-link>

            <form method="POST" action="/logout">
                @csrf <!-- 419 Page Expired -->
                <x-button>Log Out</x-button>
            </form>
        @endauth

    </nav>

    {{$slot}}

</body>
</html>
