<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Words;
use App\Models\User;
use App\Models\Chat;
use App\Models\History;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

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


    function showChat()
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
        $chats = Chat::all();

        return view('chat', ["user" => $user, "chats"=>$chats]);
    }

    function chat(Request $request)
    {
        Log::info("Trying to create new chat");


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


        $validator = Validator::make($request->all(), $this->getUserValidationRules());

        if ($validator->fails()) {
            return redirect()->route('chat',  ["message"=> "Message too long"]);
        }

        $chat = new Chat();

        $chat->username = $user->name;
        $chat->sentence = $request->chat;

        $chat->save();

        return redirect()->route('chat');
    }

    function getUserValidationRules()
    {
        return [
            'chat' => 'required|max:50'
        ];
    }

    /*function checkIfChatIsAdded(Chat $lastChatId, User $user)
    {
        $newChats = Chat::where('id', '>', $lastChatId)->get();
        Log::info("Running!");
        if ($newChats->count() > 1) {
            // Return the new chats as a JSON response
            Log::info("New chat!");
            $chats = Chat::all();
            return view('chat', ["user" => $user, "chats"=>$chats]);
        }


        while (true) {
            checkIfChatIsAdded($lastChatId, $user);
            sleep(3);
        }
    }*/


    function resetChats()
    {
        Chat::truncate();
        return redirect()->route("landing");
    }

    public function getNewChat()
    {
        // Retrieve the new chat from the database here
        // For example:
        $newChat = Chat::latest()->first();
        $chats = Chat::all();
        // Return the HTML for the new chat
        return ['chats' => $chats];
    }
}
