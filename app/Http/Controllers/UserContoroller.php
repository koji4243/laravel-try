<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Http\Requests\UserRequest;

class UserContoroller extends Controller
{
    public function index(){
        $users = User::with('categories')->orderBy('updated_at', 'desc')->get();
        return view('index', compact('users'));
    }
    public function create(Category $category,){
        $categories =Category::all();
        return view('create', compact('categories'));
    }

    public function check(UserRequest $request){
                            // "create_key"をセッションに入れる
        $request->session()->put('create_key', $request->all());
        $session_user = $request->session()->get('create_key');

        $categoryNames = Category::whereIn('id', $session_user['categories'])->pluck('category')->toArray();
        $session_user['categories'] = $categoryNames;
        return view('check',compact('session_user'));
    }
        public function store(UserRequest $request){
        if($request->action === 'back'){
            return redirect()->route('create')
                            ->withInput(session('create_key'));
        }
        $createUser = $request->session()->get('create_key');

        $user = new User();
        $user->name = $createUser['name'];
        $user->email = $createUser['email'];
        $user->juusyo = $createUser['juusyo'];
        $user->tell = $createUser['tell'];
        $user->save();

        $categories = $createUser['categories']; 
        $user->categories()->attach($categories);
        $request->session()->forget('create_key');
        return redirect()->route('users')
                        ->with('create', '新規登録完了しました');
    }
    public function edit(User $user){
        $categories = Category::all();
        $users = User::with('categories')->find($user->id);
        return view('edit',compact('users','user', 'categories'));
    }
    public function editCheck(UserRequest $request, User $user){
        $request->session()->put('edit_key', $request->all());
        $session_user = $request->session()->get('edit_key');

        $categoryNames = Category::whereIn('id', $session_user['categories'])->pluck('category')->toArray();
        $session_user['categories'] = $categoryNames;
        return view('editcheck',compact('session_user', 'user'));
    }
    public function update(User $user, UserRequest $request){
        if($request->action === 'editback'){
            return redirect()->route('edit', $user)
                            ->withInput(session('edit_key'));
        }
        $editUser = $request->session()->get('edit_key');

        $user = User::findOrFail($user->id);
        $user->name = $editUser['name'];
        $user->email = $editUser['email'];
        $user->juusyo = $editUser['juusyo'];
        $user->tell = $editUser['tell'];
        $user->save();

        $categories = $editUser['categories']; 
        $user->categories()->sync($categories);
        $request->session()->forget('edit_key');
        return redirect()->route('users')
                    ->with('update', '更新完了しました');
    }
    public function delete(User $user){
        User::find($user->id)->delete();
        return redirect()->route('users')
                        ->with('delete', '削除完了しました');
    }
}
