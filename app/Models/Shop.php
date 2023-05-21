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

    public function reservation()
    {
        return $this->hasMany('App\Models\Reservation');
    }

    protected $guarded = array('id');

    public static $rules = array(
        'name' => 'required',

    );
}
