<?php

namespace App\Http\Controllers;

use App\ApresentacaoUnidade;
use App\Unidade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class ApresentacaoUnidadeController extends Controller
{

    public function update(Request $request, $id)
    {
        $unidade = Unidade::find($id);

        $unidade_apresentacao = $unidade->apresentacao()->update($request->all());

        return response()->json($unidade_apresentacao, 201);
    }

    public function show($id)
    {
        $apresentacao = Unidade::find($id)->apresentacao;

        return response()->json($apresentacao, 201);
    }

}
