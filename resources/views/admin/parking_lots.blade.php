<x-layout>

    @section('content')

        <div class="main">

        <h1>All Parking Lots</h1>

        @if($parkingLots->isEmpty())
            <p>No parking lots available.</p>
        @else
            <table>
                <thead>
                <tr>
                    <th>lat</th>
                    <th>long</th>
                    <th>lot_number</th>
                    <th>status</th>
                    <th>address</th>
                </tr>
                </thead>
                <tbody>
                @foreach($parkingLots as $lot)
                    <tr>
                        <td>{{ $lot->lat }}</td>
                        <td>{{ $lot->lng }}</td>
                        <td>{{ $lot->lot_number }}</td>
                        <td>{{ $lot->status }}</td>
                        <td>{{ $lot->address }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-layout>
