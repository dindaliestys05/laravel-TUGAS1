<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h1 {
            color: #333;
        }
        .payment-details {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .btn {
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<h1>Pembayaran</h1>
    @if (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif
    <p>Item: {{ $order['item'] }}</p>
    <p>Jumlah: {{ $order['quantity'] }}</p>
    <p>Total Harga: Rp {{ number_format($order['total'], 0, ',', '.') }}</p>
    <p>Status: {{ $order['status'] }}</p>
    <form action="/pay/{{ $order['id'] }}" method="POST">
        @csrf
        <button type="submit">Bayar Sekarang</button>
    </form>
    <p><a href="/orders">Kembali ke Daftar Pesanan</a></p
</body>
</html>