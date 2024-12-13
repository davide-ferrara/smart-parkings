<!DOCTYPE html>
<html>
<head>
    @if(request()->is('/'))
        <title>Home</title>
    @endif

    @if(request()->is('register/*'))
        <title>Register</title>
    @endif

    @if(request()->is('login/*'))
        <title>Log In</title>
    @endif

    @if(request()->is('admin/*'))
        <title>Admin</title>
    @endif

    @if(request()->is('admin/parking_lot'))
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
              integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
        <!-- Must be AFTER Leaflet's CSS -->
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
                integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin="">
        </script>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script rel="text/javascript" src="{{ asset('js/classes/ParkingMap.js') }}"></script>
    @endif

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>
<body>
    <nav>
        <h4>Smart Parking</h4>
        <x-navbar-link href="/" :active="request()->is('/')">Home</x-navbar-link>

        @guest
        <x-navbar-link href="/login" :active="request()->is('login')">Log In</x-navbar-link>
        <x-navbar-link href="/register" :active="request()->is('register')">Register</x-navbar-link>
        @endguest

        @auth
            {{Auth::user()->name}},
            <x-navbar-link href="/profile/{{Auth::id()}}" :active="request()->is('profile')">Profile</x-navbar-link>

            <x-navbar-link href="/admin" :active="request()->is('admin')">Admin</x-navbar-link>

            <form method="POST" action="/logout">
                @csrf <!-- if not 419 Page Expired -->
                <x-button>Log Out</x-button>
            </form>
        @endauth

    </nav>

    {{$slot}}

</body>
</html>
