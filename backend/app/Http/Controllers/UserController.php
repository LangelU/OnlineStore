<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller {
    public function newUser(Request $request){
        $newUser = new User;
        $newUser->names        = $request->input('names');
        $newUser->lastnames   = $request->input('lastnames');
        $newUser->email         = $request->input('email');
        $newUser->password      = $request->input('password');
        $newUser->ID_role       = $request->input('ID_role');
        $newUser->save();

        return response()->json(['success'=>'User created successfully'], 201);
    }
}
