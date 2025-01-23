<x-layout>

        <div class="main px-6 py-4">
            <h1 class="text-2xl font-bold mb-4">Parking Lots</h1>

        @if($parkingLots->isEmpty())
            <p>No parking lots available.</p>
        @else
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200 shadow-md rounded-lg">
                        <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Lat</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Long</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Lot Number</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Status</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Zone ID</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Address</th>
                            <th class="px-4 py-2 text-center text-sm font-medium text-gray-700">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y">
                        @foreach($parkingLots as $lot)
                            <tr class="hover:bg-gray-100">
                                <td class="px-4 py-2 text-sm text-gray-800">{{ $lot->lat }}</td>
                                <td class="px-4 py-2 text-sm text-gray-800">{{ $lot->lng }}</td>
                                <td class="px-4 py-2 text-sm text-gray-800">{{ $lot->lot_number }}</td>
                                <td class="px-4 py-2 text-sm text-gray-800">{{ $lot->curr_status }}</td>
                                <td class="px-4 py-2 text-sm text-gray-800">{{ $lot->zone_id}}</td>
                                <td class="px-4 py-2 text-sm text-gray-800">{{ $lot->address }}</td>
                                <td class="px-4 py-2 text-center">
                                    <!-- Edit Button -->
                                    <form action="{{ url("admin/parking/update/" . $lot->lot_number) }}" method="GET" class="inline">
                                        @csrf
                                        <button type="submit"
                                                class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-300">
                                            Edit
                                        </button>
                                    </form>
                                    <!-- Delete Button -->
                                    <form action="{{ url("admin/parking/" . $lot->lot_number) }}" method="POST" class="inline">
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
    </div>
</x-layout>
