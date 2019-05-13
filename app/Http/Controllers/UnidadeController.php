<?php

namespace App\Http\Controllers;

use App\PessoaJuridica;
use App\Unidade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UnidadeController extends Controller
{

    public function list($id)
    {
        $list = PessoaJuridica::find($id)->unidades;

        return response()->json($list, 201);
    }

    public function update($id, Request $request)
    {
        $unidade = Unidade::find($id);

        $unidade->update($request->all());

        return response()->json($unidade, 201);
    }

    // checks CNPJ specific number existence
    public function checkCnpj(Request $request)
    {
        $unidade = Unidade::where('cnpj', $request->get('cnpj'))->first();

        return response()->json($unidade, 201);
    }
}
