<?php

namespace App\Http\Controllers;

use App\User;
use App\PessoaJuridica;
use App\PessoaJuridicaImg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class ArquivosController extends Controller
{
    public function store(Request $request, $id, $filename) 
    {
        if (substr($filename, -4) == '.pdf') {
            $files = Storage::disk('public')->files('arquivos/'.$id.'/pdf');
            if ($files) {
        
                Storage::disk('public')->delete($files[0]);
            }
            $path = $request->file('arquivo')->storeAs('arquivos/' . $id . '/pdf\/', $filename, 'public');
        } else {
            $path = $request->file('arquivo')->storeAs('arquivos/' . $id . '/imagens\/', $filename, 'public');
        }

        return response()->json($path, 201);
    }

    public function storeUnidadeImg(Request $request, $id, $filename) 
    {
        
        $path = $request->file('arquivo')->storeAs('arquivos-unidade/' . $id . '/imagens\/', $filename, 'public');
        

        return response()->json($path, 201);
    }

    public function storeSlideImg(Request $request, $filename, $ordem) 
    {
        $path = $request->file('slide-imagem')->storeAs('slide-imagens', $ordem . $filename, 'public');

        return response()->json($path, 201);
    }

    public function storeBanner(Request $request, $id, $local, $filename) 
    {
        if ($local === 'topo') {
            $files = Storage::disk('public')->files('banners/' . $id . '/topo');
            if ($files) {
        
                Storage::disk('public')->delete($files[0]);
            }
        } else {
            $files = Storage::disk('public')->files('banners/' . $id . '/lateral');
            if ($files) {
        
                Storage::disk('public')->delete($files[0]);
            }
        }
        
        
        $path = $request->file('banner')->storeAs('banners/' . $id . '/' . $local,  $filename, 'public');

        return response()->json($path, 201);
    }

    public function storeBannerSimpleUser(Request $request, $id, $local, $filename) 
    {
        if ($local === 'topo') {
            $files = Storage::disk('public')->files('banners-simple-users/' . $id . '/topo');
            if ($files) {
        
                Storage::disk('public')->delete($files[0]);
            }
        } else {
            $files = Storage::disk('public')->files('banners-simple-users/' . $id . '/lateral');
            if ($files) {
        
                Storage::disk('public')->delete($files[0]);
            }
        }
        
        
        $path = $request->file('banner')->storeAs('banners-simple-users/' . $id . '/' . $local,  $filename, 'public');

        return response()->json($path, 201);
    }

    public function index($id)
    {
        $files = Storage::disk('public')->files('arquivos/'.$id.'/pdf');

        if ($files) {
            return response()->json($files[0], 201);
        }

        return response()->json($files, 201);
    } 

    public function imagensIdx($id)
    {
        $files = Storage::disk('public')->files('arquivos/'.$id.'/imagens');

        return response()->json($files, 201);
    } 

    public function imagensUnidadeIdx($id)
    {
        $files = Storage::disk('public')->files('arquivos-unidade/'.$id.'/imagens');

        return response()->json($files, 201);
    } 

    public function slideImgIdx() 
    {
        $imagens = Storage::disk('public')->files('slide-imagens');

        return response()->json($imagens, 201);
    }

    public function delete($id, $filename)
    {
        $delete = Storage::disk('public')->delete('arquivos/' . $id . '/imagens\/' . $filename);

        return response()->json($delete, 201);
    }

    public function deleteSlideImg($filename)
    {
        $delete = Storage::disk('public')->delete('slide-imagens/' . $filename);

        return response()->json($delete, 201);
    }

    public function showTop($id)
    {
        $banner = Storage::disk('public')->files('banners/' . $id . '/topo');
        
        return response()->json($banner, 201);
       
    }

    public function showSide($id)
    {
        $banner = Storage::disk('public')->files('banners/' . $id . '/lateral');
        
        return response()->json($banner, 201);
       
    }
}