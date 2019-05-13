<?php

namespace App\Http\Controllers;

use App\Cotacao;
use App\User;
use App\PessoaFisica;
use App\PessoaJuridica;
use App\Unidade;
use App\EnderecoPessoaJuridica;
use App\EnderecoPessoaFisica;
use App\EnderecoUnidade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class CotacaoController extends Controller
{
    public function create(Request $request)
    {

        $cotacao = Cotacao::create([
            'estados' => $request->get('estados'),
            'cidades' => $request->get('cidades'),
            'nome' => $request->get('nome'),
            'email' => $request->get('email'),
            'tel' => $request->get('tel'),
            'cel' => $request->get('cel'),
            'mensagem' => $request->get('mensagem'),
        ]);

        return response()->json($cotacao, 201);
    }

    public function index(Request $request) {
        // retrieving only citys and states given on request
        $cotacoes = Cotacao::where([
            ['cidades', 'like', '%'.$request->get('cidade').'%'],
            ['estados', 'like', '%'.$request->get('estado').'%' ]
        ])->get();

        return response()->json($cotacoes, 201);
    }
}
