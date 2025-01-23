@auth
    @php
    $activeParking = Auth::user()->parkingLotHistory()->latest()->first();
    $parkingLot = Auth::user()->parkingLot;
    @endphp
@endauth

<x-layout>
    @auth

        @if(empty($parkingLot))
                <div class="flex items-center justify-center m-16">
                    <h1 class="text-xl font-sans text-red-500">No active parking found!</h1>
                </div>
            @else
                <div class="flex justify-center py-12">
                    <div class="w-full max-w-lg p-6 bg-white shadow-lg rounded-xl border border-gray-200">
                        <div class="mb-6 text-center">
                            <h3 class="text-2xl font-bold text-blue-600">Parking Lot Information</h3>
                        </div>
                        <div class="text-gray-700 space-y-4">
                            <p><span class="font-semibold text-gray-900">Parked At:</span> {{ \Carbon\Carbon::parse($activeParking->start_parking)->format('Y-m-d H:i:s') }}</p>
                            <p><span class="font-semibold text-gray-900">Leaving At:</span> {{ \Carbon\Carbon::parse($activeParking->end_parking)->format('Y-m-d H:i:s') }}</p>
                            <p><span class="font-semibold text-gray-900">Lot Number:</span> {{ $parkingLot->lot_number }}</p>
                            <p><span class="font-semibold text-gray-900">Address:</span> {{ $parkingLot->address }}</p>
                            <p><span class="font-semibold text-gray-900">License Plate:</span> {{ $parkingLot->license_plate }}</p>
                            <div class="">
                                <!-- End Parking Button -->
                                <form action="{{route('parking.update', $parkingLot->lot_number)}}" method="POST" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <!-- lot number -->
                                    <input type="hidden" name="lot_number" value="{{ $parkingLot->lot_number }}">

                                    <button type="submit"
                                            value="{{$parkingLot->lot_number}}"
                                            class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 focus:outline-none focus:ring focus:ring-red-300">
                                        End Parking
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-100 p-4 rounded-lg shadow-md max-w-md mx-auto mt-6">
                    <h4 class="text-red-800 font-bold">Errors:</h4>
                    <ul class="list-disc list-inside text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        @endauth
</x-layout>
