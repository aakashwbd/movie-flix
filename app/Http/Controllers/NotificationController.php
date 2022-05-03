<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

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
}
