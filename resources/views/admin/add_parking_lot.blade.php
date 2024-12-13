<x-layout>
    <div id="parkingMapContainer" class="parkingMapContainer">
        <div id="parkingMap" class="ParkingMap"></div>
    </div>

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
    @endif

    <form method="POST" action="parking_lot">
        @csrf
        <x-form-input type="number" name="lat" id="flat" step="any" placeholder="Latitude" required></x-form-input>

        <x-form-input type="number" name="lng" id="flng" step="any" placeholder="Longitude" required></x-form-input>

        <x-button type="button" id="getFromMapBtn">Get from Map</x-button>

        <x-form-input type="number" name="lot_number" id="flot_number" placeholder="Parking Lot Number" required></x-form-input>

        <x-form-input type="text" name="address" id="faddress" placeholder="Address"></x-form-input>

        <x-button type="submit">Add</x-button>

    </form>
    <script rel="text/javascript" src="{{ asset('js/addParking.js') }}"></script>

</x-layout>
