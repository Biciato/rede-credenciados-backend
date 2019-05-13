<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\User;
use App\PessoaFisica;
use App\PessoaJuridica;
use App\Unidade;
use App\EnderecoPessoaFisica;
use App\EnderecoPessoajuridica;
use App\EnderecoUnidade;
use App\AtividadePessoaFisica;
use App\AtividadePessoaJuridica;
use App\AtividadeUnidade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class PesquisaClientesController extends Controller
{

    // querying pessoa fisicas, juridicas and unities data (everything)
    public function pesquisa(Request $request)
    {
        $pessoa_fisicas = DB::table('pessoa_fisicas')
            ->join('endereco_pessoa_fisicas', function ($join) use ($request) {
                $join->on('pessoa_fisicas.id', '=', 'endereco_pessoa_fisicas.pessoa_fisica_id')
                    ->where([
                        ['endereco_pessoa_fisicas.cidade', $request->get('cidade')],
                        ['endereco_pessoa_fisicas.estado', $request->get('estado')]
                    ]);
            })
            ->join('atividade_pessoa_fisicas', function ($join) use ($request) {
                $join->on('pessoa_fisicas.id', '=', 'atividade_pessoa_fisicas.pessoa_fisica_id')
                    ->where('atividades', 'like', '%'.$request->get('atividade').'%');
            })
            ->select('pessoa_fisicas.*', 'endereco_pessoa_fisicas.*', 'atividade_pessoa_fisicas.*')
            ->get();

        $pessoa_juridicas = DB::table('pessoa_juridicas')
            ->join('endereco_pessoa_juridicas', function ($join) use ($request) {
                $join->on('pessoa_juridicas.id', '=', 'endereco_pessoa_juridicas.pessoa_juridica_id')
                    ->where([
                        ['endereco_pessoa_juridicas.cidade', $request->get('cidade')],
                        ['endereco_pessoa_juridicas.estado', $request->get('estado')]
                    ]);
            })
            ->join('atividade_pessoa_juridicas', function ($join) use ($request) {
                $join->on('pessoa_juridicas.id', '=', 'atividade_pessoa_juridicas.pessoa_juridica_id')
                    ->where('atividades', 'like', '%'.$request->get('atividade').'%');
            })
            ->select('pessoa_juridicas.*', 'endereco_pessoa_juridicas.*', 'atividade_pessoa_juridicas.*')
            ->get();

        $unidades = DB::table('unidades')
            ->join('endereco_unidades', function ($join) use ($request) {
                $join->on('unidades.id', '=', 'endereco_unidades.unidade_id')
                    ->where([
                        ['endereco_unidades.cidade', $request->get('cidade')],
                        ['endereco_unidades.estado', $request->get('estado')]
                    ]);
            })
            ->join('atividade_unidades', function ($join) use ($request) {
                $join->on('unidades.id', '=', 'atividade_unidades.unidade_id')
                    ->where('atividades', 'like', '%'.$request->get('atividade').'%');
            })
            ->join('pessoa_juridicas', function ($join) {
                $join->on('unidades.pessoa_juridica_id', '=', 'pessoa_juridicas.id');
            })
            ->select('unidades.*', 'endereco_unidades.*', 'atividade_unidades.*', 'pessoa_juridicas.user_id')
            ->get();

        return response()->json([$pessoa_fisicas, $pessoa_juridicas, $unidades], 201);
    }
}
