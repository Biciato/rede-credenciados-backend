<?php

namespace App\Http\Controllers;

use App\Atividade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AtividadeController extends Controller
{

    public function register(Request $request)
    {
        $atividade = Atividade::create($request->all());

        return response()->json($atividade, 201);
    }

    public function index()
    {
        return response()->json(Atividade::all(), 201);
    }

    public function show($id)
    {
        return response()->json(Atividade::find($id), 201);
    }

    public function delete($id)
    {
        $atividade = Atividade::find($id);

        $atividade->delete();

        return response()->json($atividade, 201);
    }
}
