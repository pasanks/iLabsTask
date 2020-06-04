<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    //Send money form view
    public function sendMoney_View(){
        return view('pages.send_money');
    }
    //Received money table view
    public function receivedMoney_View(){
        return view('pages.received_money');
    }
    //Sent money report view
    public function sentMoneyReport_View(){
        return view('pages.sentMoneyReport');
    }
}
