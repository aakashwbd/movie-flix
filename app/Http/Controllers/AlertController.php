<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use Illuminate\Http\Request;

class AlertController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum'], ['only' => ['store']]);
    }

    public function store (Request $request){
        try {
            $alert= new Alert();
            $alert->user_id = auth()->id();
            $alert->alert_user_id = $request->alert_user_id;


            if ($alert->save()){
                return response([
                                    "status" => "success",
                                    "message" => "Alert Successfully Done"
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
