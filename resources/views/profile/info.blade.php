<x-layout>
    <!--
  Heads up! 👋

  Plugins:
    - @tailwindcss/forms
-->
    <section>
        <div class="lg:grid lg:min-h-screen lg:grid-cols-12">

            <main class="flex px-8 py-8 sm:px-12 lg:col-span-7 lg:px-16 lg:py-12 xl:col-span-6">
                <div class="max-w-xl lg:max-w-3xl pace-y-4">

                    <h1 class="mt-6 text-2xl font-bold text-gray-900 sm:text-3xl md:text-4xl">
                        Your profile
                    </h1>

                    <p class="mt-4 leading-relaxed text-gray-500">
                        Edit your personal information below
                    </p>

                        <form action="{{ url('profile/' . Auth::user()->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="col-span-6 space-y-4">
                                <x-label for="FirstName">First Name</x-label>
                                <x-form-input type="text" id="FirstName" name="name"
                                    value="{{ Auth::user()->name }}"></x-form-input>

                                <x-label for="Surname">Surname</x-label>
                                <x-form-input type="text" id="Surname" name="surname"
                                    value="{{ Auth::user()->surname }}"></x-form-input>

                                <x-label for="Email">Email</x-label>
                                <x-form-input type="email" id="Email" name="email"
                                    value="{{ Auth::user()->email }}"></x-form-input>

                                <x-label>Password</x-label>
                                <x-form-input type="password" id="Password" name="password"></x-form-input>
                                <div>

                                    @if (session('success'))
                                        <p class="text-blue-600 font-medium text-m">{{ session('success') }}</p>
                                    @endif

                                    @if ($errors->any())
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
                                            class="inline-block shrink-0 rounded-md border border-blue-600 bg-blue-600 px-12 py-3 text-sm font-medium text-white transition hover:bg-transparent hover:text-blue-600 focus:outline-none focus:ring active:text-blue-500">
                                            Confirm edit
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
            </main>
        </div>
    </section>

</x-layout>
