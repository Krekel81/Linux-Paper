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
        if(!(isset($_SESSION["username"])))
        {
            return redirect()->route('login', ["message"=>"You are not logged in!"]);
        }

        $word = Words::inRandomOrder()->limit(1)->get();
        $user = User::where("name", $_SESSION["username"])->first();

        if(!($user->loggedIn))
        {
            return redirect()->route('login', ["message"=>"User is not logged in"]);
        }
        return view('landing', ["word" => $word, "user" => $user]);
    }

    function checkIfUserLoggedIn(User $user)
    {
        return $user->loggedIn ? "" : redirect()->route('login', ["message"=>"User is not logged in"]);
    }
}
