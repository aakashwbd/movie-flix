<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum'], ['only' => ['store']]);
    }

    public function store (Request $request){
        try {

            $blog = new Blog();
            $blog->user_id = auth()->id();
            $blog->title = $request->title;
            $blog->description = $request->description;


            if ($blog->save()){
                return response([
                                    "status" => "success",
                                    "message" => "Blog Successfully Done"
                                ]);
            }


        }catch (\Exception $e){
            return response([
                                'status' => 'serverError',
                                'message' => $e->getMessage(),
                            ], 500);
        }

    }


    public function index ($id){
        try {

            $blog =  Blog::with(['user','blog_comments.user'])
                    ->where('id', $id)->first();

            if ($blog){
                return response([
                                    "status" => "success",
                                    "data" => $blog
                                ]);
            }


        }catch (\Exception $e){
            return response([
                                'status' => 'serverError',
                                'message' => $e->getMessage(),
                            ], 500);
        }

    }


    public function show (){

        try {
            $blog =  Blog::all();
            if ($blog){
                return response([
                                    "status" => "success",
                                    "data" => $blog
                                ]);
            }


        }catch (\Exception $e){
            return response([
                                'status' => 'serverError',
                                'message' => $e->getMessage(),
                            ], 500);
        }

    }
}
