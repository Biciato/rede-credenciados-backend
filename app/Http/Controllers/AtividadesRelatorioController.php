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

class AtividadesRelatorioController extends Controller
{

    public function relatorio(Request $request)
    {
        // getting pessoa fisicas cidade, estado and Atividades
        $pessoa_fisicas = DB::table('pessoa_fisicas')
            ->join('endereco_pessoa_fisicas', function ($join) use ($request) {
                $join->on('pessoa_fisicas.id', '=', 'endereco_pessoa_fisicas.pessoa_fisica_id');
            })
            ->join('atividade_pessoa_fisicas', function ($join) use ($request) {
                $join->on('pessoa_fisicas.id', '=', 'atividade_pessoa_fisicas.pessoa_fisica_id');
            })
            ->select('endereco_pessoa_fisicas.cidade', 'endereco_pessoa_fisicas.estado', 'atividade_pessoa_fisicas.atividades')
            ->get()->toArray();

        // getting pessoa juridicas cidade, estado and Atividades
        $pessoa_juridicas = DB::table('pessoa_juridicas')
            ->join('endereco_pessoa_juridicas', function ($join) use ($request) {
                $join->on('pessoa_juridicas.id', '=', 'endereco_pessoa_juridicas.pessoa_juridica_id');
            })
            ->join('atividade_pessoa_juridicas', function ($join) use ($request) {
                $join->on('pessoa_juridicas.id', '=', 'atividade_pessoa_juridicas.pessoa_juridica_id');
            })
            ->select('endereco_pessoa_juridicas.cidade', 'endereco_pessoa_juridicas.estado', 'atividade_pessoa_juridicas.atividades')
            ->get()->toArray();

        // getting unidades cidade, estado and Atividades
        $unidades = DB::table('unidades')
            ->join('endereco_unidades', function ($join) use ($request) {
                $join->on('unidades.id', '=', 'endereco_unidades.unidade_id');
            })
            ->join('atividade_unidades', function ($join) use ($request) {
                $join->on('unidades.id', '=', 'atividade_unidades.unidade_id') ;
            })
            ->join('pessoa_juridicas', function ($join) {
                $join->on('unidades.pessoa_juridica_id', '=', 'pessoa_juridicas.id');
            })
            ->select('endereco_unidades.cidade', 'endereco_unidades.estado', 'atividade_unidades.atividades')
            ->get()->toArray();

        $colMerged = array_merge($pessoa_fisicas, $pessoa_juridicas, $unidades);

        // Arrays used to count items frequency
        $cidades = [];
        $Qtdcidades = [];
        $estados = [];
        $Qtdestados = [];

        foreach ($colMerged as $item) {
            $arrFromStr = explode(',', $item->atividades);
            if ($item->cidade !== '') {
                // Create new index if a new city appears or sum up an existed city
                if (in_array($item->cidade, $cidades) === false) {
                    array_push($cidades, $item->cidade);
                    array_push($Qtdcidades, sizeof($arrFromStr));
                } else {
                    $idx = array_search($item->cidade, $cidades);
                    $Qtdcidades[$idx] = $Qtdcidades[$idx] + sizeof($arrFromStr);
                }
            }
            if ($item->estado !== '') {
                // Create new index if a new state appears or sum up an existed city
                if (in_array($item->estado, $estados) === false) {
                    array_push($estados, $item->estado);
                    array_push($Qtdestados, sizeof($arrFromStr));
                } else {
                    $idx = array_search($item->estado, $estados);
                    $Qtdestados[$idx] = $Qtdestados[$idx] + sizeof($arrFromStr);
                }
            }
        }

        return response()->json([
            $cidades,
            $Qtdcidades,
            $estados,
            $Qtdestados
        ], 201);
    }
}
