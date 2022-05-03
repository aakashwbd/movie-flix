<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum'], ['only' => ['store']]);
    }

    public function store (Request $request){

//        dd($request->all());

        try {

            $checkout = new Checkout();
            $checkout->name = $request->package;
            $checkout->price = $request->price;

            if ($checkout->save()){
                return response([
                                    "status" => "success",
                                    "message" => "Category Successfully Save"
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
