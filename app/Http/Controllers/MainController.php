<?php

namespace App\Http\Controllers;
use App\Models\Produk;
use Illuminate\Http\Request;



class MainController extends Controller
{

    public function index()
    {
        $produk = Produk::all();
        return view("beranda", compact('produk'));
    }
    
    
    


}
    