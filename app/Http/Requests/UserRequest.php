<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if($this->input('action') === 'go' || $this->input('action') === 'back' || $this->input('action') === 'editback'){
            return [];
        }

        $rules = [
            'name' => 'required',
            'juusyo' => 'max:200',
            'tell' => 'required|regex:/^[0-9]+$/',
            'categories' => 'required|array'
        ];
        //ユーザー以外からemailが被ったらバリデーション効かせる
        if($this->route('user')){
            $rules['email'] = 'required|email|unique:users,email,' . $this->user->id;
        }else{
            $rules['email'] = 'required|email|unique:users,email';
        }
        return $rules;
    }
}
