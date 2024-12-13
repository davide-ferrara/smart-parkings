<x-layout>
    @auth
    <h1>Welcome back {{Auth::user()->name}}!</h1>
    @endauth
</x-layout>
