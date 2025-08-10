<?php

namespace App\Http\Controllers\Shisha;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    public function terms(){
        return view("shisha_frontend.terms");
    }

    function policy(){
        return view("shisha_frontend.policy");
    }

    
}
