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
        $users = null;
        return view('create', compact('categories','users'));
    }



    public function check(UserRequest $request){
        if($request->action === 'imgDelete'){
            $request->session()->forget('image_temp');
            return redirect()->route('create')
                            ->withInput(session('create_key'));
        }
                            // "create_key"をセッションに入れる
        $request->session()->put('create_key', $request->except('image'));
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('temp','public'); // storageへの保存と、変数への代入
            session(['image_temp' => $path]);
        }
        $users = null;
        $session_user = $request->session()->get('create_key');
        $categoryNames = Category::whereIn('id', $session_user['categories'])->pluck('category')->toArray();
        $session_user['categories'] = $categoryNames;
        return view('check',compact('session_user', 'users'));
    }
        public function store(UserRequest $request){
        if($request->action === 'back'){
            return redirect()->route('create')
                            ->withInput(session('create_key'));
        }
        $user = new User();
        $user->name = session('create_key.name') ;
        $user->email = session('create_key.email') ;
        if (session('image_temp')) { 
            $user->image = session('image_temp');
        }
        $user->juusyo = session('create_key.juusyo') ;
        $user->tell = session('create_key.tell') ;
        $user->save();

        $user->categories()->attach(session('create_key.categories'));
        $request->session()->forget(['create_key', 'image_temp']);
        return redirect()->route('users')
                        ->with('create', '新規登録完了しました');
    }
    public function edit(User $user){
        $categories = Category::all();
        $users = User::with('categories')->find($user->id);
        return view('create',compact('users','user', 'categories'));
    }
    public function editCheck(UserRequest $request, User $user){
                        // "edit_key"をセッションに入れる
        $request->session()->put('edit_key', $request->except('image'));
        if ($request->hasFile('image')) {
            $request->session()->forget('image_temp');
            $path = $request->file('image')->store('temp','public'); // storageへの保存と、変数への代入
            $request->session()->put('image_temp', $path);
        }
        $users = User::all();
        $session_user = $request->session()->get('edit_key');

        $categoryNames = Category::whereIn('id', $session_user['categories'])->pluck('category')->toArray();
        $session_user['categories'] = $categoryNames;
        return view('check',compact('session_user', 'user', 'users'));
    }
    public function update(User $user, UserRequest $request){
        if($request->action === 'editback' || $request->action === 'back'){
            return redirect()->route('edit', $user)
                            ->withInput(session('edit_key'));
        }
        $user = User::findOrFail($user->id);
        $user->name = session('edit_key.name') ;
        $user->email = session('edit_key.email') ;
        $user->juusyo = session('edit_key.juusyo') ;
        $user->tell = session('edit_key.tell') ;
        $user->save();

        $user->categories()->sync( session('edit_key.categories'));
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
