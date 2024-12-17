<x-layout>
{{--    <div class="main">

        <h1>Your credit is: {{Auth::user()->credit['total']}} Euro</h1>

        <form method="POST" action="{{ url('profile/credit/' . Auth::user()->id) }}">
            @csrf
            @method('PUT')

            <x-form-input type="number" name="total" placeholder="5" value="5"></x-form-input>

            <x-button type="submit">Add founds</x-button>

        </form>

        @if(session('success'))
            <p>{{ session('success') }}</p>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    </div>--}}
    <div class="flex-auto flex flex-col items-center text-center m-10 rounded-md  text-3xl space-y-6">
        <h1 class="font-bold text-gray-800">Your total credit:</h1>
        <h2 class="text-blue-600">{{ Auth::user()->credit['total'] }}€</h2>

        <form method="POST" action="{{ url('profile/credit/' . Auth::user()->id) }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="flex items-center space-x-2">
                <button
                    type="button"
                    onclick="decrement()"
                    class="h-10 w-10 flex items-center justify-center rounded border border-gray-300 bg-gray-100 text-gray-500 hover:bg-blue-600 hover:text-white"
                >
                    &minus;
                </button>

                <input
                    name="total"
                    type="number"
                    id="Quantity"
                    value="1"
                    class="h-10 w-16 rounded border-blue-600 text-center [-moz-appearance:_textfield] sm:text-sm [&::-webkit-inner-spin-button]:m-0 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:m-0 [&::-webkit-outer-spin-button]:appearance-none"/>

                <button
                    type="button"
                    onclick="increment()"
                    class="h-10 w-10 flex items-center justify-center rounded border border-gray-300 bg-gray-100 text-gray-500 hover:bg-blue-600 hover:text-white"
                >
                    &plus;
                </button>
            </div>

            <button
                type="submit"
                class="w-full rounded-md bg-blue-600 px-6 py-3 text-sm font-medium text-white transition hover:bg-transparent hover:border hover:border-blue-600 hover:text-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600"
            >
                Buy credit
            </button>
        </form>
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


        <script>
            function increment() {
                currQty = Number(document.getElementById("Quantity").value);
                document.getElementById("Quantity").value = currQty + 1;
            }

            function decrement() {
                currQty = Number(document.getElementById("Quantity").value);
                if(currQty > 1)
                    document.getElementById("Quantity").value = currQty - 1;
            }
        </script>

    </div>


</x-layout>
