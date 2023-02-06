<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\service_provider_doc;
use App\Models\individual_info;
use Mail;
use App\Mail\WozahVerifiedMail;
use App\Models\order;
use App\Models\suborder;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function admin_deshboard(){
        return view('admin.layout.admin');
    }

    public function revenue_shop(){
        $orders=order::Where('sp_id','!=',null)->get();
        return view('admin.layout.shop_revenue_list',compact('orders'));
    }
    public function revenue_individual(){
        $orders=order::Where('sp_id','=',null)->get();
        return view('admin.layout.individual_revenue_list',compact('orders'));
    }
    public function order_view($id){
        $order_info = suborder::where('order_id',$id)->get();
        // $order_total = order::where('id','=',$id)->first()->total_price;
        $subtotal = $order_info->sum('sub_total');
        // dd($order_info->all(),$order_total,$subtotal);
        return response([
            'order_info' => $order_info,
            'subtotal' => $subtotal,
        ]);
    }
    public function admin_verified_shop_list(){
        $shops = User::where('role_id','2')->where('user_status','1')->get();
        // dd($shops);
        return view('admin.layout.shop_list',compact('shops'));
    }

    public function admin_unverified_shop_list(){
        $shops = User::where('role_id','2')->where('user_status','0')->get();
        // dd($shops);
        return view('admin.layout.shop_list',compact('shops'));
    }

    public function admin_shop_details($id){
        $shop_info = User::leftJoin('shop_infos','users.id','=','shop_infos.u_id')->Join('otp_verifies','users.phone','=','otp_verifies.mobile')->where('users.id',$id)->first(['users.*','shop_infos.*','otp_verifies.verified_at']);
        $sp_doc = service_provider_doc::where('u_id',$id)->first();
        // dd($shop_info);
        $business_address = $shop_info->street_number_b." ".$shop_info->street_name_b.", Apartment #".$shop_info->apt_b.",".$shop_info->city_b.",".$shop_info->state_b.",".$shop_info->zip_b.",USA.";
        $corporate_address = $shop_info->street_number_c." ".$shop_info->street_name_c.", Apartment #".$shop_info->apt_c.",".$shop_info->city_c.",".$shop_info->state_c.",".$shop_info->zip_c.",USA.";
        return view('admin.layout.shop_details',compact('shop_info','business_address','corporate_address','sp_doc'));
    }

    public function admin_sp_doc_status($doc_type,$id){
        $getStatus = service_provider_doc::find($id)->$doc_type;
        // dd($doc_type,$id,$getStatus);
        if($getStatus == 0){
            $status = 1;
        }else{
            $status = 0;
        }
        if($status == 1){
            service_provider_doc::where('id',$id)->update([$doc_type=>$status]);
        }else{
            service_provider_doc::where('id',$id)->update([$doc_type=>$status]);
        }
        return back()->with('success','Document Status Updated Successfully');
    }

    public function admin_sp_verification_status($id){
        $getStatus = User::find($id)->user_status;
        $email = User::find($id)->email;
        // dd($id,$getStatus);
        if($getStatus == 0){
            $status = 1;
        }else{
            $status = 0;
        }
        if($status == 1){
            User::where('id',$id)->update(['user_status'=>$status]);
        }else{
            User::where('id',$id)->update(['user_status'=>$status]);
        }
        Mail::to($email)->send(new WozahVerifiedMail());
        return back()->with('success','Document Status Updated Successfully');
    }

    public function admin_verified_individual_list(){
        $individuals = User::where('role_id','3')->where('user_status','1')->get();
        // dd($individuals);
        return view('admin.layout.individual_list',compact('individuals'));
    }

    public function admin_unverified_individual_list(){
        $individuals = User::where('role_id','3')->where('user_status','0')->get();
        // dd($individuals);
        return view('admin.layout.individual_list',compact('individuals'));
    }

    public function admin_individual_details($id){
        $individual_info = User::leftJoin('individual_infos','users.id','=','individual_infos.u_id')->Join('otp_verifies','users.phone','=','otp_verifies.mobile')->where('users.id',$id)->first(['users.*','individual_infos.*','otp_verifies.verified_at']);
        // dd($individual_info);
        $i_address = $individual_info->i_street_number." ".$individual_info->i_street_name.", Apartment #".$individual_info->i_apt.",".$individual_info->i_city.",".$individual_info->i_state.",".$individual_info->i_zip.",USA.";
        return view('admin.layout.individual_details',compact('individual_info','i_address'));
    }

    public function admin_i_doc_status($doc_type,$id){
        $getStatus = individual_info::find($id)->$doc_type;
        // dd($doc_type,$id,$getStatus);
        if($getStatus == 0){
            $status = 1;
        }else{
            $status = 0;
        }
        if($status == 1){
            individual_info::where('id',$id)->update([$doc_type=>$status]);
        }else{
            individual_info::where('id',$id)->update([$doc_type=>$status]);
        }
        return back()->with('success','Document Status Updated Successfully');
    }
}
