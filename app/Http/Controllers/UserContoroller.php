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
    public function create(Category $category, Request $request){
        $categories =Category::all();
        return view('create', compact('categories'));
    }

    public function check(UserRequest $request,Category $category){
        $users = $request->all();
        $categoryIds = $request->categories;
        $selectedCategories = Category::whereIn('id', $categoryIds)->get();
        return view('check',compact('users', 'selectedCategories'));
    }
        public function store(UserRequest $request){
        if($request->action === 'back'){
            return redirect()->route('create')
                            ->withInput();
        }

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->juusyo = $request->input('juusyo');
        $user->tell = $request->input('tell');
        $user->save();

        $user->categories()->attach($request->categories);
        return redirect()->route('users')
                        ->with('create', '新規登録完了しました');
    }
    public function edit(User $user){
        $categories = Category::all();
        $users = User::with('categories')->find($user->id);
        return view('edit',compact('users','user', 'categories'));
    }
    public function editCheck(UserRequest $request, User $user){
        $users = $request->all();
        $categoryIds = $request->categories;
        $selectedCategories = Category::whereIn('id', $categoryIds)->get();
        return view('editcheck',compact('users', 'user', 'selectedCategories'));
    }
    public function update(User $user, UserRequest $request){
        if($request->action === 'editback'){
            return redirect()->route('edit', $user)
                            ->withInput();
        }
        $user = User::findOrFail($user->id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->juusyo = $request->input('juusyo');
        $user->tell = $request->input('tell');
        $user->save();

        $user->categories()->sync($request->categories);
        return redirect()->route('users')
                    ->with('update', '更新完了しました');
    }
    public function delete(User $user){
        User::find($user->id)->delete();
        return redirect()->route('users')
                        ->with('delete', '削除完了しました');
    }
}
