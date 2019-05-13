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

}
