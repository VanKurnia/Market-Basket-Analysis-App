<?php

namespace App\Http\Controllers;

use App\Models\market_basket_data;

class Main extends Controller
{
    public function test()
    {
        $test = market_basket_data::count();
        dd($test);
    }
}
