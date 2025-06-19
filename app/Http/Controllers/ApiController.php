<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http; // Import facade Http untuk menggunakan Guzzle

class ApiController extends Controller
{
    public function getApiData()
    {
        try {
            $response = Http::get('https://jsonplaceholder.typicode.com/posts/1');
            // Memeriksa apakah request berhasil
            if ($response->successful()) {
                $data = $response->json(); // Mengubah response menjadi format JSON
                return view('api_view', ['data' => $data]); // Kirim data ke view
            } else {
                // Menangani error jika request gagal
                return 'Terjadi kesalahan saat mengambil data dari API.';
            }
        } catch (\Exception $e) {
            // Menangani exception yang mungkin terjadi
            return 'Terjadi kesalahan: ' . $e->getMessage();
        }
    }
}