<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorito;

class FavoritoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fav = Favorito::all();
        return view('favorito.index', compact('fav'));
    }

public function toggle(Request $request, Favorito $favorito)
{
    $username = session('username');
    
    $isAjax = $request->expectsJson();

    if ($request->has('activo')) {
        Favorito::firstOrCreate([
            'formulario_id' => $favorito->formulario_id,
            'username' => $username,
        ]);
        $activo = true;
    } else {
        Favorito::where('formulario_id', $favorito->formulario_id)
            ->where('username', $username)
            ->delete();
        $activo = false;
    }

    if ($isAjax) {
        return response()->json([
            'success' => true,
            'activo' => $activo
        ]);
    }

    return redirect()->back();
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
