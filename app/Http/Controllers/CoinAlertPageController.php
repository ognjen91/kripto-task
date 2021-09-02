<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CoinAlertPageController extends Controller
{
    public function __invoke($slug, $id){
        return view('welcome');
    }
}
