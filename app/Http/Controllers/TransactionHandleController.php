<?php

namespace App\Http\Controllers;

use App\SendMoneyRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TransactionHandleController extends Controller
{
    //This function is handling money send email link requests (controlling access with transaction key
    public function handleMoneySendRequest($transactionKey){
        $checkTranKey = SendMoneyRequest::select(['*'])->where('transaction_key',$transactionKey)->first();
        if($checkTranKey != null){
            $exsistinghUserCheck = User::select(['*'])->where('email',$checkTranKey->send_email)->first();
            if($exsistinghUserCheck != null){
                return redirect()->route('master.receivedMoney_View');
            }else{
                return view('auth.registerViaTrankey')->with(['recEmail'=>$checkTranKey->send_email]);
            }

        }else{
            Session::flash('message.level', 'danger');
            Session::flash('message.content', 'Invalid Transaction ID');
            return redirect()->route('welcome');
        }
    }
}
