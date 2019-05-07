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

        $endereco_pessoa_fisica = $pessoa_fisica->endereco()->create([
            'cep' => $request->get('cep'),
            'rua' => $request->get('rua'),
            'numero' => $request->get('numero'),
            'complemento' => $request->get('complemento'),
            'bairro' => $request->get('bairro'),
            'cidade' => $request->get('cidade'),
            'estado' => $request->get('estado')
        ]);

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

    public function getAuthenticatedUser()
    {
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                    return response()->json(['user_not_found'], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        return response()->json(compact('user'));
    }

    public function index()
    {
        $enderecos = EnderecoPessoaFisica::all();

        return response()->json($enderecos, 201);
    }
}
