<?php

namespace App\Http\Controllers;

use App\AtividadeUnidade;
use App\Unidade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AtividadeUnidadeController extends Controller
{

    public function register(Request $request)
    {

        $pessoa_juridica = PessoaJuridica::find($request->get('pj_id'));

        $atividade_pessoa_juridica = $pessoa_juridica->atividade()->create([
            'atividades' => $request->get('atividades')
        ]);

        return response()->json($atividade_pessoa_juridica, 201);
    }

    public function update(Request $request, $id)
    { 
        $unidade = Unidade::find($id);

        $atividade_unidade = $unidade->atividade()->update(['atividades' => $request->get('atividades')]);

        return response()->json($atividade_unidade, 201);
    }

    public function show($id) 
    {
        $atividade_unidade = Unidade::find($id)->atividade;

        return response()->json($atividade_unidade, 201);
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