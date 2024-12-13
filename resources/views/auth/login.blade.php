<x-navbar>
    <h1>Login Page</h1>

    <form method="POST" action="/login">
        @csrf
        <!-- da sistemare in username -->
        <x-input type="text" name="name" id="fusername" placeholder="username" :value="old('email')" required></x-input>
        <x-form-error name="email" />

        <x-input type="password" name="password" id="fpassword" placeholder="password"></x-input>
        <x-form-error name="password" />

        <x-button type="submit">Log In</x-button>

    </form>

</x-navbar>
