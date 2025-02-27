<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Exception;
use Illuminate\Support\Facades\Hash;
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
    public function index(User $model)
    {
        $users = Http::get('http://127.0.0.1:8000/api/users')->json();
        return view('users.index')->with('users', $users);
    }

    public function store(Request $request)
    {
        try{
            Http::post('http://127.0.0.1:8000/api/users', $request);
            return redirect('user');
        }catch (Exception $e){
            return response()->json(['message' => 'Failed to create user'], 500);
        }



    }
}
