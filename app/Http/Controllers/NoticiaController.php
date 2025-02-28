<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NoticiaController extends Controller
{
    public function store(Request $request)
    {
        try{
            $token = 'Authorization: Bearer ' . $_COOKIE["token"];
//            var_dump($_COOKIE["id"]);
//            var_dump($_COOKIE["token"]);
            //var_dump($request);
            $response = Http::withToken($token)->post('http://127.0.0.1:8000/api/noticias', $request);
            if($response['status'] == true){
                return redirect('user');
            }
            return redirect('login');
        }catch (Exception $e){
            return response()->json(['message' => 'Failed to create user'], 500);
        }
    }

}
