<?php

namespace App\Http\Controllers;

use App\PessoaJuridica;
use App\Unidade;
use App\EnderecoUnidade;
use App\ApresentacaoUnidade;
use App\AtividadeUnidade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class RegistroInicialUnidadeController extends Controller
{
    public function register(Request $request)
    {
        $pessoa_juridica = PessoaJuridica::find($request->get('id'));

        $unidade = $pessoa_juridica->unidades()->create([
            'cnpj' => $request->get('cnpj'),
            'razao_social' => $request->get('razao_social'),
            'nome_fantasia' => $request->get('nome_fantasia'),
            'nome_contato' => $request->get('nome_contato'),
            'email' => $request->get('email'),
            'email2' => $request->get('email2'),
            'tel' => $request->get('tel'),
            'tel2' => $request->get('tel2'),
            'cel' => $request->get('cel'),
            'cel2' => $request->get('cel2')
        ]);

        $unidade->endereco()->create([
            'cep' => $request->get('cep'),
            'rua' => $request->get('rua'),
            'numero' => $request->get('numero'),
            'complemento' => $request->get('complemento'),
            'bairro' => $request->get('bairro'),
            'cidade' => $request->get('cidade'),
            'estado' => $request->get('estado'),
        ]);

        $unidade->atividade()->create(['atividades' => $request->get('atividades')]);

        $unidade->apresentacao()->create(['apresentacao' => $request->get('apresentacao')]);

        return response()->json($unidade, 201);
    }
}