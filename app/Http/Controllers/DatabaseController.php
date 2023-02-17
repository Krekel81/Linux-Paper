<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Words;

class DatabaseController extends Controller
{
    function showLanding()
    {
        $word = Words::inRandomOrder()->limit(1)->get();
        return view('landing', ["word" => $word]);
    }
}
