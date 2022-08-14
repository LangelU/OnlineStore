<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use DB;

class ProductController extends Controller {

    public function createProduct(Request $request){
        $produtReference = $request->input("reference");
        $validateExistence = DB::table("products")->select("*")
        ->where('reference', '=', $produtReference)->get();
        $picture = "000";

        if($validateExistence->isEmpty()){
            $newProduct = new Product;
            $newProduct->reference      = $request->input("reference");
            $newProduct->name           = $request->input("prod_name");
            $newProduct->details        = $request->input("prod_details");
            $newProduct->price          = $request->input("prod_price");
            $newProduct->iva            = $request->input("prod_iva");
            $newProduct->stock          = $request->input("prod_stock");
            $newProduct->picture        = $picture;
            $newProduct->brand          = $request->input("prod_brand");
            $newProduct->model          = $request->input("prod_model");
            $newProduct->ID_category    = $request->input("prod_category");
            $newProduct->save();

            return view('notifications.productCreated');
        }
        else{
            return view('notifications.productNotCreated');
        }  
    }

    public function showAllProducts(){
        $products = DB::table("products")->select("*")->get();

        if ($products->isEmpty()) {
            return response ()->json (['status'=>'error','message'=>
            'Products not found'], 404);
        }
        else{
            return view('mainhome.home', ['products'=>$products]);
        }     
    }

    public function updateProduct(Request $request, $idProduct){
        $oldData = DB::table('products')->select('*')
        ->where('ID', '=', $idProduct)->get();

        $reference      = $request->input("reference");
        $name           = $request->input("prod_name");
        $details        = $request->input("prod_details");
        $price          = $request->input("prod_price");
        $ID_category    = $request->input("prod_category");
        $stock          = $request->input("prod_stock");
        $brand          = $request->input("prod_brand");
        $model          = $request->input("prod_model");
        $iva            = $request->input("prod_iva");
        $picture        = $request->input("prod_picture");
        

        $updateProduct = DB::table('products')->where('ID', '=', $idProduct)
        ->update([
            'reference'     => $reference,
            'name'          => $name,
            'details'       => $details,
            'price'         => $price,
            'ID_category'   => $ID_category,
            'stock'         => $stock,
            'brand'         => $brand,
            'model'         => $model,
            'iva'           => $iva,
            'picture'       => $picture
        ]);
        $newData = DB::table('products')->select('*')
        ->where('ID', '=', $idProduct)->get();

        if ($oldData == $newData) {
            return response()->json(['status'=>'error', 'message'=>
            'Could not update Product'], 409);
        } else {
            return response()->json(['status'=>'success', 'message'=>
            'Product updated successfully', 'response'=>['data'=>$newData]], 200);
        }
        
    }

    public function productDetails($idProduct){

        $productData = Product::join(
        'categories', 'products.ID_category', '=', 'categories.ID')
        ->select("*")
        ->where('products.ID', '=', $idProduct)
        ->get();

        return view('mainhome.prodDetails', ['prodData'=>$productData]);

    } 

    public function productsByCategory($idCategory) {
        $products = DB::table('products')->select('*')
        ->where('ID_category', '=', $idCategory)
        ->get();

        if ($products->isEmpty()) {
            return response()->json(['error'=>
            'No product were found with the category selected'], 404);
        } else {
            return response()->json(['success'=>$products], 200);
        }
    }
    
    public function deleteProduct($idProduct){
        $deleteProduct = DB::table('products')
        ->where('ID', '=', $idProduct)->delete();

        return response()->json(['success'=>'Product deleted successfully'], 200);
    }
}
