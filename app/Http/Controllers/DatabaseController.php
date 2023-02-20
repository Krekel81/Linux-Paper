<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Words;
use App\Models\User;
use App\Models\History;
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

        $user = User::where("name", $_SESSION["username"])->first();
        if(!($user->loggedIn))
        {
            return redirect()->route('login', ["message"=>"User is not logged in"]);
        }

        if($user->clicks > 0)
        {
            $history = History::where('userId', $user->id)
            ->orderByDesc('id')
            ->get();

            $word = History::where('userId', $user->id)
            ->orderByDesc('id')
            ->limit(1)
            ->get();
            return view('landing', ["user" => $user, "history"=>$history, "word"=>$word]);
        }
        else{
            return view('landing', ["user" => $user]);
        }

    }

    function checkIfUserLoggedIn(User $user)
    {
        return $user->loggedIn ? "" : redirect()->route('login', ["message"=>"User is not logged in"]);
    }

    function clickedButton()
    {
        session_start();
        if(!(isset($_SESSION["username"])))
        {
            return redirect()->route('login', ["message"=>"You are not logged in!"]);
        }
        $user = User::where("name", $_SESSION["username"])->first();
        if(!(isset($user->loggedIn)))
        {
            return redirect()->route('login', ["message"=>"User is not logged in"]);
        }


        $word = Words::inRandomOrder()->limit(1)->get();
        $user->clicks++;

        $user->save();


        $history = new History;

        $history->userId = $user->id;
        $history->word = $word[0]->word;

        $history->save();


        return redirect()->route('landing');
    }
}
