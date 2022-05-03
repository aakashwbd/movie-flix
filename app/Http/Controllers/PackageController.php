<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PackageController extends Controller
{
    public function update (Request $request){
//        dd($request->all());

        try {
            $package = Package::where('id',$request->package_id)->first();
            $package->list = $request->list;
            $package->price = $request->price;



            if ($package->update()){
                return response([
                                    "status" => "success",
                                    "message" => "Package Save Successfully Done"
                                ]);
            }


        }catch (\Exception $e){
            return response([
                                'status' => 'serverError',
                                'message' => $e->getMessage(),
                            ], 500);
        }
    }


    public function getSingle ($id){
        //        dd($request->all());

        try {
            $package = Package::where('id',$id)->first();




            if ($package){
                return response([
                                    "status" => "success",
                                    "data" =>$package
                                ]);
            }


        }catch (\Exception $e){
            return response([
                                'status' => 'serverError',
                                'message' => $e->getMessage(),
                            ], 500);
        }
    }


    public function show (Request $request){
        try {
            $package = Package::all();

            if ($request->ajax()) {
                return Datatables::of($package)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $button = '<button data-bs-toggle="modal" data-bs-target="#packageModal" class="btn btn-primary text-capitalize" data-id="'.$row->id.'" onclick="packageHandler('.$row->id.')">Edit</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }


            if ($package){
                return response([
                                    "status" => "success",
                                    "data" => $package
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
