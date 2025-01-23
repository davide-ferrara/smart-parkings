<x-layout>

    <section>
        <div class="lg:grid lg:min-h-screen lg:grid-cols-12">

            <main class="flex px-8 py-8 sm:px-12 lg:col-span-7 lg:px-16 lg:py-12 xl:col-span-6">
                <div class="max-w-xl lg:max-w-3xl">

                    <h1 class="mt-6 text-2xl font-bold text-gray-900 sm:text-3xl md:text-4xl">
                        Edit Car info
                    </h1>

                    <form action="{{ route('cars.update', $car->id) }}" method="POST" class="mt-8 grid grid-cols-3 gap-6">
                        @csrf
                        @method('PUT')

                        <div class="">
                            <x-label for="ModelName">Model name</x-label>
                            <x-form-input type="text" id="ModelName" name="model_name" value="{{$car->model_name}}"></x-form-input>

                            <x-label for="LicensePlate">License Plate</x-label>
                            <x-form-input type="text" id="LicensePlate" name="license_plate" value="{{$car->license_plate}}" maxlenght="7" minlenght="7"></x-form-input>

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

                            <div class="p-2">
                                <button
                                    class="inline-block shrink-0 rounded-md border border-blue-600 bg-blue-600 px-12 py-3 text-sm font-medium text-white transition hover:bg-transparent hover:text-blue-600 focus:outline-none focus:ring active:text-blue-500"
                                >
                                    Confirm edit
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </section>

</x-layout>
