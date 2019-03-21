<?php

namespace App\Http\Controllers;

use App\ApresentacaoPessoaFisica;
use App\PessoaFisica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class ApresentacaoPessoaFisicaController extends Controller
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

        $pessoa_fisica = PessoaFisica::find($request->get('id'));

        $apresentacao_pessoa_fisica = $pessoa_fisica->apresentacao()->create([
            'apresentacao' => ''
        ]);

        return response()->json($apresentacao_pessoa_fisica, 201);
    }

    public function update(Request $request, $id)
    { 
        $pessoa_fisica = PessoaFisica::find($id);

        $pessoa_fisica_apresentacao = $pessoa_fisica->apresentacao()->update($request->all());

        return response()->json($pessoa_fisica_apresentacao, 201);
    }

    public function show($id) 
    {
        $apresentacao = PessoaFisica::find($id)->apresentacao;

        return response()->json($apresentacao, 201);
    }

    public function showResumo($id)
    {
        $apresentacao = PessoaFisica::find($id)->apresentacao;

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