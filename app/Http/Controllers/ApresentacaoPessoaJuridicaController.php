<?php

namespace App\Http\Controllers;

use App\ApresentacaoPessoaJuridica;
use App\PessoaJuridica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class ApresentacaoPessoaJuridicaController extends Controller
{

    public function register(Request $request)
    {
        $pessoa_juridica = PessoaJuridica::find($request->get('id'));

        $apresentacao_pessoa_juridica = $pessoa_juridica->apresentacao()->create([
            'apresentacao' => ''
        ]);

        return response()->json($apresentacao_pessoa_juridica, 201);
    }

    public function update(Request $request, $id)
    {
        $pessoa_juridica = PessoaJuridica::find($id);

        $pessoa_juridica_apresentacao = $pessoa_juridica->apresentacao()->update($request->all());

        return response()->json($pessoa_juridica_apresentacao, 201);
    }

    public function show($id)
    {
        $apresentacao = PessoaJuridica::find($id)->apresentacao;

        return response()->json($apresentacao, 201);
    }
}
