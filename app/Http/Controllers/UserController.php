<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Http\Response;

use Illuminate\Http\Request;

class UserController extends Controller
{
    function createUser(Request $request)
    {
        Log::info("Trying to create a new user");


        $validator = Validator::make($request->all(), $this->getUserValidationRules());

        if ($validator->fails()) {
            return redirect()->route('register',  ["message"=> "Account already exists"]);
        }

        $user = new User;

        $name = $request->name;
        $password = password_hash($request->password, PASSWORD_DEFAULT);

        $user->name = $name;
        $user->password = $password;

        $user->save();

        $this->successfullyLoginUser($user);
        return redirect()->route('landing');
    }

    function getUserValidationRules()
    {
        return [
            'name' => 'required|unique:users|max:18',
            'password' => 'required|max:255'
        ];
    }

    function loginUser(Request $request)
    {
        Log::info("Trying to log a user in");

        $users = User::all();
        foreach ($users as $user)
        {
            $username = $user->name;
            $password = $user->password;
            if($_POST["name"] == $username)
            {

                if(password_verify($_POST["password"], $password))
                {
                    if($user->disabled)
                    {
                        return redirect()->route('login',  ["message"=> "Your account is disabled!"]);
                    }
                    echo "<p style='color:green;'>You are logged in</p>";
                    $this->successfullyLoginUser($user);
                    return redirect()->route('landing');
                }
                else {
                    return redirect()->route('login',  ["message"=> "Your password is invalid"]);
                }
            }
        }
        return redirect()->route('login',  ["message"=> "Account does not exist"]);
    }

    function successfullyLoginUser(User $user)
    {
        session_start();
        $user->loggedIn = true;
        $_SESSION["username"] = $user->name;
        $user->save();
    }

    function logOut()
    {
        session_start();
        if(!(isset($_SESSION["username"])))
        {
            return redirect()->route('login', ["message"=>"You are not logged in!"]);
        }
        $user = User::where("name", $_SESSION["username"])->first();
        $user->loggedIn = false;
        $user->save();

        return redirect()->route('login');
    }
}
