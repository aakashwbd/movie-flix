<?php

namespace App\Http\Controllers;

use App\Models\BlogComment;
use Illuminate\Http\Request;

class BlogCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum'], ['only' => ['store']]);
    }

    public function store (Request $request){
        try {

            $blog = new BlogComment();
            $blog->user_id = auth()->id();
            $blog->blog_id = $request->blog_id;
            $blog->comment_text = $request->comment_text;


            if ($blog->save()){
                return response([
                    "status" => "success",
                    "message" => "Blog Comment Successfully Done"
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
