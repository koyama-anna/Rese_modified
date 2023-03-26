<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    public function favorite()
    {
        return $this->hasMany('App\Models\Favorite');
    }

    protected $fillable = ['name', 'area', 'genre', 'information', 'photo'];
}
