<?php

use Illuminate\Support\Facades\Route;

// Inisialisasi array untuk menyimpan pesanan sementara
$orders = [];

// Route untuk halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Route untuk menampilkan menu makanan
Route::get('/menu', function () {
    $menu = [
        ['id' => 1, 'name' => 'Nasi Goreng', 'price' => 15000],
        ['id' => 2, 'name' => 'Mie Goreng', 'price' => 12000],
        ['id' => 3, 'name' => 'Ayam Bakar', 'price' => 25000],
        ['id' => 4, 'name' => 'Sate Ayam', 'price' => 20000],
    ];

    return view('menu', ['menu' => $menu]);
});

// Route untuk menambahkan pesanan
Route::post('/order', function () use (&$orders) {
    $order = [
        'id' => uniqid(),
        'item' => request('item'),
        'quantity' => request('quantity'),
        'price' => request('price'),
        'total' => request('price') * request('quantity'),
        'status' => 'Belum Bayar', // Status awal pesanan
    ];

    array_push($orders, $order);

    return redirect('/orders')->with('success', 'Pesanan berhasil ditambahkan!');
});

// Route untuk menampilkan daftar pesanan
Route::get('/orders', function () use (&$orders) {
    return view('orders', ['orders' => $orders]);
});

// Route untuk menghapus pesanan
Route::delete('/order/{id}', function ($id) use (&$orders) {
    $orders = array_filter($orders, function ($order) use ($id) {
        return $order['id'] !== $id;
    });

    return redirect('/orders')->with('success', 'Pesanan berhasil dihapus!');
});

Route::get('/pay/{id}', function ($id) use (&$orders) {
    dd($orders); // Cek data pesanan
});

// Route untuk menampilkan halaman pembayaran
Route::get('/pay/{id}', function ($id) use (&$orders) {
    $order = collect($orders)->firstWhere('id', $id);

    if (!$order) {
        return redirect('/orders')->with('error', 'Pesanan tidak ditemukan!');
    }

    return view('pay', ['order' => $order]);
});

// Route untuk proses pembayaran
Route::post('/pay/{id}', function ($id) use (&$orders) {
    $orders = array_map(function ($order) use ($id) {
        if ($order['id'] === $id) {
            $order['status'] = 'Sudah Bayar'; // Update status pesanan
        }
        return $order;
    }, $orders);

    return redirect('/orders')->with('success', 'Pembayaran berhasil!');
});