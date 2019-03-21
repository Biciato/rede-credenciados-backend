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
        /*
        $validator = Validator::make($request->all(), [
            'apresentacao' => 'required|text|max:255', 
        ]);
        

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        */

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

    public function showResumo($id)
    {
        $apresentacao = PessoaJuridica::find($id)->apresentacao;

        return response()->json($apresentacao, 201);
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
}