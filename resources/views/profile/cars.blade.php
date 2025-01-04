<x-layout>

    @section('content')

        <div class="main px-6 py-4">
            <h1 class="text-2xl font-bold mb-4">Registered cars</h1>

            @if($cars->isEmpty())
                <p>No cars registered.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200 shadow-md rounded-lg">
                        <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Car Model</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">License Plate</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y">
                        @foreach($cars as $car)
                            <tr class="hover:bg-gray-100">
                                <td class="px-4 py-2 text-sm text-gray-800">{{ $car->model_name }}</td>
                                <td class="px-4 py-2 text-sm text-gray-800">{{ $car->license_plate }}</td>
                                <td class="px-4 py-2 text-center">
                                    <!-- Edit Button -->
                                    <form action="{{ route('cars.update_view', $car->id) }}" method="GET" class="inline">
                                        @csrf
                                        <button type="submit"
                                                class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-300">
                                            Edit
                                        </button>
                                    </form>
                                    <!-- Delete Button -->
                                    <form action="{{ route('cars.destroy', $car->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                onclick="return confirm('Are you sure you want to delete this parking lot?')"
                                                class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 focus:outline-none focus:ring focus:ring-red-300">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
            <form action="{{ url('/profile/cars/register') }}" method="GET" class="inline">
                @csrf
                <button type="submit"
                        class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-300">
                    Register a new car
                </button>
            </form>
        </div>
</x-layout>
