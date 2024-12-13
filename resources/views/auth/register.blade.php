<x-layout>

    <h1>Register Page</h1>

    <form method="POST" action="/register">
        @csrf
        <!-- da cambiare id name in username e fare migrate-->
        <x-form-input type="text" name="name" id="fusername" placeholder="username"></x-form-input>

        <x-form-input type="text" name="email" id="femail" placeholder="email"></x-form-input>

        <x-form-input type="password" name="password" id="fpassword" placeholder="password"></x-form-input>

        <x-button type="submit">Register</x-button>

    </form>

</x-layout>

