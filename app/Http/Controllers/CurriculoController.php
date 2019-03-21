<?php

namespace App\Http\Controllers;

use App\Curriculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class CurriculoController extends Controller
{

    public function storeCurriculo(Request $request, $directory, $filename) 
    {
        $path = $request->file('curriculo')->storeAs('curriculos/' . $directory, $filename, 'public');

        return response()->json($path, 201);
    }

    public function create(Request $request)
    {
        $curriculo = Curriculo::create($request->all());

        return response()->json($curriculo, 201);
    }
}