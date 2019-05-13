<?php

namespace App\Http\Controllers;

use App\User;
use App\EnderecoPessoaJuridica;
use App\PessoaJuridica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class EnderecoPessoaJuridicaController extends Controller
{

    public function register(Request $request)
    {
        $pessoa_juridica = PessoaJuridica::find($request->get('id'));

        $endereco_pessoa_juridica = $pessoa_juridica->endereco()->create($request->all());

        return response()->json($endereco_pessoa_juridica, 201);
    }

    public function update(Request $request, $id)
    {
        $pessoa_juridica = PessoaJuridica::find($id);

        $pessoa_juridica_endereco = $pessoa_juridica->endereco()->update($request->all());

        return response()->json($pessoa_juridica_endereco, 201);
    }

    public function show($id)
    {
        $endereco = PessoaJuridica::find($id)->endereco;

        return response()->json($endereco, 201);
    }

    public function index()
    {
        $enderecos = EnderecoPessoaJuridica::all();

        return response()->json($enderecos, 201);
    }
}
