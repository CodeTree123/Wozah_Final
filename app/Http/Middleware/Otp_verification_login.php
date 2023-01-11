<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\otp_verify;
use Auth;
use Carbon\Carbon;

class Otp_verification_login
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

     //sms api
      function send_sms($phone, $otp)
      {
          $url = "http://202.164.208.226/smsapi";
          $data = [
              "api_key" => "C20013386235902a575991.44900461",
              "type" => "text",
              "contacts" => "88" . $phone,
              "senderid" => "8809612442105",
              "msg" => "Your Wozah verification code " . $otp,
          ];
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, $url);
          curl_setopt($ch, CURLOPT_POST, 1);
          curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
          $response = curl_exec($ch);
          curl_close($ch);
          return $response;
      }
      //end sms api

    public function handle(Request $request, Closure $next)
    {
      

        if($request->first_name){
            $request->validate([
                'first_name'=> 'required',
                'last_name'=> 'required',
                'email'=> 'required|email|unique:users',
                'phone'=> 'required',
                'password'=> 'required',
                'password_confirmation'=> 'required|same:password'
            ]);
        }else{
            $request->validate([
                // 'first_name'=> 'required',
                // 'last_name'=> 'required',
                'shop_name'=> 'required',
                'email'=> 'required|email|unique:users',
                'phone'=> 'required',
                'password'=> 'required',
                'password_confirmation'=> 'required|same:password'
            ]);
        }
        if ($request->otp) {
  
            $phone = otp_verify::where(['mobile' => $request->phone])->first();
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
            $phoneinfo = otp_verify::where('mobile', $request->phone)->first();
            $otp = rand(1000,9999);
            
            // $this->send_sms($request->phone, $otp);

            $message = "Your OTP is:-".$otp;
              if(!$phoneinfo){
                otp_verify::create([
                  'mobile'=>$request->phone,
                  'otp' =>  $otp,
                  'verified_at' => 0
                  ]);
              }else{
                $phoneinfo->update([
                  'otp' =>  $otp,
                  'verified_at' => 0
                  ]);
              }
              $request->request->add(['verify' => true]);
              return redirect()->back()->with('otp_msg',$message)->withInput();
        }
    }
}
