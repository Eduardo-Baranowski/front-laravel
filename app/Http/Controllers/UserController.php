<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $token = 'Authorization: Bearer ' . $_COOKIE["token"];
        $users = Http::withToken($token)->get('http://127.0.0.1:8000/api/users')->json();
        if($users['status'] == true){
            return view('users.index')->with('users', $users);
        }
        return redirect('login');

    }

    public function store(Request $request)
    {
        try{
            $token = 'Authorization: Bearer ' . $_COOKIE["token"];
            $response = Http::withToken($token)->post('http://127.0.0.1:8000/api/users', $request);
            if($response['status'] == true){
                return redirect('user');
            } elseif ($response['message'] == "Token inválido!"){
                return redirect('login');
            }
        }catch (Exception $e){
            return response()->json(['message' => 'Failed to create user'], 500);
        }
    }

    public function authenticate(Request $request)
    {
        try{
            $response = Http::post('http://127.0.0.1:8000/api/login', $request);
            if ($response['status'] == true){
                setcookie("token",$response['token']);
                setcookie("id",$response['user']['id']);
                return redirect('user');
            }
            return response()->json(['message' => 'Failed to login user'], 500);
        }catch (Exception $e){
            return response()->json(['message' => 'Failed to login user'], 500);
        }
    }

    public function login()
    {
        try{
            return view('auth.login');
        }catch (Exception $e){
            return response()->json(['message' => 'Failed to login user'], 500);
        }
    }

    public function logout(Request $request)
    {
        try{

            $token = 'Authorization: Bearer ' . $_COOKIE["token"];
            $id = $_COOKIE["id"];

            $url = 'http://127.0.0.1:8000/api/logout/' . $id;
            $response = Http::withToken($token)->post($url);
            if ($response['status'] == true){
                return redirect('login');
            };
        }catch (Exception $e){
            return response()->json(['message' => 'Failed to logout'], 500);
        }
    }

    public function update(Request $request)
    {
        try{
            $token = 'Authorization: Bearer ' . $_COOKIE["token"];
            $id = $request->id;
            $url = 'http://127.0.0.1:8000/api/users/' . $id;
            $response = Http::withToken($token)->put($url, $request);
            if ($response['status'] == true){
                return redirect('user');
            };
        }catch (Exception $e){
            return response()->json(['message' => 'Failed to update user'], 500);
        }
    }

    public function destroy(Request $request)
    {
        try{
            $token = 'Authorization: Bearer ' . $_COOKIE["token"];
            $id = $request->id;
            $url = 'http://127.0.0.1:8000/api/users/' . $id;
            $response = Http::withToken($token)->delete($url);
            if ($response['status'] == true){
                return redirect('user');
            };
        }catch (Exception $e){
            return response()->json(['message' => 'Failed to delete user'], 500);
        }
    }
}
