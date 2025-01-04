<x-layout>
    <div class="flex-1 flex">
        <x-map></x-map>

        <div class="border-1 flex-1 p-5">
            <form method="POST" action="parking_lot" class="space-y-4">
                @csrf

                <div>
                    <label for="Latitude" class="block text-sm font-medium text-gray-700">Latitude</label>
                    <input
                        type="number"
                        step="any"
                        id="Latitude"
                        name="lat"
                        class="mt-1 w-full rounded-md border-gray-300 bg-white text-sm text-gray-700 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                        required
                    />
                </div>

                <div>
                    <label for="Longitude" class="block text-sm font-medium text-gray-700">Longitude</label>
                    <input
                        required
                        type="number"
                        step="any"
                        id="Longitude"
                        name="lng"
                        class="mt-1 w-full rounded-md border-gray-300 bg-white text-sm text-gray-700 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                    />
                </div>

                <div>
                    <label for="Zone" class="block text-sm font-medium text-gray-700">Zone</label>
                    <select name="zone_id" id="zones" class="mt-1 w-full rounded-md border-gray-300 bg-white text-sm text-gray-700 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                        @foreach($parkingLotZones as $zone)
                            <option value="{{ $zone->id }}">{{ $zone->letter }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="Address" class="block text-sm font-medium text-gray-700">Address</label>
                    <input
                        type="text"
                        id="Address"
                        name="address"
                        class="mt-1 w-full rounded-md border-gray-300 bg-white text-sm text-gray-700 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                        required
                    />
                </div>

                <button
                    type="button"
                    id="getFromMapBtn"
                    class="w-full rounded-lg px-4 py-2 text-sm font-medium bg-gray-100 text-blue-600 hover:bg-blue-600 hover:text-white focus:outline-none focus:ring focus:ring-blue-200"
                >
                    Pick from map
                </button>

                <span class="flex items-center">
                    <span class="h-px flex-1 bg-neutral-100"></span>
                </span>

                <button
                    type="submit"
                    class="w-full rounded-lg px-4 py-2 text-sm font-medium bg-blue-600 text-gray-100 hover:bg-gray-100 hover:text-blue-600 focus:outline-none focus:ring focus:ring-blue-200"
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
                            {{ session('success') }}
                        </ul>
                    </div>
                @endif
            </form>
        </div>
    </div>

    <script rel="text/javascript" src="{{ asset('js/addParking.js') }}"></script>
</x-layout>
