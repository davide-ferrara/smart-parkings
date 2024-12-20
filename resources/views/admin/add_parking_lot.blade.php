<x-layout>

    <div class="flex-1 flex">

        <x-map></x-map>

        <div class="border-1 flex-1 p-5">
            <form method="POST" action="parking_lot" class="space-y-4">
                @csrf
                    <label for="Latitude" class="block text-sm font-medium text-gray-700">
                        Latitude
                    </label>

                    <input
                        type="number"
                        step="any"
                        id="Latitude"
                        name="lat"
                        class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm"
                    />

                    <label for="Longitude" class="block text-sm font-medium text-gray-700">
                        Longitude
                    </label>

                    <input
                        required
                        type="number"
                        step="any"
                        id="Longitude"
                        name="lng"
                        class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm"
                    />

                        <label for="ParkingLot" class="block text-sm font-medium text-gray-700">
                            Parking Lot Number
                        </label>

                        <input
                            type="number"
                            id="ParkingLot"
                            name="lot_number"
                            class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm"
                        />

                        <label for="Zone" class="block text-sm font-medium text-gray-700">
                            Zone
                        </label>

                        <input
                            type="text"
                            id="Zone"
                            name="zone_id"
                            class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm"
                        />

                        <label for="Zone" class="block text-sm font-medium text-gray-700">
                            Address
                        </label>

                        <input
                            type="text"
                            id="Address"
                            name="address"
                            class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm"
                        />

                        <button
                            type="button"
                            id="getFromMapBtn"
                            class="w-full rounded-lg px-4 py-2 text-sm font-medium bg-gray-100 text-blue-600 [text-align:center] hover:bg-blue-600 hover:text-white"
                        >
                            Pick from map
                        </button>

                    <span class="flex items-center">
                      <span class="h-px flex-1 bg-neutral-100"></span>
                    </span>

                        <button
                            type="submit"
                            class="w-full rounded-lg px-4 py-2 text-sm font-medium bg-blue-600 text-gray-100 [text-align:center] hover:bg-gray-100 hover:text-blue-600"
                        >
                            Add Parking
                        </button>
                @if ($errors->any())
                    <div class="text-red-600">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="text-blue-600">
                        <ul>
                            {{session('success')}}
                        </ul>
                    </div>
                    @endif
            </form>
        </div>

    </div>

{{--    <x-map></x-map>--}}

{{--    <form method="POST" action="parking_lot">
        @csrf
        <x-form-input type="number" name="lat" id="flat" step="any" placeholder="Latitude" required></x-form-input>

        <x-form-input type="number" name="lng" id="flng" step="any" placeholder="Longitude" required></x-form-input>

        <x-button type="button" id="getFromMapBtn">Get from Map</x-button>

        <x-form-input type="number" name="lot_number" id="flot_number" placeholder="Parking Lot Number" required></x-form-input>

        <x-form-input type="text" name="address" id="faddress" placeholder="Address"></x-form-input>

        <x-button type="submit">Add</x-button>

    </form>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="success">
            <ul>
                {{session('success')}}
            </ul>
        </div>
    @endif--}}

    <script rel="text/javascript" src="{{ asset('js/addParking.js') }}"></script>

</x-layout>
