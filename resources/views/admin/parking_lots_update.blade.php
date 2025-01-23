<x-layout>
    <section>
        <div class="lg:grid lg:min-h-screen lg:grid-cols-12">

            <main class="flex px-8 py-8 sm:px-12 lg:col-span-7 lg:px-16 lg:py-12 xl:col-span-6">
                <div class="max-w-xl lg:max-w-3xl space-y-4">

                    <h1 class="mt-6 text-2xl font-bold text-gray-900 sm:text-3xl md:text-4xl">
                        Update Parking Lot Information
                    </h1>

                    <p class="mt-4 leading-relaxed text-gray-500">
                        Edit the parking lot details below
                    </p>

                    <form action="{{ url('admin/parking/' . $parkingLot->lot_number) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="col-span-6 space-y-4">
                            <x-label for="lot_number">Lot Number</x-label>
                            <x-form-input type="text" id="lot_number" name="lot_number" type="number" step="any"
                                          value="{{ $parkingLot->lot_number }}">
                            </x-form-input>

                            <x-label for="lat">Latitude</x-label>
                            <x-form-input type="text" id="lat" name="lat" type="number" step="any"
                                          value="{{ $parkingLot->lat }}">
                            </x-form-input>

                            <x-label for="lng">Longitude</x-label>
                            <x-form-input type="text" id="lng" name="lng" type="number" step="any"
                                          value="{{ $parkingLot->lng }}">
                            </x-form-input>

                            <x-label for="address">Address</x-label>
                            <x-form-input type="text" id="address" name="address"
                                          value="{{ $parkingLot->address }}">
                            </x-form-input>

                            <x-label for="zone_id">Zone ID</x-label>
                            <x-form-input type="text" id="zone_id" name="zone_id"
                                          value="{{ $parkingLot->zone_id }}">
                            </x-form-input>

                            <x-label for="occupied_by">Occupied By</x-label>
                            <x-form-input type="text" id="occupied_by" name="occupied_by"
                                          value="{{ $parkingLot->occupied_by }}">
                            </x-form-input>

                            <x-label for="license_plate">License Plate</x-label>
                            <x-form-input type="text" id="license_plate" name="license_plate"
                                          value="{{ $parkingLot->license_plate }}">
                            </x-form-input>

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
                                        Confirm Edit
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
