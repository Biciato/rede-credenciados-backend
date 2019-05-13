<?php

namespace App\Http\Controllers;

use App\Mensagem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class MensagemController extends Controller
{

    public function mensagensUser($id)
    {
        $mensagens = Mensagem::where('destinatario_id', $id)->get();

        return response()->json($mensagens, 201);
    }

    public function update($id, Request $request)
    {
        $mensagem = Mensagem::find($id)->update(['mensagem_lida' => $request->get('mensagem_lida')]);

        return response()->json($mensagem, 201);
    }

    public function updateCol(Request $request)
    {
        $mensagem_ids = $request->get('mensagem_ids');

        // update collections read status retrieved by query above
        foreach ($mensagem_ids as $mensagem_id) {
            Mensagem::find($mensagem_id)->update(['mensagem_lida' => 1]);
        }

        return response()->json($mensagem_ids, 201);
    }

    public function updateUnreadCol(Request $request)
    {
        $mensagem_ids = $request->get('mensagem_ids');

        // update collections read status retrieved by query above
        foreach ($mensagem_ids as $mensagem_id) {
            Mensagem::find($mensagem_id)->update(['mensagem_lida' => 0]);
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
