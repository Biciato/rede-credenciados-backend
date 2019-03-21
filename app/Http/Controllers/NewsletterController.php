<?php

namespace App\Http\Controllers;

use App\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class NewsletterController extends Controller
{
    public function create(Request $request)
    {
        $newsletter = Newsletter::updateOrCreate(
            ['email' => $request->get('email')],
            ['nome' => $request->get('nome')]
        );

        return response()->json($newsletter, 201);
    }

    public function index() 
    {
        $newsletters = Newsletter::all();

        return response()->json($newsletters, 201); 
    }

    public function delete($id)
    {
        $delete = Newsletter::destroy($id);

        return response()->json($delete, 201);
    }
}