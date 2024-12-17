<!DOCTYPE html>
<html>
<head>
    @if(request()->is('/'))
        <title>Smart Parking</title>
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

    @if(request()->is('profile/*'))
        <title>Profile</title>
    @endif

    @if(request()->is('admin/parking_lot') || request()->is('/'))
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
              integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
        <!-- Must be AFTER Leaflet's CSS -->
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
                integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin="">
        </script>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script rel="text/javascript" src="{{ asset('js/classes/ParkingMap.js') }}"></script>
    @endif
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/all.css">
    @vite('resources/css/app.css')
</head>
<body>
{{--    <div class="header">--}}
{{--        <a href="/" class="header-link">--}}
{{--            <i class="fa-solid fa-car">Smart Parking</i>--}}
{{--        </a>--}}
{{--        @auth--}}
{{--            <div class="center">--}}
{{--                    <h4>Welcome, {{Auth::user()->name}}</h4>--}}

{{--                <form method="POST" action="/logout">--}}
{{--                    @csrf <!-- if not 419 Page Expired -->--}}
{{--                    <x-button>Log Out</x-button>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        @endauth--}}

{{--    </div>--}}
<div class="font-semibold text-gray-500">

    <header class="bg-white">
        <div class="mx-auto max-w px-4 sm:px-6 lg:px-8 border-b-2">
            <div class="flex h-16 items-center justify-between">
                <div class="flex-1 md:flex md:items-center md:gap-12">
                    <a class="block text-blue-600" href="/">
                        <span class="sr-only"></span>
                        <i class="fa-solid fa-car logo"></i>
                    </a>
                    <h1 class="text-blue-600 text-3xl ml-0 font-bold">Smart Parking</h1>
                </div>
                @auth
                    <div class="flex items-center gap-4">
                        <div class="sm:flex sm:gap-4">
                            <div class="flex items-center">
                                <h3 class="text-blue-600 text-xl ml-0 font-normal pr-5">Welcome
                                    back, {{Auth::user()->name}}</h3>
                                <form action="/logout" method="POST">
                                    @csrf
                                    <button
                                        type="submit"
                                        class="w-full rounded-lg px-4 py-2 text-sm font-medium bg-gray-100 text-blue-600 [text-align:_inherit] hover:bg-blue-600 hover:text-white"
                                    >
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endauth
                @guest
                    <div class="flex items-center gap-4">
                        <div class="sm:flex sm:gap-4">
                            <a
                                class="rounded-md bg-blue-600 px-5 py-2.5 text-sm font-medium text-white shadow"
                                href="/login"
                            >
                                Login
                            </a>

                            <div class="hidden sm:flex">
                                <a
                                    class="rounded-md bg-gray-100 px-5 py-2.5 text-sm font-medium text-blue-600"
                                    href="/register"
                                >
                                    Register
                                </a>
                            </div>
                        </div>
                    </div>
                @endguest
            </div>
        </div>
    </header>

        <div class="flex h-screen">
            @auth

            <div class="flex h-screen flex-col border-r-2 min-w-48 justify-between border-e bg-white">
                <div class="px-4 py-6">

                    <ul class="mt-6 space-y-1">
                        <li>
                            <a
                                href="/"
                                class="block rounded-lg bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700"
                            >
                                Map
                            </a>
                        </li>
                        <li>
                            <details class="group [&_summary::-webkit-details-marker]:hidden">
                                <summary
                                    class="flex cursor-pointer items-center justify-between rounded-lg px-4 py-2 text-gray-500 hover:bg-gray-100 hover:text-gray-700"
                                >
                                    <span class="text-sm font-medium"> Profile </span>

                                    <span class="shrink-0 transition duration-300 group-open:-rotate-180">
                  <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="size-5"
                      viewBox="0 0 20 20"
                      fill="currentColor"
                  >
                    <path
                        fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd"
                    />
                  </svg>
                </span>
                                </summary>

                                <ul class="mt-2 space-y-1 px-4">
                                    <li>
                                        <a
                                            href="/profile/{{Auth::id()}}"
                                            class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700"
                                        >
                                            Details
                                        </a>
                                    </li>

                                    <li>
                                        <a
                                            href="/profile/credit/{{Auth::id()}}"
                                            class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700"
                                        >
                                            Credit
                                        </a>
                                    </li>

                                    <li>
                                        <form action="/logout" method="POST">
                                            @csrf
                                            <button
                                                type="submit"
                                                class="w-full rounded-lg px-4 py-2 text-sm font-medium text-gray-500 [text-align:_inherit] hover:bg-gray-100 hover:text-gray-700"
                                            >
                                                Logout
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </details>
                        </li>
                        @if(Auth::user()->name == "admin")
                            <li>
                                <details class="group [&_summary::-webkit-details-marker]:hidden">
                                    <summary
                                        class="flex cursor-pointer items-center justify-between rounded-lg px-4 py-2 text-gray-500 hover:bg-gray-100 hover:text-gray-700"
                                    >
                                        <span class="text-sm font-medium"> Admin </span>

                                        <span class="shrink-0 transition duration-300 group-open:-rotate-180">
                  <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="size-5"
                      viewBox="0 0 20 20"
                      fill="currentColor"
                  >
                    <path
                        fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd"
                    />
                  </svg>
                </span>
                                    </summary>

                                    <ul class="mt-2 space-y-1 px-4">
                                        <li>
                                            <a
                                                href="/admin/parking_lots"
                                                class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700"
                                            >
                                                Parking lots
                                            </a>
                                        </li>

                                        <li>
                                            <a
                                                href="/admin/parking_lot"
                                                class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700"
                                            >
                                                Add Parking
                                            </a>
                                        </li>

                                    </ul>
                                </details>
                            </li>
                        @endif
                    </ul>
                </div>
                <div class="sticky inset-x-0 bottom-0 border-t border-gray-100 border-b-2">
                    <a href="/profile/{{Auth::user()->id}}"
                       class="flex items-center gap-2 bg-white p-4 hover:bg-gray-50">
                        {{--                    <img
                                                alt=""
                                                src="https://images.unsplash.com/photo-1600486913747-55e5470d6f40?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80"
                                                class="size-10 rounded-full object-cover"
                                            />--}}
                        <i class="fa-solid fa-user scale-150"></i>

                        <div>
                            <p class="text-xs">
                                <strong class="block font-medium">{{ucfirst(Auth::user()->name)}}</strong>

                                <span>{{Auth::user()->email}}</span>
                            </p>
                        </div>
                    </a>
                </div>
            </div>
            @endauth
            {{$slot}}
        </div>

