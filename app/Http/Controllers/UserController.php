<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;

class UserController extends Controller
{
    function createUser(Request $request)
    {
        Log::info("Trying to create a new user");
        echo "<p>Not yet implemented</p>";
    }

    function loginUser(Request $request)
    {
        Log::info("Trying to log a user in");

        echo "<p>Not yet implemented</p>";

        /*
        
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
                        echo "<p style='color:red;'>Your account is disabled!</p>";
                        exit();
                    }
                    if($user->loggedIn)
                    {
                        echo "<p style='color:red;'>User is already logged in!</p>";
                        exit();
                    }
                    echo "<p style='color:green;'>You are logged in</p>";
                    $_SESSION["username"] = $username;
                    $user->loggedIn = true;
                    $user->save();
                    header("Location: profile");
                    exit();
                    
                }
                else {
                    echo "<p style='color:red;'>Your password is invalid</p>";
                    exit();
                }
            }
        }
        
        */ 
    }
}
