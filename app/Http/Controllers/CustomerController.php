<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\customer_info;
use App\Models\service;
use App\Models\order;
use App\Models\suborder;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Mail\OrderMailInfo;
use Mail;

use File;


class CustomerController extends Controller
{
    //
    public function profile_update(Request $request){
        // dd($request->all());
        $request->validate([
            'customer_street_name' =>  'required',
            'customer_street_number' =>  'required',
            'customer_apt' =>  'required',
            'customer_city' =>  'required',
            'customer_state' =>  'required',
            'customer_zip' =>  'required',
        ],[
            'customer_street_name.required' => 'Street Name Field is required!' ,
            'customer_street_number.required' => 'Street Number Field is required!' ,
            'customer_apt.required' => 'Apt# Field is required!' ,
            'customer_city.required' => 'City Field is required!' ,
            'customer_state.required' => 'State Field is required!' ,
            'customer_zip.required' => 'Zip Field is required!' ,
        ]);
        $user = User::find($request->id);
        if($user->phone != $request->phone){
            $user->phone = $request->phone;
            $user->update();
        }

        $filename='';
        if($request->hasFile('customer_image'))
        {
            $destination = 'uploads/customer/'.$user->image;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $file= $request->file('customer_image');
            if ($file->isValid()) {
                $filename="customer".date('Ymdhms').'.'.$file->getClientOriginalExtension();
                $file->storeAs('customer',$filename);
            }
            // dd($filename);
        }
        if($filename != null){
            $user->image = $filename;
            $user -> update();
        }
        $customer= customer_info::where('u_id','=',$request->id)->update([
            'cus_add_status' => '1',
            'customer_address' => $request->customer_address,
            'customer_street_name' => $request->customer_street_name,
            'customer_street_number' => $request->customer_street_number,
            'customer_apt' => $request->customer_apt,
            'customer_city' => $request->customer_city,
            'customer_state' => $request->customer_state,
            'customer_zip' => $request->customer_zip,
            'gender' => $request->gender,
        ]);
        return back()->with('success','user information have been successfully Updated.');
    }

    public function payment_update(Request $request){
        // dd($request->all());
        $customer= customer_info::where('u_id','=',$request->id)->update([
            'c_cc' => $request->c_cc,
            'c_card_exp' => $request->c_card_exp,
            'c_cvv' => $request->c_cvv,
            'c_payment_zip' => $request->c_payment_zip,
        ]);
        return back()->with('success','Payment information have been successfully Updated.');
    }

    public function addtocart($id){
        $service=service::Join('subcatagory_infos','services.subcatagory_id','=','subcatagory_infos.id')->where('services.id','=',$id)->first(['services.*','subcatagory_infos.subcatagory_name']);
        $cart=Cart::add([
            'id' => $id,
            'name' => $service->service_name,
            'qty' => 1,
            'price' => $service->price,
            'weight' => 0,
            'options' => ['subcat_name' => $service->subcatagory_name,'sp_id' =>$service->u_id,]
        ]);
        return redirect()->back()->with('suceess','Product Added to the Cart');
    }
    public function updatecart_inc(Request $request){
        // dd();
        $row = Cart::get($request->row_id);
        // dd($request->all(),$row);
        Cart::update($request->row_id, $row->qty+1);
        return back();

    }
    public function updatecart_dec(Request $request){
        // dd();
        $row = Cart::get($request->row_id);
        // dd($request->all(),$row);
        Cart::update($request->row_id, $row->qty-1);
        return back();

    }

    public function cartdelete($rowId)
    {
        Cart::remove($rowId);
        return redirect()->back()->with('suceess','product Removed From the Cart');
    }

    public function checkout(){
        $user = User::Join('customer_infos','users.id','customer_infos.u_id')->where('users.id',auth()->id())->first(['users.first_name', 'users.last_name','users.email','customer_infos.*']);
        // dd($user);

        return view('frontend.layout.check_out',compact('user'));
    }

    public function place_order(Request $request){
        $carts=Cart::content();

        $cart_count = Cart::count();
        $subtotal=Cart::SubTotal();
        $total=Cart::Total();
        $address = $request->address.",".$request->customer_street_number.",".$request->customer_street_name.",Apartment #".$request->customer_apt.",".$request->customer_city.",".$request->customer_state." ".$request->customer_zip.","."USA";

        // dd($request->all(),$carts,$cart_count,$subtotal,$total,$address);
        $check_add = customer_info::where('u_id',auth()->id())->first();
        if($check_add->cus_add_status == '0'){
            $check_add->update([
                'cus_add_status' => '1',
                'customer_address' => $request->address,
                'customer_street_name' => $request->customer_street_name,
                'customer_street_number' => $request->customer_street_number,
                'customer_apt' => $request->customer_apt,
                'customer_city' => $request->customer_city,
                'customer_state' => $request->customer_state,
                'customer_zip' => $request->customer_zip,
            ]);
        }

    //    dd($request->all(),$total,$cart_count);

        $order=order::create([
            'cus_id'=>$request->cus_id,    //cus_id => User->id,role=4
            'address'=>$address,
            'total_items'=>$cart_count,
            'total_price'=>$subtotal,
        ]);
    //    dd($order);
        foreach ($carts as $cart) {
            $suborder=suborder::create([
                'order_id'=>$order->id,
                'service_id'=>$cart->id,
                'service_name'=>$cart->name,
                'service_subcat'=>$cart->options->subcat_name,
                'order_quantity'=>$cart->qty,
                'sub_total'=>$cart->subtotal,

            ]);
        }
        // dd($suborder);
        $test = service::find($suborder->service_id);
        $sp_id = $test->u_id;
        // dd($test,$sp_id,$order);

        $order->sp_id = $sp_id;
        $order->update();

        $customer_name = User::where('id',$request->cus_id)->first();
        $order_info = [
            'order_id' => $order->id,
            'carts' => $carts,
            'total' => $subtotal
        ];
        // Mail::to('codetree.developers@gmail.com')->send(new OrderMailInfo($order_info));
        Mail::to($customer_name->email)->send(new OrderMailInfo($order_info));


        Cart::destroy();

        return redirect()->route('content')->with('success','order has been placed');
    }

    public function myorder(){
        $orders = order::where('cus_id',auth()->id())->get();
        return view('frontend.layout.my_order_list',compact('orders'));
    }

}
