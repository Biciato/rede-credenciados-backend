<?php

namespace App\Http\Controllers;

use App\Mensagem;
use App\PessoaFisica;
use App\PessoaJuridica;
use App\EnderecoPessoaFisica;
use App\EnderecoPessoaJuridica;
use App\AtividadePessoaFisica;
use App\AtividadePessoaJuridica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class MensagemController extends Controller
{

    public function mensagensUser($id, $tipoPessoa)
    {
        if ($tipoPessoa === 'pessoa_fisica') {
            $pessoaFisica = PessoaFisica::where('user_id', $id)->first();
            $endereco = $pessoaFisica->endereco()->first();
            $atividade = $pessoaFisica->atividade()->first();
        } else {
            $pessoaJuridica = PessoaJuridica::where('user_id', $id)->first();
            $endereco = $pessoaJuridica->endereco()->first();
            $atividade = $pessoaJuridica->atividade()->first();
        }

        $mensagens = Mensagem::where([
            ['especialidades', 'like', '%'.$atividade->atividades.'%'],
            ['cidades' , 'like', '%'.$endereco->cidade.'%'],
            ['estados' , 'like', '%'.$endereco->estado.'%']
        ])->orWhere([
            ['especialidades', '=', ''],
            ['cidades' , '=', ''],
            ['estados' , '=', ''],
        ])->get();

        $mensagensArr = [];
        if (!empty($mensagens)) {
            foreach ($mensagens as $mensagem) {
                $msgObj = (object) [
                    'id' => $mensagem->id,
                    'titulo' => $mensagem->titulo,
                    'mensagem' => $mensagem->mensagem,
                    'mensagem_lida' => explode(',', $mensagem->mensagem_lida)
                ];
                array_push($mensagensArr, $msgObj);
            }
        }

        return response()->json($mensagens, 201);
    }

    public function update($id, Request $request)
    {
        $mensagem = Mensagem::find($id);

        if ($mensagem->mensagem_lida === NULL ) {
            $mensagem->update(['mensagem_lida' => $request->get('mensagem_lida')]);
        } elseif (!in_array($request->get('mensagem_lida'), explode(',', $mensagem->mensagem_lida))) {
            $mensagemLidaString = $mensagem->mensagem_lida.','.$request->get('mensagem_lida');
            $mensagem->update(['mensagem_lida' => $mensagemLidaString]);
        } else {
            $mensagem->update(['mensagem_lida' => str_replace($request->get('mensagem_lida'),
                "", $mensagem->mensagem_lida)]);
        }

        return response()->json($mensagem, 201);
    }

    public function updateCol(Request $request, $id)
    {
        $mensagem_ids = $request->get('mensagem_ids');

        // update collections read status retrieved by query above
        foreach ($mensagem_ids as $mensagem_id) {
            $mensagem = Mensagem::find($mensagem_id);

            if ($mensagem->mensagem_lida === NULL ) {
                $mensagem->update(['mensagem_lida' => $id]);
            } elseif (!in_array($id, explode(',', $mensagem->mensagem_lida))) {
                $mensagemLidaString = $mensagem->mensagem_lida.','.$id;
                $mensagem->update(['mensagem_lida' => $mensagemLidaString]);
            }
        }

        return response()->json($mensagem_ids, 201);
    }

    public function updateUnreadCol(Request $request, $id)
    {
        $mensagem_ids = $request->get('mensagem_ids');

        // update collections read status retrieved by query above
        foreach ($mensagem_ids as $mensagem_id) {
            $mensagem = Mensagem::find($mensagem_id);
            $mensagemLidaArr = explode(',', $mensagem->mensagem_lida);
            if (sizeof($mensagemLidaArr) === 1) {
                $mensagem->update(['mensagem_lida' => str_replace($id, "", $mensagem->mensagem_lida)]);
            } else {
                $mensagem->update(['mensagem_lida' => str_replace(",".$id, "", $mensagem->mensagem_lida)]);
            }

        }

        return response()->json($mensagem_ids, 201);
    }

    public function create(Request $request)
    {
        $mensagem = Mensagem::create([
            'titulo' => $request->get('title'),
            'mensagem' => $request->get('message'),
            'mensagem_lida' => 'none',
            'especialidades' => $request->get('activities'),
            'cidades' => $request->get('cities'),
            'estados' => $request->get('states')
        ]);

        return response()->json($mensagem, 201);
    }
}
