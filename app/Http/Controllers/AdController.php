<?php

namespace App\Http\Controllers;


use App\Models\Ad;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum'], ['only' => ['store']]);
    }

    public function store (Request $request){
        try {
            $ad = new Ad();
            $ad->user_id = auth()->id();
            $ad->title = $request->title;
            $ad->address = $request->address;
            $ad->description = $request->description;
            $ad->duration = $request->duration;
            $ad->image = $request->image;

            if ($ad->save()){
                return response([
                    "status" => "success",
                    "message" => "Ads Upload Successfully Done"
                ]);
            }
        }catch (\Exception $e){
            return response([
                'status' => 'serverError',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function update (Request $request){

        try {
            $ad =   Ad::where('id', $request->ad_id);
            if($ad){
                $ad->title = $request->title ?? $ad->title;
                $ad->address = $request->address ?? $ad->address;
                $ad->description = $request->description ?? $ad->description;
//                $ad->duration = $request->duration ?? $ad->duration;
//                $ad->image = $request->image ?? $ad->image;

                if ($ad->update()){
                    return response([
                        "status" => "success",
                        "message" => "Ads Update Successfully Done"
                    ]);
                }
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
            $data = Ad::with('user')
                ->get();
//            $data = Ad::query()
//                ->get();
            return response([
                "status" => "success",
                "data" => $data
            ]);

        }catch (\Exception $e){
            return response([
                'status' => 'serverError',
                'message' => $e->getMessage(),
            ], 500);
        }
    }


    public function search (Request $request){
        try {
           if($request->address){
                $ad = Ad::with('user')->where('address', 'LIKE', '%'.$request->address.'%')
                    ->whereHas('user', function ($query) use($request){
                        $query->whereBetween('age', [$request->minage, $request->maxage]);
                    })
                    ->get();
                return response([
                    "status" => "success",
                    "data" => $ad
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
