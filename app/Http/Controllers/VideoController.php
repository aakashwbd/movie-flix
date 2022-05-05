<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class VideoController extends Controller
{

    public function store (Request $request){

        try {
            $video = new Video();
            $video->video = $request->video;
            $video->title = $request->title;
            $video->category_id = $request->category_id;


            if ($video->save()){
                return response([
                    "status" => "success",
                    "message" => "Video Successfully Save"
                ]);
            }


        }catch (\Exception $e){
            return response([
                'status' => 'serverError',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function search (Request $request){

//        dd($request->all());

        try {
            $min = (int)$request->minage;
            $max = (int)$request->maxage;
            $video = Video::all();
            return response([
                "status" => "success",
                "action" => "search-video",
                "data" => $video
            ]);


        }catch (\Exception $e){
            return response([
                'status' => 'serverError',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function update (Request $request){
//        dd($request->all());
        try {
            $video = new Video();
            $video->rating = $request->id;
            if ($video->save()){
                return response([
                    "status" => "success",
                    "message" => "Video Successfully Save"
                ]);
            }


        }catch (\Exception $e){
            return response([
                'status' => 'serverError',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function index (Request $request){
        try {
            $video = Video::with('category')
            ->latest()->get();

            if ($request->ajax()) {
                return Datatables::of($video)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $button = '<button class="btn btn-primary rounded-0 text-capitalize" data-id="'.$row->id.'" onclick="videoEditHandler('.$row->id.')">Edit</button>';
                        $button = $button. '<button class="btn btn-outline-primary rounded-0 text-capitalize ms-3" data-id="'.$row->id.'" onclick="categoryDeleteHandler('.$row->id.')">Delete</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }

            return response([
                "status" => "success",
                "data" => $video
            ]);


        }catch (\Exception $e){
            return response([
                'status' => 'serverError',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function getSingle ($id){
        try {
            $video = Video::with('category')
            ->where('id', $id)->first();

            return response([
                "status" => "success",
                "data" => $video
            ]);


        }catch (\Exception $e){
            return response([
                'status' => 'serverError',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function delete ($id){
        try {
            $video = Video::where('id', $id)->delete();
            if($video){
                return response([
                    "status" => "success",
                    "message" => 'Video Delete Successfully Done'
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
