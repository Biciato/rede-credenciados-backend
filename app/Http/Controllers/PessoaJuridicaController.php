<?php

namespace App\Http\Controllers;

use App\User;
use App\PessoaJuridica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class PessoaJuridicaController extends Controller
{

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome_contato' => 'required|string|max:255',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::find($request->get('user_id'));

        $pessoa_juridica = $user->pessoaJuridica()->create($request->all());

        return response()->json($pessoa_juridica, 201);
    }

    public function show($id)
    {
        $pessoa_juridica = User::find($id)->pessoaJuridica;

        return response()->json($pessoa_juridica, 201);
    }

    public function update($id, Request $request)
    {
        $pessoa_juridica = PessoaJuridica::find($id);

        $pessoa_juridica->update($request->all());

        return response()->json($pessoa_juridica, 201);
    }

    // check CNPJ specific number existence
    public function checkCnpj(Request $request)
    {
        $pj = PessoaJuridica::where('cnpj', $request->get('cnpj'))->first();

        return response()->json($pj, 201);
    }
}
