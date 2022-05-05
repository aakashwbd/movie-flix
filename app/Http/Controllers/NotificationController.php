<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class NotificationController extends Controller
{
    public function store (Request $request){
        try {
            $notification = new Notification();
            $notification->title = $request->title;
            $notification->description = $request->description;
            $notification->package_id = $request->package_id;
            $notification->video_id = $request->video_id;
            $notification->link = $request->link;
            $notification->image = $request->image;



            if ($notification->save()){
                return response([
                    "status" => "success",
                    "message" => "Notification Successfully Send"
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
            $notification = Notification::where('id', $id)->delete();




            if ($notification){
                return response([
                    "status" => "success",
                    "message" => "Notification Successfully Delete"
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
        $notification = Notification::query()->get();
        if ($request->ajax()) {
            return Datatables::of($notification)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $button = '<button class="btn btn-primary rounded-0 text-capitalize" data-id="'.$row->id.'" onclick="notificationDeleteHandler('.$row->id.')">Delete</button>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return response([
            "status"=> 'success',
            "data"=> $notification
        ]) ;
    }
}
