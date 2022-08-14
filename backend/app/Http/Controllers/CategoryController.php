<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use DB;

class CategoryController extends Controller {
    
    public function createCategory(Request $request) {
        $catName = $request->input('cat_name');
        $validateExistence = DB::table('categories')->select('*')
        ->where('category', '=', $catName)->get();

        if ($validateExistence->isEmpty()) {
            $newCategory = new Category;
            $newCategory->category = $request->input('cat_name');
            $newCategory->save();

            return view('notifications.categoryCreated');
        } else {
            return view('notifications.categoryError');
        }
        
    }

    public function showAllCategories(){
        $categories = DB::table("categories")->select("*")->get();

        if ($categories->isEmpty()) {
            return response ()->json (['status'=>'error','message'=>
            'Categories not found'], 404);
        }
        else{
            return view('admin.categories', ['categories'=>$categories]);
        }
    }

    public function updateCategory(Request $request, $idCategory) {
        $oldData = DB::table('categories')->select('*')
        ->where('ID', '=', $idCategory)->get();
        $name = $request->input("cat_name");

        $updateCategory = DB::table('categories')->where('ID', '=', $idCategory)
        ->update([
            'category'          => $name,
        ]);
        $newData = DB::table('categories')->select('*')
        ->where('ID', '=', $idCategory)->get();

        if ($oldData == $newData) {
            return response()->json(['status'=>'error', 'message'=>
            'Could not update category'], 409);
        } else {
            return response()->json(['status'=>'success', 'message'=>
            'Category updated successfully', 'response'=>['data'=>$newData]], 200);
        }
    }

    public function deleteCategory($idCategory) {
        $deleteCategory = DB::table('categories')
        ->where('ID', '=', $idCategory)->delete();

        return view('notifications.categoryDeleted');
    }
    
}
