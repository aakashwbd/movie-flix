<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function store (Request $request){
        try {
            $category = new Category();
            $category->name = $request->name;
            $category->image = $request->image;

            if ($category->save()){
                return response([
                    "status" => "success",
                    "message" => "Category Successfully Save"
                ]);
            }


        }catch (\Exception $e){
            return response([
                                'status' => 'serverError',
                                'message' => $e->getMessage(),
                            ], 500);
        }
    }

    public function getAll (Request $request){
        try {
            $category = Category::latest()->get();



                return response([
                    "status" => "success",
                    "data" => $category
                ]);



        }catch (\Exception $e){
            return response([
                'status' => 'serverError',
                'message' => $e->getMessage(),
            ], 500);
        }
    }


}
