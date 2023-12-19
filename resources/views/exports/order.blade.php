<table>
    <thead>
        <tr>
            <th>Nomor Order</th>
            <th>Nama</th>
            <th>Nomor Telepon</th>
            <th>Mobil</th>
            <th>Nomor Plat</th>
            <th>Tanggal Mulai</th>
            <th>Tanggal Selesai</th>
            <th>Waktu</th>
            <th>Lokasi Pengambilan</th>
            <th>Lokasi Pengembalian</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr>
            <td>{{ $order->order_number }}</td>
            <td>{{ $order->user->fullname }}</td>
            <td>{{ $order->user->customer->phone_number }}</td>
            <th>{{ $order->car->name }}</th>
            <th>{{ $order->car->number_plate }}</th>
            <th>{{ $order->start_date }}</th>
            <th>{{ $order->end_date }}</th>
            <th>{{ $order->pickup_time }}</th>
            <th>{{ $order->pickup_location ? $order->pickup_location : "Tempat Rental" }}</th>
            <th>{{ $order->dropoff_location ? $order->pickup_location : "Tempat Rental" }}</th>
            <th>{{ $order->order_status }}</th>
        </tr>
        @endforeach
    </tbody>
</table>