</div>


<footer class="bg-white">
    <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:px-8">

        <div class="mt-1 border-t border-gray-100 pt-1">
            <div class="sm:flex sm:justify-between">
                <p class="text-xs text-gray-500">&copy; 2024. Davide Ferrara UNIME Student. All rights reserved.</p>

                <ul class="mt-8 flex flex-wrap justify-start gap-4 text-xs sm:mt-0 lg:justify-end">
                    <li>
                        <a href="#" class="text-gray-500 transition hover:opacity-75"> Terms & Conditions </a>
                    </li>

                    <li>
                        <a href="#" class="text-gray-500 transition hover:opacity-75"> Privacy Policy </a>
                    </li>

                    <li>
                        <a href="#" class="text-gray-500 transition hover:opacity-75"> Cookies </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>


{{--    <nav class="navbar">--}}
{{--        <x-navbar-link href="/" :active="request()->is('/')">--}}
{{--            <i class="fa-solid fa-house">Home</i>--}}
{{--        </x-navbar-link>--}}

{{--        @guest--}}
{{--        <x-navbar-link href="/login" :active="request()->is('login')">--}}
{{--                <i class="fa-solid fa-right-to-bracket">Login</i>--}}
{{--        </x-navbar-link>--}}
{{--        <x-navbar-link href="/register" :active="request()->is('register')">Register</x-navbar-link>--}}
{{--        @endguest--}}

{{--        @auth--}}
{{--            <x-navbar-link href="/profile/{{Auth::id()}}" :active="request()->is('profile')">Profile</x-navbar-link>--}}
{{--            <x-navbar-link href="/profile/credit/{{Auth::id()}}" :active="request()->is('credit')">Credit</x-navbar-link>--}}

{{--            <x-navbar-link href="/admin" :active="request()->is('admin')">Admin</x-navbar-link>--}}

{{--        @endauth--}}

{{--    </nav>--}}


</body>
</html>
