<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Establecimiento;
use App\Models\Imagen;
use App\Models\Categoria;

class ApiController extends Controller
{
    // Método para obtener todos los establecimientos
    public function establecimientos()
    {
        $establecimientos = Establecimiento::with('categoria')->get();
        return response()->json($establecimientos);
    }

    // Muestra un establecimiento en especifico
    public function establecimiento(Establecimiento $establecimiento)
    {
        $imagenes = Imagen::where('id_establecimiento', $establecimiento->uuid)->get();
        $establecimiento->imagenes = $imagenes;
        return response()->json($establecimiento);
    }

    // Método para obtener todas las categorias
    public function categorias()
    {
        $categorias = Categoria::all();
        return response()->json($categorias);
    }

    // Muestra los establecimientos de la categoria en especifico
    public function categoria(Categoria $categoria)
    {
        $establecimientos = Establecimiento::where('categoria_id', $categoria->id)->with('categoria')->take(3)->get();
        return response()->json($establecimientos);
    }

    public function establecimientosPorCategoria(Categoria $categoria)
    {
        $establecimientos = Establecimiento::where('categoria_id', $categoria->id)->with('categoria')->get();
        return response()->json($establecimientos);
    }
}
