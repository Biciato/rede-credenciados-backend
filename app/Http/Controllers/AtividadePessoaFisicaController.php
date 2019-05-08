<?php

namespace App\Http\Controllers;

use App\AtividadePessoaFisica;
use App\PessoaFisica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AtividadePessoaFisicaController extends Controller
{

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'atividades' => [0]
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $pessoa_fisica = PessoaFisica::find($request->get('pf_id'));

        $atividade_pessoa_fisica = $pessoa_fisica->atividade()->create([
            'atividades' => $request->get('atividades')
        ]);

        return response()->json($atividade_pessoa_fisica, 201);
    }

    public function update(Request $request, $id)
    {
        $pessoa_fisica = PessoaFisica::find($id);

        $pessoa_fisica_atividade = $pessoa_fisica->atividade()->update(['atividades' => $request->get('atividades')]);

        return response()->json($pessoa_fisica_atividade, 201);
    }

    public function show($id)
    {
        $pessoa_fisica_atividade = PessoaFisica::find($id)->atividade;

        return response()->json($pessoa_fisica_atividade, 201);
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
