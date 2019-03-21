<?php

namespace App\Http\Controllers;

use App\PessoaJuridica;
use App\PropagandaPessoaJuridica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class PropagandaPessoaJuridicaController extends Controller
{

    public function create(Request $request)
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

        $propaganda_pessoa_juridica = $pessoa_juridica->propaganda()->create([
            'estados_lateral' => ($request->get('estados_lateral')),
            'estados_topo' => ($request->get('estados_topo')),
            'cidades_lateral' => ($request->get('cidades_lateral')),
            'cidades_topo' => ($request->get('cidades_topo')),
        ]);

        return response()->json($propaganda_pessoa_juridica, 201);
    }

    public function update(Request $request, $id)
    { 
        $propaganda_pessoa_juridica = PropagandaPessoaJuridica::find($id)->update($request->all());

        return response()->json($propaganda_pessoa_juridica, 201);
    }

    public function show($id) 
    {
        $propaganda = PessoaJuridica::find($id)->propaganda;

        return response()->json($propaganda, 201);
    }
}