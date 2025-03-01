<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NoticiaController extends Controller
{
    public function index(Request $request)
    {
        $title = $request->title;
        $token = 'Authorization: Bearer ' . $_COOKIE["token"];
        if($title != '') {
            $noticias = Http::withToken($token)->get('http://127.0.0.1:8000/api/noticias', $request)->json();
            if($noticias['status'] == true){
                return view('noticias.index')->with('noticias', $noticias);
            } elseif ($noticias['message'] == "Token inválido!"){
                return redirect('login');
            }
        }
        $noticias = Http::withToken($token)->get('http://127.0.0.1:8000/api/noticias')->json();
        if($noticias['status'] == true){
            return view('noticias.index')->with('noticias', $noticias);
        } elseif ($noticias['message'] == "Token inválido!"){
            return redirect('login');
        }
    }
    public function store(Request $request)
    {
        try{
            $token = 'Authorization: Bearer ' . $_COOKIE["token"];
            $response = Http::withToken($token)->post('http://127.0.0.1:8000/api/noticias', $request);
            if($response['status'] == true){
                return redirect('noticias');
            }
            return redirect('login');
        }catch (Exception $e){
            return response()->json(['message' => 'Failed to create user'], 500);
        }
    }

    public function update(Request $request)
    {
        try{
            $token = 'Authorization: Bearer ' . $_COOKIE["token"];
            $id = $request->id;
            $url = 'http://127.0.0.1:8000/api/noticias/' . $id;
            $response = Http::withToken($token)->put($url, $request);
            if ($response['status'] == true){
                return redirect('noticias');
            };
        }catch (Exception $e){
            return response()->json(['message' => 'Failed to update user'], 500);
        }
    }

    public function edit(Request $request)
    {
        $token = 'Authorization: Bearer ' . $_COOKIE["token"];

        $id = $request->id;
        $url = 'http://127.0.0.1:8000/api/noticias/' . $id;
        $noticia = Http::withToken($token)->get($url)->json();
        return view('noticias.edit')->with('noticia', $noticia);
    }

    public function destroy(Request $request)
    {
        try{
            $token = 'Authorization: Bearer ' . $_COOKIE["token"];
            $id = $request->id;
            $url = 'http://127.0.0.1:8000/api/noticias/' . $id;
            $response = Http::withToken($token)->delete($url);
            if ($response['status'] == true){
                return redirect('noticias');
            };
        }catch (Exception $e){
            return response()->json(['message' => 'Failed to delete user'], 500);
        }
    }

}
