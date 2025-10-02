<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{

    public function showLoginForm()
    {

        return view('login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        try {
            // Panggil API login (JWT) backend
            $response = Http::withOptions([
                'verify'        => false
            ])->post('https://139.255.116.18:8813/api/login', [
                'name' => $request->name,
                'password' => $request->password,
            ]);
            // dd($response);
            if ($response->successful()) {
                $data = $response->json();

                // Simpan token ke session
                Session::put('access_token', $data['access_token']);
                Session::put('token_type', $data['token_type'] ?? 'bearer');
                Session::put('expires_in', $data['expires_in'] ?? 3600);

                return redirect('/dashboard/lydyly2');
            }

            return back()->withErrors(['error' => 'Login gagal.']);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    // Logout
    public function logout()
    {
        Session::forget(['access_token', 'token_type', 'expires_in']);
        return redirect()->route('login');
    }

    public static function userIsAdmin()
    {
        $token = Session::get('access_token');
        if (!$token) return false;

        try {
            $response = Http::withOptions([
                'verify'        => false
            ])->withToken($token)
                ->get('https://139.255.116.18:8813/api/me');

            if ($response->successful()) {
                $user = $response->json();
                if (isset($user['name']) && str_contains(strtolower($user['name']), 'admin')) {
                    return true;
                }
            }
        } catch (\Exception $e) {
            return false;
        }

        return false;
    }
}
