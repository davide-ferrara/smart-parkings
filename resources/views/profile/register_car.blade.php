<x-layout>
    <section>
        <div class="lg:grid lg:min-h-screen lg:grid-cols-12">

            <main class="flex px-8 py-8 sm:px-12 lg:col-span-7 lg:px-16 lg:py-12 xl:col-span-6">
                <div class="max-w-xl lg:max-w-3xl">

                    <h1 class="mt-6 text-2xl font-bold text-gray-900 sm:text-3xl md:text-4xl">
                        Register a car
                    </h1>

                    <form action="{{ route('cars.store') }}" method="POST"
                          class="mt-8 grid grid-cols-3 gap-6">
                        @csrf

                        <div class="col-span-6">
                            <x-label>Model Name</x-label>
                            <x-form-input type="text" name="model_name" maxlength="25"></x-form-input>

                            <x-label>License Plate</x-label>
                            <x-form-input type="text" maxlength="7" minlength="7" name="license_plate"></x-form-input>

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
                                        Register Car
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
