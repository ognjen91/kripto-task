<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    /**
     * Show list of currencies
     *
     * @return void
     */

    public function index(){
        return view('welcome');
    }
    
    
    public function show(String $slug){
        return view('welcome');
    }





}
