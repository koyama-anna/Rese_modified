<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;

class ShopController extends Controller
{
    public function index()
    {
        $shops = Shop::get();
        //dd($shops);
        return view('shops', [
            'shops' => $shops
        ]);
    }
}
