<?php

namespace App\Http\Controllers;

use App\EnderecoPessoaFisica;
use App\PessoaFisica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class EnderecoPessoaFisicaController extends Controller
{

    public function register(Request $request)
    {

        $pessoa_fisica = PessoaFisica::find($request->get('id'));

        $endereco_pessoa_fisica = $pessoa_fisica->endereco()
            ->create($request->all());

        return response()->json($endereco_pessoa_fisica, 201);
    }

    public function update(Request $request, $id)
    {
        $pessoa_fisica = PessoaFisica::find($id);

        $pessoa_fisica_endereco = $pessoa_fisica->endereco()->update($request->all());

        return response()->json($pessoa_fisica_endereco, 201);
    }

    public function show($id)
    {
        $endereco = PessoaFisica::find($id)->endereco;

        return response()->json($endereco, 201);
    }


    public function index()
    {
        $enderecos = EnderecoPessoaFisica::all();

        return response()->json($enderecos, 201);
    }
}
