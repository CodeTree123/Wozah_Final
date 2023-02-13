<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Carbon\Carbon;
use App\Models\User;
use App\Models\customer_info;
use App\Models\shop_info;
use App\Models\service_provider_doc;
use App\Models\individual_info;


class AuthController extends Controller
{
    //
    public function new_register(Request $request){
        // dd($request->all());
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'shop_name' => $request->shop_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role_id' => $request->role_id,
            'password'=>Hash::make($request['password']),
            'created_at'   =>Carbon::now()
        ]);
        if($request->role_id == 4){
            $customer_u_id = User::where('email','=',$request->email)->where('role_id','=','4')->first()->id;
            // dd($customer_u_id);
            customer_info::create([
                'u_id' => $customer_u_id,
                'created_at' => Carbon::now()
            ]);
        }
        if($request->role_id == 2){
            $shop_u_id = User::where('email','=',$request->email)->where('role_id','=','2')->first()->id;
            // dd($shop_u_id);
            shop_info::create([
                'u_id' => $shop_u_id,
                // 'shop_address' => $request->shop_address,
                'created_at'   =>Carbon::now()
            ]);
            service_provider_doc::create([
                'u_id' => $shop_u_id
            ]);
        }
        if($request->role_id == 3){
            $shop_u_id = User::where('email','=',$request->email)->where('role_id','=','3')->first()->id;
            // dd($shop_u_id);
            individual_info::create([
                'u_id' => $shop_u_id,
                'created_at'   =>Carbon::now()
            ]);
        }

        
        if($user){
            event(new Registered($user));
            return back() ->with('success','Successfully Registered and Login');
        }else{
            return back() ->with('fail','Please Check Your Information Properly');
        }

    }

    public function admin_login(Request $request){
        
        $request->validate([
            'email'=> 'required|email',
            'password'=> 'required',
        ]);
        if(Auth::attempt(['email' => request('email'), 'password' => request('password'), 'role_id' => '1'])){

            return redirect()->route('admin_deshboard');
          }
          else{
              return back()->with('fail','Please Check Your Information Properly')->onlyInput('email');
          }
    }
    public function customer_login(Request $request){

        $request->validate([
            'emailorphone'=> 'required',
            'password'=> 'required',
        ]);
        if(Auth::attempt(['phone' => request('emailorphone'), 'password' => request('password'),'role_id' => '4']) || Auth::attempt(['email' => request('emailorphone'), 'password' => request('password'),'role_id' => '4'])){
            // return Redirect::index();
            return redirect()->route('content');
          }
          else{
              return back()->with('fail','Please Check Your Information Properly')->onlyInput('emailorphone');
          }
    }

    public function shop_login(Request $request){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            // dd(Auth::user());
          // return Redirect::index();
          return redirect()->route('service_provider_index');
        }
        else{
            return back()->with('fail','Please Check Your Information Properly')->onlyInput('email');
        }
    }

    public function logout()
    {
        // dd(auth());
        // Session::flush();

        Auth::logout();

        return redirect('/')->with('success','See You again!');
    }

}
