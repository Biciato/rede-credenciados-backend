<?php

namespace App\Http\Controllers;

use App\UsersPropaganda;
use App\Mensagem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UsersPropagandaController extends Controller
{

    public function register(Request $request)
    {
        $userPropaganda = UsersPropaganda::create([
            'nome' => $request->get('nome'),
            'email' => $request->get('email'),
            'tel' => $request->get('tel'),
            'cep' => $request->get('cep'),
            'rua' => $request->get('rua'),
            'numero' => $request->get('numero'),
            'complemento' => $request->get('complemento'),
            'bairro' => $request->get('bairro'),
            'cidade' => $request->get('cidade'),
            'estado' => $request->get('estado'),
        ]);

        return response()->json($userPropaganda, 201);
    }

    public function show($id)
    {
        $userPropaganda = UsersPropaganda::find($id);

        return response()->json($userPropaganda, 201);
    }

    public function index()
    {
        $usersPropagandas = UsersPropaganda::all();

        return response()->json($usersPropagandas, 201);
    }

    public function checkUserEmail($email) {
        $user = User::where('email', $email)->first();

        return response()->json($user, 201);
    }
}
