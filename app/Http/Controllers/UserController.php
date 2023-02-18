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
            return response()->json(["errors" => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user = new User;

        $name = $request->name;
        $password = password_hash($request->password, PASSWORD_DEFAULT);

        $user->name = $name;
        $user->password = $password ;

        $user->save();

        $this->successfullyLoginUser($user);
        return redirect()->route('landing');
    }

    function getUserValidationRules()
    {
        return [
            'name' => 'required|unique:users|max:255',
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
        echo "<p style='color:red;'>Account does not exist</p>";
        exit();
    }

    function successfullyLoginUser(User $user)
    {
        $user->loggedIn = true;
        $user->save();
    }
}
