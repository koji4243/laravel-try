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

        $users = User::orderBy('updated_at', 'desc')->get();
        return view('index', compact('users'));
    }
    public function create(Category $category, Request $request){
        $categories =Category::all();
        return view('create', compact('categories'));
    }

    public function createback(UserRequest $request){
        return redirect()->route('create')
                        ->withInput($request->all());
    }
    public function check(UserRequest $request){

        $users = $request->all();
        // dd(vars: $users);
        return view('check',compact('users'));
    }
        public function store(UserRequest $request){
        // dd(vars: $request);
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->juusyo = $request->input('juusyo');
        $user->tell = $request->input('tell');
        $user->save();

        $categoryNames = $request->categories; // ['友達', '会社', '家族']にidを割り当てる
        $categoryIds = Category::whereIn('category', $categoryNames)
                                ->pluck('id')
                                ->toArray();
        $user->categories()->attach($categoryIds);

        return redirect()->route('users')
                        ->with('create', '新規登録完了しました');
    }
    public function edit(User $user){
        $categories = Category::all();
        $users = User::with('categories')->find($user->id);

        return view('edit',compact('users','user'));
    }
    public function editCheck(UserRequest $request, User $user){
        $users = $request->all();
        return view('editcheck',compact('users', 'user'));
    }
    public function update(User $user, UserRequest $request){
        $user = User::findOrFail($user->id);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->juusyo = $request->input('juusyo');
        $user->tell = $request->input('tell');
        $user->save();

        $categoryNames = $request->categories; // ['友達', '会社', '家族'] 形式
        $categoryIds = Category::whereIn('category', $categoryNames)
                                ->pluck('id')
                                ->toArray();
        $user->categories()->sync($categoryIds);

        return redirect()->route('users')
                    ->with('update', '更新完了しました');
    }
    public function delete(User $user){
        User::find($user->id)->delete();
        return redirect()->route('users')
                        ->with('delete', '削除完了しました');
    }
}
