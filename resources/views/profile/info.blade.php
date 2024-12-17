<x-layout>
{{--    <div class="main">

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

        <a href={{"/profile/credit/" . Auth::user()->id}}>Add credits</a>

    </div>--}}

    <!--
  Heads up! 👋

  Plugins:
    - @tailwindcss/forms
-->

    <section>
        <div class="lg:grid lg:min-h-screen lg:grid-cols-12">

            <main
                class="flex px-8 py-8 sm:px-12 lg:col-span-7 lg:px-16 lg:py-12 xl:col-span-6"
            >
                <div class="max-w-xl lg:max-w-3xl">

                    <h1 class="mt-6 text-2xl font-bold text-gray-900 sm:text-3xl md:text-4xl">
                        Your profile
                    </h1>

                    <p class="mt-4 leading-relaxed text-gray-500">
                        Edit your personal information below
                    </p>

                    <form action="{{ url('profile/' . $user->id) }}" method="POST" class="mt-8 grid grid-cols-3 gap-6">
                        @csrf
                        @method('PUT')

                        <div class="col-span-6">
                            <label for="FirstName" class="block text-sm font-medium text-gray-700">
                                First Name
                            </label>

                            <input
                                type="text"
                                id="FirstName"
                                name="name"
                                class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm"
                            />
                        </div>

                        <div class="col-span-6">
                            <label for="Email" class="block text-sm font-medium text-gray-700"> Email </label>

                            <input
                                type="email"
                                id="Email"
                                name="email"
                                class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm"
                            />
                        </div>

                        @if(session('success'))
                            <p class="text-blue-600 font-medium text-m">{{ session('success') }}</p>
                        @endif

                        @if($errors->any())
                            <div class="text-red-500 font-medium text-m">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="col-span-6 sm:flex sm:items-center sm:gap-4">
                            <button
                                class="inline-block shrink-0 rounded-md border border-blue-600 bg-blue-600 px-12 py-3 text-sm font-medium text-white transition hover:bg-transparent hover:text-blue-600 focus:outline-none focus:ring active:text-blue-500"
                            >
                                Confirm edit
                            </button>

                        </div>
                    </form>
                </div>
            </main>
        </div>
    </section>



</x-layout>
