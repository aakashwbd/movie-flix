<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    public function  index(Request $request, $user_role_id){
        $user = User::query()
            ->where('user_role_id', $user_role_id)
            ->latest()
            ->get();

        if ($request->ajax()) {
            return Datatables::of($user)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $button = '<button class="btn btn-primary text-capitalize" data-id="'.$row->id.'">edit</button>';
                    $button = $button. '<button class="btn btn-primary text-capitalize ms-3" data-id="'.$row->id.'">delete</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return response([
                            "status"=> 'success',
                            "data"=> $user
                        ]) ;
    }
}
