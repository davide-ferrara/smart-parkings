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

    <section>
        <div class="flex justify-center py-12">
            <div class="w-full max-w-lg p-6 bg-white shadow-lg rounded-xl border border-gray-200">
                <div class="mb-6 text-center">
                    <h3 class="text-2xl font-bold text-blue-600">Buy Parking</h3>
                </div>
                <div class="text-gray-700">
                    <h3 class="text-gray-900">Your current credit: {{Auth::user()->credit['total']}}€</h3>
                    <h3 class="text-gray-900">Lot number {{$lot_number}}</h3>

                    <div>
                        <form action="/parking" method="POST" class="space-y-2">
                            @csrf
                            <div>
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
                                <x-label for="startParking">
                                    Start Parking
                                </x-label>
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
                                <x-label for="endParking">
                                    End Parking
                                </x-label>
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
                                <x-label>Select Car</x-label>
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
                                    class="w-full inline-block shrink-0 rounded-md border border-blue-600 bg-blue-600 px-12 py-3 text-sm font-medium text-white transition hover:bg-transparent hover:text-blue-600 focus:outline-none focus:ring active:text-blue-500"
                                >
                                    Buy
                                </button>
                            </div>
                        </form>
                </div>
                    <div class="text-center py-2">
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
                    </div>
            </div>
        </div>
        </div>
    </section>

</x-layout>
