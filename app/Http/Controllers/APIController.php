<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Establecimiento;
use Illuminate\Http\Request;

class APIController extends Controller
{
    public function categorias()
    {
        $categorias = Categoria::all();
        return response()->json($categorias);
    }

    public function categoria(Categoria $categoria)
    {
        $establecimientos = Establecimiento::where('categoria_id', $categoria->id)->with('categoria')->take(3)->get();
        return response()->json($establecimientos);
    }

    public function establecimiento(Establecimiento $establecimiento)
    {
        return response()->json($establecimiento);
    }
}
