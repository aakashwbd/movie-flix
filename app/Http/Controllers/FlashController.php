<?php

namespace App\Http\Controllers;

use App\Models\Flash;
use App\Models\UserFlash;
use Illuminate\Http\Request;

class FlashController extends Controller
{
    public function store (Request $request){
//dd($request->all());

        try {
            $flash = new Flash();
            $flash->name = $request->name;


            if ($flash->save()){
                return response([
                    "status" => "success",
                    "message" => "Flash Successfully Save"
                ]);
            }


        }catch (\Exception $e){
            return response([
                'status' => 'serverError',
                'message' => $e->getMessage(),
            ], 500);
        }
    }


    public function sendFlash (Request $request){
//dd($request->all());

        try {
            $flash = new UserFlash();
            $flash->sender_id = auth()->id();
            $flash->receiver_id = $request->receiver_id;
            $flash->flash_id = $request->flash_id;

            if ($flash->save()){
                return response([
                    "status" => "success",
                    "message" => "Flash Successfully Save"
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
//dd($request->all());

        try {
            $flash = Flash::all();


            if ($flash){
                return response([
                    "status" => "success",
                    "data" => $flash
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
