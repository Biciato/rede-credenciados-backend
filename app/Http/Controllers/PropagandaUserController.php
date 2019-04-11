<?php

namespace App\Http\Controllers;

use App\UserPropaganda;
use App\PropagandaUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PropagandaUserController extends Controller
{

    public function create(Request $request)
    {
        $userPropaganda = UserPropaganda::find($request->get('id'));

        $propagandaUser = $userPropaganda->propaganda()->create([
            'estados_lateral' => ($request->get('estados_lateral')),
            'estados_topo' => ($request->get('estados_topo')),
            'cidades_lateral' => ($request->get('cidades_lateral')),
            'cidades_topo' => ($request->get('cidades_topo')),
        ]);

        return response()->json($propagandaUser, 201);
    }

    public function update(Request $request, $id)
    {
        $userPropaganda = UserPropaganda::find($id);
        $propagandaUser = $userPropaganda->propaganda()->update($request->all());

        return response()->json($propagandaUser, 201);
    }

    public function show($id)
    {
        $propaganda = UserPropaganda::find($id)->propaganda;

        return response()->json($propaganda, 201);
    }

    public function index($cidade, $estado)
    {
        $cidadeDecoded = urldecode($cidade);
        $estadoDecoded = urldecode($estado);
        $propagandas_topo = PropagandaUser::where([
            ['cidades_topo', 'like', '%'.$cidadeDecoded.'%'],
            ['estados_topo', 'like', '%'.$estadoDecoded.'%']
        ])->get();
        $propagandas_lateral = PropagandaUser::where([
            ['cidades_lateral' , 'like', '%'.$cidadeDecoded.'%'],
            ['estados_lateral' , 'like', '%'.$estadoDecoded.'%']
        ])->get();

        return response()->json(array(
            $propagandas_topo, $propagandas_lateral
        ),201);
    }
}
