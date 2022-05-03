<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class WebrtcStreamingController extends Controller
{

    public function index()
    {
        return view('landing.live.streaming', ['type' => 'broadcaster', 'id' => Auth::id()]);
    }

    public function consumer(Request $request, $streamId)
    {
        return view('landing.live.streaming', ['type' => 'consumer', 'streamId' => $streamId, 'id' => Auth::id()]);
    }


}
