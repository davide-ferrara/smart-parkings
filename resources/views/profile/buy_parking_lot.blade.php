<x-layout>
    @php
        $time = new DateTime();
        $timezone = new DateTimeZone('Europe/Rome');
        $time->setTimezone($timezone);
        $now = $time->format('Y-m-d\TH:i');
        $time->add(new DateInterval('PT30M'));
        $formatted_time = $time->format('Y-m-d\TH:i');
    @endphp
    <!--
      Heads up! 👋

      Plugins:
        - @tailwindcss/forms
    -->

    <section class="bg-white">
        <h1>Parking information</h1>
        <h3>Your current credit: {{Auth::user()->credit['total']}}€</h3>
        <form action="/parking" method="POST">
            @csrf
            <div>
                <label for="LotNumber" class="block text-sm font-medium text-gray-700">
                    Lot number {{$lot_number}}
                </label>
                <input
                    hidden
                    value="{{$lot_number}}"
                    type="text"
                    id="LotNumber"
                    name="lot_number"
                    class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm"
                />
            </div>

            <div>
                <label for="startParking" class="block text-sm font-medium text-gray-700">
                    Start Parking
                </label>
                <input
                    type="datetime-local"
                    value="{{$now}}"
                    min="{{$now}}"
                    id="startParking"
                    name="start_parking"
                    class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm"
                />
            </div>

            <div>
                <label for="endParking" class="block text-sm font-medium text-gray-700">
                    End Parking
                </label>
                <input
                    type="datetime-local"
                    value="{{ $formatted_time }}"
                    id="endParking"
                    min="{{$now}}"
                    name="end_parking"
                    class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm"
                />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Select Car</label>
                <select name="car_id" id="carID" class="mt-1 w-full rounded-md border-gray-300 bg-white text-sm text-gray-700 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                    @foreach(Auth::user()->cars as $car)
                        <option value="{{ $car->id }}">{{ $car->model_name }}</option>
                    @endforeach
                </select>
            </div>

            <div>

                <input
                    value="{{Auth::user()->id}}"
                    type="hidden"
                    id="userId"
                    name="user_id"
                />
            </div>

            <div>
                <button
                    type="submit"
                    class="inline-block shrink-0 rounded-md border border-blue-600 bg-blue-600 px-12 py-3 text-sm font-medium text-white transition hover:bg-transparent hover:text-blue-600 focus:outline-none focus:ring active:text-blue-500"
                >
                    Buy
                </button>
            </div>
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
    </section>

</x-layout>
