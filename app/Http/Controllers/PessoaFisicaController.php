<?php

namespace App\Http\Controllers;

use App\User;
use App\PessoaFisica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Carbon\Carbon;

class PessoaFisicaController extends Controller
{

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::find($request->get('user_id'));

        $pessoa_fisica = $user->pessoaFisica()->create([
            'nome' => $request->get('nome'),
            'rg' => $request->get('rg'),
            'cpf' => $request->get('cpf'),
            'nascimento' => $request->get('nascimento'),
            'sexo' => $request->get('sexo'),
            'email' => $request->get('email'),
            'email2' => $request->get('email2'),
            'tel' => $request->get('tel'),
            'tel2' => $request->get('tel2'),
            'cel' => $request->get('cel'),
            'cel2' => $request->get('cel2'),
        ]);

        return response()->json($pessoa_fisica, 201);
    }

    public function show($id)
    {
        $pessoa_fisica = User::find($id)->pessoaFisica;

        return response()->json($pessoa_fisica, 201);
    }

    public function update($id, Request $request)
    {
        $pessoa_fisica = PessoaFisica::find($id);

        $pessoa_fisica->update($request->all());

        return response()->json($pessoa_fisica, 201);
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

    public function checkCpf(Request $request)
    {
        $cpf = PessoaFisica::where('cpf', $request->get('cpf'))->first();

        return response()->json($cpf, 201);
    }
}
