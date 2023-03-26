<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    public function favorite()
    {
        return $this->hasMany('App\Models\Favorite');
    }

    protected $fillable = ['name', 'area', 'genre', 'information', 'photo'];

    protected $appends = [
        'favorited_by_user'
    ];


    //アクセサ　favorited_by_user

    public function getFavoritedByUser()
    {
        if (Auth::check()) {
            return false;
        }

        return $this->favorite->contains(function ($user) {
            return $user->id === Auth::user()->id;
        });
    }
}
