<?php

namespace App\Http\Controllers;

use App\Models\BlockList;
use Illuminate\Http\Request;

class BlockController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum'], ['only' => ['store', 'index']]);
    }

    public function store (Request $request){
        try {
            $block = new BlockList();
            $block->user_id = auth()->id();
            $block->block_user_id = $request->block_user_id;


            if ($block->save()){
                return response([
                                    "status" => "success",
                                    "message" => "Block Successfully Done"
                                ]);
            }
        }catch (\Exception $e){
            return response([
                                'status' => 'serverError',
                                'message' => $e->getMessage(),
                            ], 500);
        }

    }


    public function index (){
        try {
            $block = BlockList::with('block_user')
                ->where('user_id', auth()->id())->get();

            if ($block){
                return response([
                                    "status" => "success",
                                    "data" => $block
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
