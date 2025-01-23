<x-layout>

    <div class="flex justify-center py-12">

        <div class="w-full max-w-lg p-6 bg-white shadow-lg rounded-xl border border-gray-200">
            <div class="mb-6 text-center">
                <h3 class="text-2xl font-bold text-blue-600">Credit Page</h3>
                <h3>Your current credit: {{Auth::user()->credit['total']}}€</h3>
            </div>

            <div class="text-gray-700">
                <div class="justify-center">
                    <form method="POST" action="{{ url('profile/credit/' . Auth::user()->id) }}" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div class="flex justify-between">
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
                                step=".01"
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
                    <div class="text-center py-4">
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
                            document.getElementById("Quantity").value = currQty + 1.0;
                        }

                        function decrement() {
                            currQty = Number(document.getElementById("Quantity").value);
                            if(currQty > 1.0)
                                document.getElementById("Quantity").value = currQty - 1.0;
                        }
                    </script>

                </div>
            </div>
        </div>
    </div>

</x-layout>
