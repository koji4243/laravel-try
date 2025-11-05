<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;

class UserContoroller extends Controller
{
    public function index(){

        $users = User::all();

        return view('index', compact('users'));
    }
    public function show(User $user){

        return view('show', $user);
    }

    public function create(){
        return view('create');
    }
    public function check(UserRequest $request){

        $users = $request->all();
        // dd(vars: $users);
        return view('check',compact('users'));
    }
}
