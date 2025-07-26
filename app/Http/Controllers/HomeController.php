<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class HomeController extends Controller
{
    public function index()
    {
        $productos = Producto::orderBy('created_at', 'desc')->take(8)->get();
        return view('home', compact('productos'));
    }
}
