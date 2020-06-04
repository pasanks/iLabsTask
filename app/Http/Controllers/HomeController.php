<?php

namespace App\Http\Controllers;

use App\SendMoneyRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    //Dashboard Return
    public function index()
    {
        $totalSendCount = SendMoneyRequest::select(['id'])->where('user_id',Auth::user()->id)->count();
        $totalSendAmount = SendMoneyRequest::select(['amount'])->where('user_id',Auth::user()->id)->sum('amount');
        $totalReceiveCount = SendMoneyRequest::select(['id'])->where('send_email',Auth::user()->email)->count();
        $totalReceiveAmount = SendMoneyRequest::select(['amount'])->where('send_email',Auth::user()->email)->sum('amount');
        return view('home')->with([
            'totalSendCount'=>$totalSendCount,
            'totalSendAmount'=>$totalSendAmount,
            'totalReceiveCount'=>$totalReceiveCount,
            'totalReceiveAmount'=>$totalReceiveAmount,
        ]);
    }


}
