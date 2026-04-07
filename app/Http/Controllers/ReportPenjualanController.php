<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Exception;

class ReportPenjualanController extends Controller
{
    private $apiBaseUrl;

    public function __construct()
    {
        $this->apiBaseUrl = config('app.backend_api_url', 'https://139.255.116.18:8813/api/dashboard');
    }

    public function index()
    {
        try {
            $token = Session::get('access_token');

            // Ambil list gudang untuk dropdown
            $responseGudang = Http::withoutVerifying()->withHeaders([
                'Authorization' => 'Bearer ' . $token,
                'Accept'        => 'application/json',
            ])->get("{$this->apiBaseUrl}/report/gudang");

            $gudang = [];
            if ($responseGudang->successful()) {
                $result = $responseGudang->json();
                $gudang = $result['data'] ?? [];
            }

            return view('report.penjualan-periode', [
                'gudang' => $gudang,
            ]);
        } catch (Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function getData(Request $request)
    {
        try {
            $token     = Session::get('access_token');
            $warehouse = $request->query('warehouse');
            $year      = $request->query('year', date('Y'));

            $response = Http::withoutVerifying()->withHeaders([
                'Authorization' => 'Bearer ' . $token,
                'Accept'        => 'application/json',
            ])->get("{$this->apiBaseUrl}/report/penjualan-periode", [
                'warehouse' => $warehouse,
                'year'      => $year,
            ]);

            if (!$response->successful()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal mengambil data dari backend',
                ], 500);
            }

            return response()->json($response->json());
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
