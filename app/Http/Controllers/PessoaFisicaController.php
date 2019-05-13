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

        $pessoa_fisica = $user->pessoaFisica()->create($request->all());

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

    // check Cpf existence
    public function checkCpf(Request $request)
    {
        $cpf = PessoaFisica::where('cpf', $request->get('cpf'))->first();

        return response()->json($cpf, 201);
    }
}
