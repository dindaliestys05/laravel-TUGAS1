@extends('layouts.app')

@section('content')
    <h1>Daftar Makanan</h1>
    @foreach($foods as $food)
        <div>
            <h2>{{ $food->name }}</h2>
            <p>Rp {{ number_format($food->price, 2) }}</p>
            <img src="{{ asset('images/' . $food->image) }}" alt="{{ $food->name }}" width="100">
            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $food->id }}">
                <button type="submit">Tambah ke Keranjang</button>
            </form>
        </div>
    @endforeach
@endsection