<?php

namespace App\Http\Controllers;

use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\SalesHistory;
use DB;

class ShoppingCartController extends Controller {

    public function addNewProduct(Request $request, $idUser, $idProduct, $productPrice, $iva) {
        //First, find existence for this prodcut in the shopping cart
        $validateExistence = DB::table("shopping_carts")->select("*")
        ->where('ID_product', '=', $idProduct)
        ->where('ID_user', '=', $idUser)->get();
        $amount = $request->input("amount");
        $ivaValue = ($productPrice * $iva) * $amount;

        //If not exist, add
        if ($validateExistence->isEmpty()) {
            $addAProduct = new ShoppingCart;

            $addAProduct->ID_user           = $idUser;
            $addAProduct->ID_product        = $idProduct;
            $addAProduct->amount            = $amount;
            $addAProduct->unit_price        = $productPrice;
            $addAProduct->sub_totalValue    = ($productPrice * $amount) + $ivaValue;
            $addAProduct->save();
            
            $productAdded = DB::table("shopping_carts")->select("*")
            ->where('ID_product', '=', $idProduct)
            ->where('ID_user', '=', $idUser)->get();

            return response ()->json(['status'=>'success', 'message'=>
            'Product added successfully', 'response'=>['data'=>$productAdded]],200);
        }
        //If exist, update the amount
        else {

            $updateAmount = DB::table('shopping_carts')
            ->where('ID_product', '=', $idProduct)
            ->where('ID_user', '=', $idUser)
            ->update([
                'amount' => $amount,
            ]);

            $productUpdated = DB::table("shopping_carts")->select("*")
            ->where('ID_product', '=', $idProduct)
            ->where('ID_user', '=', $idUser)->get();

            return response ()->json(['status'=>'success', 'message'=>
            'Amount updated successfully', 
            'response'=>['data'=>$productUpdated]], 201);
        }
    }


    public function showCartContent($idUser) {
        $shopingCartContent = DB::table("shopping_carts")->select("*")
        ->where('ID_user','=',$idUser)->get();

        if ($shopingCartContent->isEmpty()) {
            return response ()->json(['status'=>'error', 'message'=>
            'Products not found'], 404);
        } 

        else {
            $totalValue = DB::table('shopping_carts')
            ->where('ID_user', '=', $idUser)
            ->sum('sub_totalValue');

            return response ()->json(['status'=>'success', 'message'=>
            'Products found', 'response'=>
            ['data'=>$shopingCartContent, 'totalValue'=>$totalValue]], 200);
        }
    }

    public function deleteProduct($idUser, $idProduct) {
        $deleteProduct = DB::table('shopping_carts')
        ->where('ID_product', '=', $idProduct)
        ->where('ID_user', '=', $idUser)
        ->delete();


        return response ()->json(['status'=>'success', 'message'=>
        'Shopping cart updated successfully', 'response'=>['data'=>$cartUpdated]], 200);
    }

    public function saleNumberGenerator(){
        $saleNumber = rand(0000000001, 9999999999);
        return $saleNumber;
    }


    public function validateCart($idUser) {
        $saleNumber = $this->saleNumberGenerator();
        $validateExistence = DB::table("sales")->select("*")
        ->where('saleNumber', '=', $saleNumber)->get();

        if ($validateExistence->isEmpty()) {
            //First, add buy to the sales table
        
            $addSalesSQL = "INSERT INTO sales 
                            (saleNumber,
                            ID_product,
                            ID_user,
                            amount,
                            unitary_value,
                            total_value,
                            created_at,
                            updated_at)
                            SELECT $saleNumber,
                            ID_product,
                            ID_user,
                            amount,
                            unit_price,
                            sub_totalValue,
                            NOW(),
                            NOW()
                            FROM shopping_carts sc
                            WHERE sc.ID_user = $idUser";
            $addSales = DB::select($addSalesSQL);

            //Second, add sale to the sale history
            $addSaleHistorySQL = "INSERT INTO sales_histories 
                                  (saleNumber,
                                  total_value,
                                  ID_user,
                                  created_at,
                                  updated_at) 
                                  VALUES 
                                  ($saleNumber,
                                  (SELECT SUM(sub_totalValue)
                                  FROM shopping_carts sc
                                  WHERE sc.ID_user = $idUser),
                                  $idUser,
                                  NOW(),
                                  NOW())";
            $totalValue = DB::select($addSaleHistorySQL);
            $purchasedItems = $this->showCartContent($idUser);
            //$deleteShoppingCartSQL = "DELETE FROM shopping_carts WHERE ID_user = $idUser";
            //$deleteShoppingCart = DB::select($deleteShoppingCartSQL);

            return response ()->json(['status'=>'success', 'message'=>
            'Buy validated successfully', 'data'=>$purchasedItems], 200);
            
        } else {
            return response ()->json(['status'=>'error', 'message'=>
            'Internal error', 'response'=>'Try again'], 500);
        }
    }

    public function deleteCart($idUser){
        $deleteSQL = "DELETE from shopping_carts WHERE ID_user = $idUser";
        $deleteCart = DB::select($deleteSQL);

        return response ()->json(['status'=>'success', 'message'=>
        'Cart deleted successfully'], 200);
    }

    public function test2($idUser){
        $saleNumber = 3167287159;
        //Customer name
        $customerName = DB::table('customers')
        ->join('users', 'users.email', '=', 'customers.email')
        ->join('sales', 'sales.ID_user', '=', 'users.ID')
        ->select('customers.f_name', 'customers.f_lastname')
        ->limit(1)
        ->get();


        //Sale detail
        $saleDetail = DB::table('products')
        ->join('sales', 'sales.ID_product', '=', 'products.ID')
        ->where('sales.saleNumber', '=', $saleNumber)
        ->where('sales.ID_user', '=', $idUser)
        ->select('products.reference',
                 'products.name',
                 'sales.unitary_value',
                 'sales.amount',
                 'sales.total_value')
        ->get();

        $totalValue = DB::table("sale_histories")->select("total_value")
        ->where('ID_user', '=', $idUser)->get();

        //Array to capture all data for send in e-mail body
        $data = array('name'=>$customerName,
                      'saleDetails'=>$saleDetail,
                      'saleNumber'=>$saleNumber);
        return response ()->json(['status'=>'success', 'message'=>
        'Success',
        'response'=>
        ['name'=>$data['name'], 
         'saleDetails'=>$data['saleDetail'],
         'total'=>$totalValue]], 200);
    }
}
