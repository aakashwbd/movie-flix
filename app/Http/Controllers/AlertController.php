<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

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

    public function getAll (Request $request){
        try {
            $alert= Alert::with('user')
            ->get();

            if ($request->ajax()) {
                return Datatables::of($alert)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $button = '<button class="btn btn-primary rounded-0 text-capitalize" data-id="'.$row->id.'" onclick="flashEditHandler('.$row->id.')">Edit</button>';
                        $button = $button. '<button class="btn btn-outline-primary rounded-0 text-capitalize ms-3" data-id="'.$row->id.'" onclick="flashDeleteHandler('.$row->id.')">Delete</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            if ($alert){
                return response([
                                    "status" => "success",
                                    "data" => $alert
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
