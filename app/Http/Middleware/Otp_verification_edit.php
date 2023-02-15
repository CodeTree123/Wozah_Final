<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\otp_verify;
use Auth;
use Carbon\Carbon;
use Exception;
use Twilio\Rest\Client;

class Otp_verification_edit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */


    public function handle(Request $request, Closure $next)
    {
        if ($request->otp) {
  
            $phone = otp_verify::where(['mobile' => $request->phone])->first();
            // dd($phone);
            if (!empty($phone)) {
              //otp ckeck
              if ($phone && $phone->otp == $request->otp) {
                $phone->update([
                  'otp' => '',
                  'verified_at' => 1
                ]);
                
              }else{
                return back();
              }
    
            }
            return $next($request);
          } else {
            $receiver_number = "+". 88 . $request->phone;
            $phoneinfo = otp_verify::where('mobile', $receiver_number)->first();
            // dd($phoneinfo);
            $otp = rand(1000,9999);
            // $this->send_sms($request->phone, $otp);
            $message =  $otp;
            $account_sid = getenv("TWILIO_SID");
            $auth_token = getenv("TWILIO_TOKEN");
            $twilio_number = getenv("TWILIO_FROM");
            // dd($receiver_number,$phoneinfo,$otp,$message,$account_sid,$auth_token,$twilio_number);

            $client = new Client($account_sid, $auth_token);
            $client->messages->create($receiver_number,[
                'from' => $twilio_number,
                'body' =>"Your Wozah Varification Code is -". $message
                  ]);
              if(!$phoneinfo){
                otp_verify::create([
                  'mobile'=>$request->phone,
                  'otp' =>  $otp,
                  'verified_at' => 0
                  ]);
              }else{
                // $phoneinfo->update([
                //   'otp' =>  $otp,
                //   'verified_at' => 0
                //   ]);
                return $next($request);
              }
              $request->request->add(['verify' => true]);
              return redirect()->back()->with('otp_msg',$message)->withInput();
        }
    }
}
