<x-layout>
    <h1>Login Page</h1>

    <form method="POST" action="/login">
        @csrf
        <!-- da sistemare in username -->
        <x-form-input type="text" name="name" id="fusername" placeholder="username" :value="old('email')" required></x-form-input>
        <x-form-error name="email" />

        <x-form-input type="password" name="password" id="fpassword" placeholder="password"></x-form-input>
        <x-form-error name="password" />

        <x-button type="submit">Log In</x-button>

    </form>

</x-layout>
