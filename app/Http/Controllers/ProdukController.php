<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

use Illuminate\Support\Facades\Http;   // ✅ untuk API call
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;


class ProdukController extends Controller
{
    private $apiBaseUrl;

    public function __construct()
    {
        $this->apiBaseUrl = config('app.backend_api_url', 'https://139.255.116.18:8813/api/dashboard');
    }

    // public function index(Request $request)
    // {
    //     try {
    //         $apiurl = "{$this->apiBaseUrl}/produk";
    //         $token = Session::get('access_token');

    //         $response = Http::withHeaders([
    //             'Authorization' => 'Bearer ' . $token,
    //             'Accept' => 'application/json',
    //         ])->get($apiurl);
    //         if (!$response->successful()) {
    //             throw new Exception("API Produk tidak bisa diakses");
    //         }

    //         $result = $response->json();
    //         if (!$result['success']) {
    //             throw new Exception($result['message'] ?? "Gagal ambil data dari API Produk");
    //         }

    //         $produk = collect($result['data']);

    //         if ($request->ajax()) {
    //             return DataTables::of($produk)->make(true);
    //         }

    //         return view('produk.produk');
    //     } catch (Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Gagal load data produk',
    //             'error'   => $e->getMessage()
    //         ], 500);
    //     }
    // }
    public function index(Request $request)
    {
        try {
            $apiurl = "{$this->apiBaseUrl}/produk";
            $token = Session::get('access_token');

            // Request ke API backend
            if ($request->ajax()) {
                $response = Http::withoutVerifying()->withHeaders([
                    'Authorization' => 'Bearer ' . $token,
                    'Accept'        => 'application/json',

                ])->get($apiurl);

                if (!$response->successful()) {
                    throw new Exception("API Produk tidak bisa diakses");
                }

                $result = $response->json();
                if (!$result['success']) {
                    throw new Exception($result['message'] ?? "Gagal ambil data dari API Produk");
                }

                // Ambil data produk mentah
                // $produk = collect($result['data'])->map(function ($row) {
                // Pastikan array (kalau dari backend masih object)
                // $row = (array) $row;

                // Konversi harga & stok ke float
                // $row['HargaBeli']  = isset($row['HargaBeli']) ? (float) $row['HargaBeli'] : 0;
                // $row['HargaJual5'] = isset($row['HargaJual5']) ? (float) $row['HargaJual5'] : 0;
                // $row['YUAN']       = isset($row['YUAN']) ? (float) $row['YUAN'] : 0;
                // $row['StockAkhir'] = isset($row['StockAkhir']) ? (float) $row['StockAkhir'] : 0;

                // Limit deskripsi
                // $row['deskbrg'] = !empty($row['deskbrg']) ? Str::limit($row['deskbrg'], 50) : '-';

                // Foto barang (decode JSON dari backend)
                // if (!empty($row['fotobrg'])) {
                //     $images = json_decode($row['fotobrg'], true);
                //     if (json_last_error() === JSON_ERROR_NONE && is_array($images)) {
                //         $row['fotobrg'] = array_map(fn($path) => ltrim(str_replace('\\', '', trim($path)), '/'), $images);
                //     } else {
                //         $row['fotobrg'] = [];
                //     }
                // } else {
                //     $row['fotobrg'] = [];
                // }

                //     return $row;
                // });

                // Kalau request datang dari DataTables (AJAX)

                return DataTables::of($result['data'])->make(true);
            }

            // Kalau request biasa → return ke view
            return view('produk.produk');
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal load data produk',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }


    public function show($id)
    {
        try {
            $apiurl = "{$this->apiBaseUrl}/produk/{$id}";
            $token = Session::get('access_token');

            $response = Http::withoutVerifying()->withHeaders([
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
            ])->get($apiurl);

            if ($response->successful()) {
                $data = $response->json();

                return view('detail', [
                    'produk' => $data['data']['produk'] ?? null,
                    'images' => $data['data']['images'] ?? []
                ]);
            }

            return back()->with('error', 'API tidak mengembalikan response sukses');
        } catch (\Exception $e) {
            Log::error('Error fetching produk detail: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat mengambil detail produk');
        }
    }


    public function edit($id) // Tetap menggunakan $id karena dari route frontend
    {
        try {
            $apiurl = "{$this->apiBaseUrl}/produk/{$id}";
            $token = Session::get('access_token');

            $response = Http::withoutVerifying()->withHeaders([
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
            ])->get($apiurl);

            if ($response->successful()) {
                $data = $response->json();


                return view('produk.edit', [
                    'produk' => $data['data']['produk'] ?? null,
                    'images' => $data['data']['images'] ?? []
                ]);
            }

            return back()->with('error', 'API tidak mengembalikan response sukses');
        } catch (\Exception $e) {
            Log::error('Error fetching produk detail: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat mengambil detail produk');
        }
    }

    // public function update(Request $request, $id)
    // {
    //     try {
    //         $token = Session::get('access_token');

    //         // Debug token dulu - hapus setelah berhasil
    //         if (!$token) {
    //             return back()->with('error', 'Token tidak ditemukan di session');
    //         }

    //         $httpClient = Http::withoutVerifying()->withHeaders([
    //             'Authorization' => 'Bearer ' . $token,
    //             'Accept' => 'application/json',
    //         ])->asMultipart();

    //         // Add deleted images info
    //         if ($request->has('deleted_images')) {
    //             foreach ($request->input('deleted_images') as $index => $deletedImage) {
    //                 $httpClient = $httpClient->attach("deleted_images[{$index}]", $deletedImage);
    //             }
    //         }

    //         // Add new image files
    //         if ($request->hasFile('fotobrg')) {
    //             foreach ($request->file('fotobrg') as $index => $file) {
    //                 $httpClient = $httpClient->attach(
    //                     "fotobrg[{$index}]",
    //                     file_get_contents($file->getRealPath()),
    //                     $file->getClientOriginalName()
    //                 );
    //             }
    //         }

    //         // Sebelum $apiResponse = $httpClient->post(...)
    //         Log::info('Token: ' . $token);
    //         Log::info('URL: ' . "{$this->apiBaseUrl}/produk/{$id}");

    //         $apiResponse = $httpClient->post("{$this->apiBaseUrl}/produk/{$id}");

    //         if ($apiResponse->successful()) {
    //             return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui');
    //         } else {
    //             // Debug response - hapus setelah berhasil
    //             Log::error('API Error: ' . $apiResponse->body());

    //             $error = $apiResponse->json();
    //             return back()->withErrors($error['errors'] ?? [])->with('error', $error['message'] ?? 'Gagal memperbarui produk');
    //         }
    //     } catch (\Exception $e) {
    //         Log::error('Error updating produk: ' . $e->getMessage());
    //         return back()->with('error', 'Terjadi kesalahan saat memperbarui produk');
    //     }
    // }

    public function update(Request $request, $id)
    {
        try {
            $token = Session::get('access_token');

            // Debug token dulu - hapus setelah berhasil
            if (!$token) {
                return back()->with('error', 'Token tidak ditemukan di session');
            }

            $httpClient = Http::withoutVerifying()->withHeaders([
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
            ])->asMultipart();

            // Add deleted images info (sebagai field biasa, bukan file)
            if ($request->has('deleted_images')) {
                foreach ($request->input('deleted_images') as $index => $deletedImage) {
                    $httpClient = $httpClient->withOptions([
                        'multipart' => [
                            [
                                'name'     => "deleted_images[{$index}]",
                                'contents' => $deletedImage,
                            ]
                        ]
                    ]);
                }
            }

            // Add new image files
            if ($request->hasFile('fotobrg')) {
                foreach ($request->file('fotobrg') as $index => $file) {
                    $httpClient = $httpClient->attach(
                        "fotobrg[{$index}]",
                        file_get_contents($file->getRealPath()),
                        $file->getClientOriginalName()
                    );
                }
            }

            // Sebelum $apiResponse = $httpClient->post(...)
            Log::info('Token: ' . $token);
            Log::info('URL: ' . "{$this->apiBaseUrl}/produk/{$id}");

            $apiResponse = $httpClient->post("{$this->apiBaseUrl}/produk/{$id}");

            if ($apiResponse->successful()) {
                return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui');
            } else {
                // Debug response - hapus setelah berhasil
                Log::error('API Error: ' . $apiResponse->body());

                $error = $apiResponse->json();
                return back()->withErrors($error['errors'] ?? [])->with('error', $error['message'] ?? 'Gagal memperbarui produk');
            }
        } catch (\Exception $e) {
            Log::error('Error updating produk: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memperbarui produk');
        }
    }
}
