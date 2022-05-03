<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index (Request $request){


        try {

            $banner = Banner::all();

            return response([
                "status" => "success",
                "data" => $banner
            ]);

        }catch (\Exception $e){
            return response([
                'status' => 'serverError',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function store (Request $request){
        try {
            $banner = new Banner();
            $banner->image = $request->image;

            if ($banner->save()){
                return response([
                    "status" => "success",
                    "message" => "Banner Image Successfully Save"
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
