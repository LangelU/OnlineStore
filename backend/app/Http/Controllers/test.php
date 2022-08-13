<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class test extends Controller
{
  public function test($idUser){
    $products = DB::table('shopping_carts')->select('ID_product')
        ->where('ID_user', '=', $idUser)->get();
    
        print($products);
  }
}
