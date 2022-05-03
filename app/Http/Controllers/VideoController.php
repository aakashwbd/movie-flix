<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum'], ['only' => ['store']]);
    }
    public function store (Request $request){

        try {
            $video = new Video();
            $video->user_id = auth()->id();
            $video->video = $request->video;
            $video->privacy = $request->privacy;


            if ($video->save()){
                return response([
                    "status" => "success",
                    "message" => "Video Successfully Save"
                ]);
            }


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
            $min = (int)$request->minage;
            $max = (int)$request->maxage;
            $video = Video::all();
            return response([
                "status" => "success",
                "action" => "search-video",
                "data" => $video
            ]);


        }catch (\Exception $e){
            return response([
                'status' => 'serverError',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function update (Request $request){
//        dd($request->all());
        try {
            $video = new Video();
            $video->rating = $request->id;





            if ($video->save()){
                return response([
                    "status" => "success",
                    "message" => "Video Successfully Save"
                ]);
            }


        }catch (\Exception $e){
            return response([
                'status' => 'serverError',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function index (Request $request){
        try {
            $video = Video::latest()->get();

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

    public function getSingle ($id){
        try {
            $video = Video::where('id', $id)->first();

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
}
