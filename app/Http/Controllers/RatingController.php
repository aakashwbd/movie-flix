<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum'], ['only' => ['store']]);
    }

    public function store (Request $request){
        try {
            $rating = new Rating();
            $rating->user_id = auth()->id();
            $rating->video_id = $request->video_id;
            $rating->rating = $request->rating;


            if ($rating->save()){
                return response([
                                    "status" => "success",
                                    "message" => "Comment Successfully Done"
                                ]);
            }
        }catch (\Exception $e){
            return response([
                                'status' => 'serverError',
                                'message' => $e->getMessage(),
                            ], 500);
        }

    }


    public function count ($id){
        try {
            $videoId = $id;
            $ratingCount =  Rating::where('video_id', $videoId)->count();
            $ratingSum =  Rating::where('video_id', $videoId)->sum('rating');
            $finalRating = $ratingSum /$ratingCount;

            if ($finalRating){
                return response([
                                    "status" => "success",
                                    "data" => $finalRating
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
