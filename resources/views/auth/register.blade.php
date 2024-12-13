<!DOCTYPE html>
<html>
    <head>
        <title>Register</title>
    </head>
    <body>
    <x-navbar>

        <h1>Register Page</h1>

        <form method="POST" action="/register">
            @csrf
            <!-- da cambiare id name in username e fare migrate-->
            <x-input type="text" name="name" id="fusername" placeholder="username"></x-input>

            <x-input type="text" name="email" id="femail" placeholder="email"></x-input>

            <x-input type="password" name="password" id="fpassword" placeholder="password"></x-input>

            <x-button type="submit">Register</x-button>

        </form>

    </x-navbar>

    </body>
</html>
