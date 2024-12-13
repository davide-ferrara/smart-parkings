<x-layout>
    <h1>Your profile</h1>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ url('profile/' . $user->id) }}">
        @csrf
        @method('PUT')

        <x-form-input type="text" name="name" id="fusername" value="{{ old('name', $user->name) }}" required></x-form-input>

        <x-form-input type="text" name="email" id="femail" value="{{ old('email', $user->email) }}" required></x-form-input>

        <x-button type="submit">Update</x-button>

    </form>

</x-layout>
