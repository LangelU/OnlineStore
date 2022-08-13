<?php

namespace App\Http\Controllers;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StatisticsController;
use Illuminate\Http\Request;
use DB;

class LoginController extends Controller{
    
    public function login(Request $request){
        $email = $request->input('email');
        $password = $request->input('password');

        $userAdmin = DB::table('users')->select('*')
        ->where('email', '=', $email)
        ->where('password', '=', $password)
        ->where('ID_role', '=', 1)
        ->get();

        $userUser = DB::table('users')->select('*')
        ->where('email', '=', $email)
        ->where('password', '=', $password)
        ->where('ID_role', '=', 2)
        ->get();


        $prod = new StatisticsController();
        $prodStats = $prod->mostSelledProducts();

        $client = new StatisticsController();
        $clientStats = $client->bestBuyers();
 
        if ($userAdmin->isEmpty()) {
            if (!$userUser->isEmpty()) {
                return view('user.userhome', ['userData'=>$userUser]);
            } else {
                print("Wrong user or password, please try again");
            }
        } else {
            return view('admin.home', compact('userAdmin', 'clientStats', 'prodStats'));
        }
        
    }
}
