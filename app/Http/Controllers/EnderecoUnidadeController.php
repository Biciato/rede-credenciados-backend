<?php

namespace App\Http\Controllers;

use App\EnderecoUnidade;
use App\Unidade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class EnderecoUnidadeController extends Controller
{

    public function update(Request $request, $id)
    { 
        $unidade = Unidade::find($id);

        $unidade_endereco = $unidade->endereco()->update($request->all());

        return response()->json($unidade_endereco, 201);
    }

    public function show($id) 
    {
        $endereco = Unidade::find($id)->endereco;

        return response()->json($endereco, 201);
    }

}