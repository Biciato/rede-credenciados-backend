<?php

namespace App\Http\Controllers;

use App\User;
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
        $user = User::find($request->get('id'));

        $propaganda_pessoa_juridica = $user->propaganda()->create($request->all());

        return response()->json($propaganda_pessoa_juridica, 201);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $propaganda_pessoa_juridica = $user->propaganda()->update($request->all());

        return response()->json($propaganda_pessoa_juridica, 201);
    }

    public function show($id)
    {
        $propaganda = User::find($id)->propaganda;

        return response()->json($propaganda, 201);
    }

    public function index($cidade, $estado)
    {
        // gets Propaganda index by cities and states
        $cidadeDecoded = urldecode($cidade);
        $estadoDecoded = urldecode($estado);
        $propagandas_topo = PropagandaPessoaJuridica::where([
            ['cidades_topo', 'like', '%'.$cidadeDecoded.'%'],
            ['estados_topo', 'like', '%'.$estadoDecoded.'%']
        ])->orWhere('cidades_topo', 'todos')->get();
        $propagandas_lateral = PropagandaPessoaJuridica::where([
            ['cidades_lateral' , 'like', '%'.$cidadeDecoded.'%'],
            ['estados_lateral' , 'like', '%'.$estadoDecoded.'%']
        ])->orWhere('cidades_lateral', 'todos')->get();

        return response()->json(array(
            $propagandas_topo, $propagandas_lateral
        ),201);
    }
}
