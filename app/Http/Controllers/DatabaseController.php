<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Words;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class DatabaseController extends Controller
{
    function showLanding()
    {
        session_start();
        $word = Words::inRandomOrder()->limit(1)->get();
        $user = User::where("name", $_SESSION["username"])->first();
        return view('landing', ["word" => $word, "user" => $user]);
    }
}
