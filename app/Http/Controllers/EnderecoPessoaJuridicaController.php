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
        /*
        $validator = Validator::make($request->all(), [
            'cep' => 'required|string|max:255',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        */

        $pessoa_juridica = PessoaJuridica::find($request->get('id'));

        $endereco_pessoa_juridica = $pessoa_juridica->endereco()->create([
            'cep' => $request->get('cep'),
            'rua' => $request->get('rua'),
            'numero' => $request->get('numero'),
            'complemento' => $request->get('complemento'),
            'bairro' => $request->get('bairro'),
            'cidade' => $request->get('cidade'),
            'estado' => $request->get('estado')
        ]);

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
        $enderecos = EnderecoPessoaJuridica::all();

        return response()->json($enderecos, 201);
    }
}
