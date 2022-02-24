<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cidade;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CidadeController extends Controller
{

    public function index(Request $request): JsonResponse
    {
        $cidades = Cidade::where('estado_id', $request->estado_id)->get();
        return response()->json($cidades);
    }

}
