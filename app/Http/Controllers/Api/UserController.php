<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\userRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\logintRequest;

class UserController extends Controller
{
    public function register(userRequest $req){
        $data=User::create($req);
        return response()->json([
            "user"=>$data,
            "message"=>"success create user"
        ],201);
    }

    public function login(logintRequest $req){
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->plainTextToken;
            $success['name'] =  $user->name;
            return response()->json([
                "user"=>$success,
                "message"=>"success login"
            ],200);

        }
        return response()->json(["message"=>"your email or password incorrect"]);


    }
}
