@extends('layouts.app')

@section('content')
    <h1>Detail Pesanan #{{ $order->id }}</h1>
    <p>Total Harga: Rp {{ number_format($order->total_price, 2) }}</p>
    <h2>Item Pesanan</h2>
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->orderItems as $item)
                <tr>
                    <td>{{ $item->food->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>Rp {{ number_format($item->price, 2) }}</td>
                    <td>Rp {{ number_format($item->price * $item->quantity, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
