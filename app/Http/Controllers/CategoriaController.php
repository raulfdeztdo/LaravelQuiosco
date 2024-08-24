<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoriaCollection;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function index()
    {
        return new CategoriaCollection(Categoria::all());
    }
}
