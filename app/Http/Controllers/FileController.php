<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum'], ['only' => ['store']]);
    }
    public function store (Request $request){
//dd($request->all());

        try {
            $file = new File();
            $file->user_id = auth()->id();
            $file->video = $request->video;
            $file->image = $request->image;
            $file->privacy = $request->privacy;


            if ($file->save()){
                return response([
                    "status" => "success",
                    "message" => "File Successfully Save"
                ]);
            }


        }catch (\Exception $e){
            return response([
                'status' => 'serverError',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function getVideo (Request $request){


        try {
            $video =  File::with('user')
                ->where('privacy','public')
                ->get();



                return response([
                    "status" => "success",
                    "data" => $video
                ]);



        }catch (\Exception $e){
            return response([
                'status' => 'serverError',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function singleVideo ($id){

        try {
            $video =  File::with('user')
                ->where('id',$id)
                ->first();


                return response([
                    "status" => "success",
                    "data" => $video
                ]);



        }catch (\Exception $e){
            return response([
                'status' => 'serverError',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function search (Request $request){

//        dd($request->all());

        try {
            $ad = File::with('user')->where('address', 'LIKE', '%'.$request->address.'%')
                ->whereHas('user', function ($query) use($request){
                    $query->whereBetween('age', [$request->minage, $request->maxage]);
                })
                ->get();
            return response([
                "status" => "success",
                "data" => $ad
            ]);


        }catch (\Exception $e){
            return response([
                'status' => 'serverError',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
