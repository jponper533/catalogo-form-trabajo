<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorito;
class DashboardController extends Controller
{
    public function index()
    {
        $fav = Favorito::where('username', session('username'))->get();
        return view('dashboard.index', compact('fav'));
    }
}