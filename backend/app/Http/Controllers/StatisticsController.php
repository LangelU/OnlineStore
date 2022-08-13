<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Sales;

class StatisticsController extends Controller {
    

    public function mostSelledProducts() {
        $bestSelledSQL  = "SELECT p.name, SUM(s.amount) AS cant
                            FROM products p
                            JOIN sales s 
                            ON s.ID_product = p.ID
                            GROUP BY p.name
                            ORDER BY SUM(s.amount) DESC
                            LIMIT 15";
        $bestSelled = DB::select($bestSelledSQL);
        return response()->json([$bestSelled]);
    }


    public function saleHistory() {
        $salesHistory = DB::table('sales_histories')
        ->join('users', 'users.ID', '=', 'sales_histories.ID_user')
        ->select(
            'users.names AS name',
            'users.lastnames AS lastname',
            'sales_histories.total_value',
            'sales_histories.saleNumber AS saleCode',
            'sales_histories.created_at AS saleDate'
        )
        ->get();

        return response()->json([$salesHistory]);
    }

    public function bestBuyers() {
        $bestBuyersSQL = "SELECT u.names AS name, u.lastnames AS lastname,
                       s.total_value AS value
                       FROM users u
                       JOIN sales_histories s
                       ON u.ID = s.ID_user
                       GROUP BY u.names
                       ORDER BY SUM(s.total_value) DESC";
        $bestBuyers = DB::select($bestBuyersSQL);

        return response()->json([$bestBuyers]);
    }


}
