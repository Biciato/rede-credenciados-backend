<?php

namespace App\Http\Controllers;

use App\UsersPropaganda;
use App\PropagandaUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PropagandaUserController extends Controller
{

    public function create(Request $request)
    {
        $userPropaganda = UsersPropaganda::find($request->get('id'));

        $propagandaUser = $userPropaganda->propaganda()->create($request->all());

        return response()->json($propagandaUser, 201);
    }

    public function update(Request $request, $id)
    {
        $userPropaganda = UsersPropaganda::find($id);
        $propagandaUser = $userPropaganda->propaganda()->update($request->all());

        return response()->json($propagandaUser, 201);
    }

    public function show($id)
    {
        $propaganda = UsersPropaganda::find($id)->propaganda;

        return response()->json($propaganda, 201);
    }

    public function index($cidade, $estado)
    {
        // gets Propaganda index by cities and states
        $cidadeDecoded = urldecode($cidade);
        $estadoDecoded = urldecode($estado);
        $propagandas_topo = PropagandaUser::where([
            ['cidades_topo', 'like', '%'.$cidadeDecoded.'%'],
            ['estados_topo', 'like', '%'.$estadoDecoded.'%']
        ])->orWhere('cidades_topo', 'todos')->get();
        $propagandas_lateral = PropagandaUser::where([
            ['cidades_lateral' , 'like', '%'.$cidadeDecoded.'%'],
            ['estados_lateral' , 'like', '%'.$estadoDecoded.'%']
        ])->orWhere('cidades_lateral', 'todos')->get();

        return response()->json(array(
            $propagandas_topo, $propagandas_lateral
        ),201);
    }
}
