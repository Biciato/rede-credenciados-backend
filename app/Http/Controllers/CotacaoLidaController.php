<?php

namespace App\Http\Controllers;

use App\CotacaoLida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class CotacaoLidaController extends Controller
{
    public function setAsRead(Request $request)
    {
        // gets user id and cotation id to inform reading status
        $cotacao_lida = CotacaoLida::where([
            ['user_id', $request->get('user_id')],
            ['cotacao_id', $request->get('cotacao_id')]
        ])->first();

        // update it if cotation was already read
        if ($cotacao_lida) {
            $cotacao_lida->update(['cotacao_lida' => 1]);
        }

        // create it in other case
        if ($cotacao_lida === null) {
            $cotacao_lida = CotacaoLida::create([
                'user_id' => $request->get('user_id'),
                'cotacao_id' => $request->get('cotacao_id'),
                'cotacao_lida' => 1
            ]);
        }

        return response()->json($cotacao_lida, 201);
    }

    public function setAsReadCol(Request $request)
    {
        $cotacoes_ids = $request->get('cotacao_ids');

        // same thing of setAsRead but in this case, it's collections instead of just one id (user)
        foreach ($cotacoes_ids as $cotacao_id) {
            $cotacao_lida = CotacaoLida::where([
                ['user_id', $request->get('user_id')],
                ['cotacao_id', $cotacao_id]
            ])->first();

            if ($cotacao_lida) {
                $cotacao_lida->update(['cotacao_lida' => 1]);
            }

            if ($cotacao_lida === null) {
                $cotacao_lida = CotacaoLida::create([
                    'user_id' => $request->get('user_id'),
                    'cotacao_id' => $cotacao_id,
                    'cotacao_lida' => 1
                ]);
            }
        }

        return response(201);
    }

    public function setAsUnreadCol(Request $request)
    {
        $cotacoes_ids = $request->get('cotacao_ids');

        // set unread status on collections of cotations
        foreach ($cotacoes_ids as $cotacao_id) {
            $cotacao_lida = CotacaoLida::where([
                ['user_id', $request->get('user_id')],
                ['cotacao_id', $cotacao_id]
            ])->first();

            if ($cotacao_lida) {
                $cotacao_lida->update(['cotacao_lida' => 0]);
            }
        }

        return response(201);
    }

    public function getCotRead($id) {
        // get cotations read by user
        $cotacoes_lida = CotacaoLida::where('user_id', $id)->get();

        return response()->json($cotacoes_lida, 201);
    }
}
