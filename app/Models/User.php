<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
        use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'juusyo',
        'tell',
        'category_id'
    ];
    public function categories()
{
    
    return $this->belongsToMany(related: Category::class);
    }  
}
