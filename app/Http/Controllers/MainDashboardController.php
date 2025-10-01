<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class MainDashboardController extends Controller
{
    private $apiBaseUrl;

    public function __construct()
    {
        $this->apiBaseUrl = config(
            'app.backend_api_url',
            'http://139.255.116.18:8813/api/dashboard'
        );
    }

    public function index()
    {
        try {
            // Simpan API result ke cache 60 detik
            $apiUrl = "{$this->apiBaseUrl}/lydyly2";
            $data = Cache::remember('dashboard_data', 60, function () use ($apiUrl) {
                $token = Session::get('access_token');

                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $token,
                    'Accept' => 'application/json',
                ])->get($apiUrl);

                return $response->successful() ? $response->json() : [];
            });

            // Debug log supaya tahu isi data
            Log::info('Dashboard API response:', $data);

            $kategori        = $data['kategori'] ?? [];
            $produk          = $data['total_produk'] ?? 0;
            $produkaktif     = is_array($data['produk_aktif'] ?? null) ? count($data['produk_aktif']) : ($data['produk_aktif'] ?? 0);
            $produknonaktif  = is_array($data['produk_nonaktif'] ?? null) ? count($data['produk_nonaktif']) : ($data['produk_nonaktif'] ?? 0);
            $categories      = $data['categories'] ?? [];

            return view("dashboard", compact(
                'kategori',
                'produk',
                'produkaktif',
                'produknonaktif',
                'categories'
            ));
        } catch (\Exception $e) {
            Log::error('Error in MainDashboardController: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat mengambil data dashboard');
        }
    }
}
