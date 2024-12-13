<x-layout>
    @auth
{{--    <h1>Welcome back {{Auth::user()->name}}!</h1>--}}
    <x-map></x-map>

    @endauth

</x-layout>
