<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum'], ['only' => ['store']]);
    }

    public function store(Request $request)
    {
        try {

            $checkout = new Checkout();
            $checkout->user_id = auth()->id();
            $checkout->package = $request->package;
            $checkout->duration = $request->duration;
            $checkout->price = $request->price;

            if ($checkout->save()) {
                return response([
                    "status" => "success",
                    "message" => "Package Successfully Save"
                ]);
            }


        } catch (\Exception $e) {
            return response([
                'status' => 'serverError',
                'message' => $e->getMessage(),
            ], 500);
        }

    }

    public function getAll(Request $request)
    {
        try {
            $checkout = Checkout::query()
                ->latest()
                ->get();

            if ($request->ajax()) {
                return Datatables::of($checkout)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $button = '<button class="btn btn-primary rounded-0 text-capitalize" data-id="' . $row->id . '" >Accept</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return response([
                "status" => "success",
                "data" => $checkout
            ]);
        } catch (\Exception $e) {
            return response([
                'status' => 'serverError',
                'message' => $e->getMessage(),
            ], 500);
        }

    }

    public function allSubcribeUser(Request $request)
    {
        try {
            $checkout = Checkout::with('user')
                ->latest()
                ->get();

            return response([
                "status" => "success",
                "data" => $checkout
            ]);
        } catch (\Exception $e) {
            return response([
                'status' => 'serverError',
                'message' => $e->getMessage(),
            ], 500);
        }

    }
}
