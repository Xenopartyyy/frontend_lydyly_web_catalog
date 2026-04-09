<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{
    private $apiBaseUrl;
    private $apiAuthUrl;

    public function __construct()
    {
        $this->apiBaseUrl = config('app.backend_api_url');
        $this->apiAuthUrl = config('app.backend_auth_url');
    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        try {
            $response = Http::withOptions([
                'verify' => false
            ])->post("{$this->apiAuthUrl}/login", [
                'name'     => $request->name,
                'password' => $request->password,
            ]);

            if ($response->successful()) {
                $data = $response->json();

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

    public function logout()
    {
        Session::forget(['access_token', 'token_type', 'expires_in']);
        return redirect()->route('login');
    }

    public static function userIsAdmin()
    {
        $apiAuthUrl = config('app.backend_auth_url'); // static method, tidak bisa pakai $this
        $token = Session::get('access_token');
        if (!$token) return false;

        try {
            $response = Http::withOptions([
                'verify' => false
            ])->withToken($token)
                ->get("{$apiAuthUrl}/me");

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
