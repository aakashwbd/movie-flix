<?php

namespace App\Http\Controllers;

use App\Models\Testimony;
use Illuminate\Http\Request;

class TestimonyController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum'], ['only' => ['store']]);
    }

    public function store (Request $request){
        try {
            $testimony= new Testimony();
            $testimony->user_id = auth()->id();
            $testimony->testimony_user_id = $request->testimony_user_id;
            $testimony->description = $request->description;


            if ($testimony->save()){
                return response([
                    "status" => "success",
                    "message" => "Testimony Successfully Done"
                ]);
            }
        }catch (\Exception $e){
            return response([
                'status' => 'serverError',
                'message' => $e->getMessage(),
            ], 500);
        }

    }


    public function show ($id){
        try {
            $testimony= Testimony::with('user')
            ->where('testimony_user_id', $id)
                ->get();

            if ($testimony){
                return response([
                    "status" => "success",
                    "data" => $testimony
                ]);
            }
        }catch (\Exception $e){
            return response([
                'status' => 'serverError',
                'message' => $e->getMessage(),
            ], 500);
        }

    }
    public function getAll ($id){
        try {
            $testimony= Testimony::with('user')
                ->get();

            if ($testimony){
                return response([
                    "status" => "success",
                    "data" => $testimony
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
