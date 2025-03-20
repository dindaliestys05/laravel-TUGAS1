@extends('layouts.app')

@section('content')
    <h1>Keranjang Belanja</h1>
    @if(session('cart'))
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach(session('cart') as $id => $details)
                    <tr>
                        <td>{{ $details['name'] }}</td>
                        <td>{{ $details['quantity'] }}</td>
                        <td>Rp {{ number_format($details['price'], 2) }}</td>
                        <td>Rp {{ number_format($details['price'] * $details['quantity'], 2) }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <form action="{{ route('checkout') }}" method="POST">
            @csrf
            <button type="submit">Checkout</button>
        </form>
    @else
        <p>Keranjang belanja Anda kosong.</p>
    @endif
@endsection