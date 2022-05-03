<?php

namespace App\Http\Controllers;

use App\Models\InviteCode;
use Illuminate\Http\Request;

class InviteCodeController extends Controller
{
    public function store (Request $request){
        try {
            $invite = new InviteCode();
            $invite->title = $request->title;
            $invite->user_type = $request->user_type;
            $invite->month = $request->month;


            if ($invite->save()){
                return response([
                    "status" => "success",
                    "message" => "Invite Code Successfully Generate"
                ]);
            }


        }catch (\Exception $e){
            return response([
                'status' => 'serverError',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function  index(Request $request){
        $invite = InviteCode::latest()->get();
        if ($request->ajax()) {
            return Datatables::of($invite)
                ->addIndexColumn()
//                    ->addColumn('image',function($row){
//                        if($row->image && count(json_decode($row->image)) > 0){
//                            $imageUrl = json_decode($row->image)[0];
//                        }else{
//                            $imageUrl = asset('/assets/image/logo.png');
//                        }
//                        return '<img src="'.$imageUrl.'" height="40" width="100" />';
//                    })
//                    ->addColumn('status',function($row){
//                        $activeStatus = $row->status === 'active' ? 'checked' : '';
//                        $status = '<label class="switch"><input type="checkbox" id="approval" data-id="'.$row->id.'" '.$activeStatus.' /><span class="slider"></span></label>';
//                        return $status;
//                    })
                ->addColumn('action', function($row){
                    $button = '<button class="btn btn-primary rounded-0 text-capitalize" data-id="'.$row->id.'">delete</button>';
                    $button = $button. '<button class="btn btn-outline-primary rounded-0 text-capitalize ms-3" data-id="'.$row->id.'">banned</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
//            return response([
//                                "data"=> $user
//                            ]) ;
    }
}
