<?php

namespace App\Http\Controllers;

use App\Models\Flash;
use App\Models\UserFlash;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FlashController extends Controller
{
    public function store (Request $request){

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
    public function delete ($id){
        try {
            $flash = Flash::where('id', $id)->delete();

            if ($flash){
                return response([
                    "status" => "success",
                    "data" => 'Flash Delete Successfully Done'
                ]);
            }

        }catch (\Exception $e){
            return response([
                'status' => 'serverError',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function singleShow ($id){
        try {
            $flash = Flash::where('id', $id)->first();

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

    public function allList (Request $request){

        try {
            $flash = Flash::query()->get();

            if ($request->ajax()) {
                return Datatables::of($flash)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $button = '<button class="btn btn-primary rounded-0 text-capitalize" data-id="'.$row->id.'" onclick="flashEditHandler('.$row->id.')">Edit</button>';
                        $button = $button. '<button class="btn btn-outline-primary rounded-0 text-capitalize ms-3" data-id="'.$row->id.'" onclick="flashDeleteHandler('.$row->id.')">Delete</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }


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


    public function update (Request $request, $id){
        try {

            $flashData = Flash::where('id', $id)->first();
            if ($flashData) {
                $flashData->name = $request->name ?? $flashData->name;

                if ($flashData->update()) {
                    return response([
                        "status" => "success",
                        "message" => "Flash Update Successfully Complete"
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
}
