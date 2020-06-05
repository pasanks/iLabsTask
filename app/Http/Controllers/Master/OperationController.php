<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\SendMoneyRequest;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OperationController extends Controller
{
//    main data save for money sending this function is triggering the email as well
  public function sendMoneyRequest(Request $request){
      \Log::info('Send Money Request General Log');
      \Log::info($request->all());
      $receiverEmail = $request->get('send_email');
      $receiverAmount = $request->get('amount');
      $purpose = $request->get('purpose');

      $tranKey = date('Ymdhis').mt_rand(100000, 999999); // key to identify transactions

      //sometimes SMTP Servers are not responding there for use try catches here
      try{
          if($receiverEmail == Auth::user()->email){
              $this->SendMoney_applicationLog($receiverEmail,$receiverAmount,$purpose,Auth::user()->id,Auth::user()->email,$tranKey,'User Tried to sent money to his/her own email');
              Session::flash('message.level', 'warning');
              Session::flash('message.content', 'System wont allow sending money to own accounts!');
              return redirect()->route('master.sendMoney_View');
          }else{
              $createNewMoneySendReq = new SendMoneyRequest();
              $createNewMoneySendReq->send_email = $receiverEmail;
              $createNewMoneySendReq->amount = $receiverAmount;
              $createNewMoneySendReq->purpose = $purpose;
              $createNewMoneySendReq->transaction_key = $tranKey;
              $createNewMoneySendReq->user_id = Auth::user()->id;
              $createNewMoneySendReq->created_at = Carbon::now();
              $createNewMoneySendReq->save();

              $data = array(
                  "transaction_key" =>$tranKey,
                  "sent_user" =>Auth::user()->email,
                  "receiver" =>$receiverEmail,
                  "datetime" =>Carbon::now()->format('Y-m-d H:i'),
                  "webLink" =>(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]/iLabsTask/public/handleMoneySendRequest/".$tranKey

              );// feeding array for the Email body

              \Illuminate\Support\Facades\Mail::send("emails.money_send_email", $data, function ($message) use ($receiverEmail) {
                  $message->subject("Money Receive Notification");
                  $message->to($receiverEmail);
                  $message->from(config("mail")["from"]["address"],'P2P Money Transfer');

              });
              $this->SendMoney_applicationLog($receiverEmail,$receiverAmount,$purpose,Auth::user()->id,Auth::user()->email,$tranKey,'');
              Session::flash('message.level', 'success');
              Session::flash('message.content', 'Money was successfully sent!');
              return redirect()->route('master.sendMoney_View');
          }

      }
      catch (\Exception $exception)
      {
          \Log::info('Send Money Request Error Occured');
          \Log::info($exception->getMessage());
          $this->SendMoney_applicationLog($receiverEmail,$receiverAmount,$purpose,Auth::user()->id,Auth::user()->email,$tranKey,$exception->getMessage());
          Session::flash('message.level', 'danger');
          Session::flash('message.content', 'Unexpected Error Occurred!');
          return redirect()->route('master.sendMoney_View');
      }
  }

//data feeding function for the datatable ajax function
  public function receivedMoney_getDataForDT(){
      $Details = SendMoneyRequest::select(['*'])->where('send_email',Auth::user()->email)->get();
      return datatables()->of($Details)
          ->addColumn('sender', function ($data){
           return User::find($data->user_id)->name;
          })
          ->make(true);
  }


//data feeding function for the datatable ajax function
    public function sendMoneyReport_getDataForDT(){
        $Details = SendMoneyRequest::select(['*'])->where('user_id',Auth::user()->id)->get();
        return datatables()->of($Details)
            ->make(true);
    }


//  Custom log for money send requests
    public function SendMoney_applicationLog($recEmail,$amount, $purpose,$senderID,$senderEmail,$tranKey,$error)
    {
        $fileName=date('d_m_y').'_sendMoney_log.txt';
        if(!file_exists(base_path("/systemLogs/").$fileName))
        {
            touch(base_path("/systemLogs/").$fileName);
        }
        $logfile = fopen( base_path("/systemLogs/").$fileName , "a");
        $lineBreak = "\n";
        $startLine = "================ Send Money START ".date('Y-m-d G:i:s')." =================";
        $endLine =   "================ Send Money END ".date('Y-m-d G:i:s')." =================";
        fwrite($logfile, $startLine);
        fwrite($logfile, $lineBreak);
        fwrite($logfile, $lineBreak);
        $data = 	"Receiver Email : ".$recEmail."\n".
            "Amount : ".$amount."\n".
            "Purpose : ".$purpose."\n".
            "Sender User ID : ".$senderID."\n".
            "Sender Email : ".$senderEmail."\n".
            "Transaction Key : ".$tranKey."\n".
            "Error(if any) : ".$error."\n";
        fwrite($logfile, $data);
        fwrite($logfile, $lineBreak);
        fwrite($logfile, $endLine);
        fwrite($logfile, $lineBreak);
        fwrite($logfile, $lineBreak);
        fclose($logfile);
    }


}
