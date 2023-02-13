<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\AddEmpConfirmMail;
use App\Mail\InviteMail;
use App\Mail\OrderCancelMail;
use App\Mail\OrderMailConfirm;
use App\Mail\OrderMailInfoEmp;
use App\Models\customer_info;
use App\Models\employee_info;
use App\Models\individual_info;
use App\Models\service;
use App\Models\service_provider_doc;
use App\Models\shop_info;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Mail\OrderMailInfo;
use App\Models\catagory_info;
use App\Models\order;
use App\Models\work_hour;
use App\Models\otp_verify;
use App\Models\subcatagory_info;
use App\Models\suborder;
use Twilio\Rest\Client;
use Exception;
use Validator;
use Mail;
use File;
use Gloudemans\Shoppingcart\Facades\Cart;

class ApiController extends Controller
{
    function send_sms($phone, $otp)
    {


        $receiverNumber = $phone;
        $message = "Your Wozah OTP is" . $otp;

        try {

            $account_sid = getenv("TWILIO_SID");
            $auth_token = getenv("TWILIO_TOKEN");
            $twilio_number = getenv("TWILIO_FROM");

            $client = new Client($account_sid, $auth_token);
            $client->messages->create($receiverNumber, [
                'from' => $twilio_number,
                'body' => $message]);

        } catch (Exception $e) {
            dd("Error: ". $e->getMessage());
        }
        // $url = "http://202.164.208.226/smsapi";
        // $data = [
        //     "api_key" => "C20013386235902a575991.44900461",
        //     "type" => "text",
        //     "contacts" => "88" . $phone,
        //     "senderid" => "8809612442105",
        //     "msg" => "Your ToletX verification code " . $otp,
        // ];
        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_POST, 1);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // $response = curl_exec($ch);
        // curl_close($ch);
        // return $response;
    }

    //end sms api

    public function sendOtp(Request $request)
    {

        $otp = rand(1000, 9999);
        $response = $this->send_sms($request->mobile, $otp);
        $phone = otp_verify::where('mobile', '=', $request->mobile)->first();
        // dd($phone);
        if ($phone == null) {
            $user = otp_verify::create([
                'mobile' => $request->mobile,
                'otp' => $otp
            ]);
            $success['token'] = $user->createToken('MyApp')->accessToken;
            $success['mobile'] = $user->mobile;
            $response = [
                'success' => true,
                "message" => 'Otp send successfully.'
            ];
            return response($response, 200);
        } else {
            $phone->update([
                'otp' => $otp
            ]);
            $success['token'] = $phone->createToken('MyApp')->accessToken;
            $success['mobile'] = $phone->mobile;
            $response = [
                'success' => true,
                "message" => 'Otp send successfully.'
            ];
            return response($response, 200);
        }
    }

    /**
     * Otp match api
     *
     */

    public function loginWithOtp(Request $request)
    {


        $phoneinfo = otp_verify::where('mobile', $request->mobile)->first();


        if ($phoneinfo && $phoneinfo->otp == $request->otp) {
            $phoneinfo->update([
                'otp' => '',
                'verified_at' => 1
            ]);
            $success['token'] = $phoneinfo->createToken('MyApp')->accessToken;
            $success['verified_at'] = $phoneinfo->verified_at;
            $response = [
                'success' => true,
                "message" => 'Successfully Login.'
            ];
            return response($response, 200);
        } else {
            $response = [
                'success' => false,
                "message" => "Unauthorized."
            ];
            return response($response, 200);
        }
    }

    public function new_register(Request $request)
    {
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'shop_name' => $request->shop_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role_id' => $request->role_id,
            'password' => Hash::make($request['password']),
            'created_at' => Carbon::now()
        ]);
        if ($request->role_id == 4) {
            $customer_u_id = User::where('email', '=', $request->email)->where('role_id', '=', '4')->first()->id;
            customer_info::create([
                'u_id' => $customer_u_id,
                'created_at' => Carbon::now()
            ]);
        }
        if ($request->role_id == 2) {
            $shop_u_id = User::where('email', '=', $request->email)->where('role_id', '=', '2')->first()->id;
            shop_info::create([
                'u_id' => $shop_u_id,
                'created_at' => Carbon::now()
            ]);
            service_provider_doc::create([
                'u_id' => $shop_u_id
            ]);
        }
        if ($request->role_id == 3) {
            $shop_u_id = User::where('email', '=', $request->email)->where('role_id', '=', '3')->first()->id;
            // dd($shop_u_id);
            individual_info::create([
                'u_id' => $shop_u_id,
                'created_at' => Carbon::now()
            ]);
        }
        if ($user) {
            event(new Registered($user));
            $response = [
                'success' => true,
                'user' => $user,
                "message" => 'Successfully Registered.'
            ];
            return response($response, 200);
        } else {
            $response = [
                'success' => false,
                "message" => "Please Check Your Information Properly."
            ];
            return response($response, 200);
        }
    }


    public function customer_login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'emailorphone' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 401);
        }
        $user = User::where('email', $request->emailorphone)->OrWhere('phone', $request->emailorphone)->where('role_id', 4)->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $response = [
                    'success' => true,
                    'user' => $user,
                    "message" => 'successfully Log in.'
                ];
                return response($response, 200);
            } else {
                $response = [
                    'success' => false,
                    "message" => "Invalid Password."
                ];
                return response($response, 200);
            }
        } else {
            $response = [
                'success' => false,
                "message" => 'User does not exist.'
            ];
            return response($response, 200);
        }
    }


    public function customer_Profile($id)
    {
        $user = User::rightJoin('customer_infos', 'users.id', '=', 'customer_infos.u_id')->where('users.id', $id)->first(['users.*', 'customer_infos.*']);
        $response = [
            'success' => true,
            'user' => $user,
            "message" => 'User does not exist.'
        ];
        return response($response, 200);
    }

    public function shop_login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 401);
        }
        $shop_user = User::where('email', $request->email)->where('role_id', '!=', 1)->where('role_id', '!=', 4)->first();

        if ($shop_user) {
            if (Hash::check($request->password, $shop_user->password)) {
                $token['token'] = $shop_user->createToken('MyApp')->plainTextToken;
                $response = [
                    'success' => true,
                    'shop' => $shop_user,
                    "message" => 'successfully Log in.'
                ];
                return response($response, 200);
            } else {
                $response = [
                    'success' => false,
                    "message" => "Incorrect Password."
                ];
                return response($response, 200);
            }
        } else {
            $response = [
                'success' => false,
                "message" => 'Invalid User.'
            ];
            return response($response, 200);
        }
    }

    public function customer_profile_update(Request $request, $id)
    {
        $user = User::find($id);
        if($user)
        {
            $validator = Validator::make($request->all(), [
                'customer_street_name' =>  'required',
                'customer_street_number' =>  'required',
                'customer_apt' =>  'required',
                'customer_city' =>  'required',
                'customer_state' =>  'required',
                'customer_zip' =>  'required',
            ]);
            if ($validator->fails()) {
                return response(['errors' => $validator->errors()->all()], 401);
            }
            if ($user->phone != $request->phone) {
                $user->phone = $request->phone;
                $user->update();
            }
            $filename = '';
            if ($request->hasFile('image')) {
                $destination = 'uploads/customer/' . $user->image;
                if (File::exists($destination)) {
                    File::delete($destination);
                }
                $file = $request->file('image');
                if ($file->isValid()) {
                    $filename = "customer" . date('Ymdhms') . '.' . $file->getClientOriginalExtension();
                    $file->storeAs('customer', $filename);
                }
            }
            if ($filename != null) {
                $user->image = $filename;
                $user->update();
            }
            $customer = customer_info::where('u_id', '=', $id)->update([
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
            $response = [
                'success' => true,
                'customer' => $user,
                "message" => 'Customer information have been successfully Updated.'
            ];
            return response($response, 200);
        }else{
            $response = [
                'success' => false,
                "message" => 'Customer not found.'
            ];
            return response($response, 200);
        }

        
    }

    // Service provider Profile
    public function shop_profile($id)
    {
        $sp_info = shop_info::where('u_id', $id)->first();

        if ($sp_info) {
            $business_address = $sp_info->street_number_b . " " . $sp_info->street_name_b . ", Apartment #" . $sp_info->apt_b . "," . $sp_info->city_b . "," . $sp_info->state_b . "," . $sp_info->zip_b . ",USA.";
            $corporate_address = $sp_info->street_number_c . " " . $sp_info->street_name_c . ", Apartment #" . $sp_info->apt_c . "," . $sp_info->city_c . "," . $sp_info->state_c . "," . $sp_info->zip_c . ",USA.";
            $response = [
                'success' => true,
                'shop' => $sp_info,
                'business_address' => $business_address,
                'corporate_address' => $corporate_address,
                "message" => 'shop profile information.'
            ];
            return response($response, 200);
        } else {
            $response = [
                'success' => false,
                "message" => 'shop does not exist.'
            ];
            return response($response, 200);
        }
    }

    // Service Provider Documents
    public function shop_documents($id)
    {
        $sp_doc = service_provider_doc::where('u_id', $id)->first();
        if ($sp_doc) {
            $response = [
                'success' => true,
                'shop Documents' => $sp_doc,
            ];
            return response($response, 200);
        } else {
            $response = [
                'success' => false,
                "message" => 'shop does not exist.'
            ];
            return response($response, 200);
        }
    }

    public function addtocart(Request $request,$rowId)
    {
        $service = service::Join('subcatagory_infos', 'services.subcatagory_id', '=', 'subcatagory_infos.id')->where('services.id', '=', $rowId)->first(['services.*', 'subcatagory_infos.subcatagory_name']);
        $cart = Cart::add([
            'id' => $rowId,
            'name' => $service->service_name,
            'qty' => 1,
            'price' => $service->price,
            'weight' => 0,
            'options' => [
                'subcat_name' => $service->subcatagory_name,
                'sp_id' => $service->u_id,
            ]
        ]);

        $response = [
            'success' => true,
            'add to cart services' => $cart,
            "message" => 'Product Added to the Cart.'
        ];
        return response($response, 200);
    }

    public function cartdelete($rowId)
    {
        Cart::remove($rowId);
        $response = [
            'success' => true,
            "message" => 'product Removed From the Cart.'
        ];
        return response($response, 200);
    }

    public function cartcontent()
    {
        $carts = Cart::content();
        $response = [
            'success' => true,
            'Cart content' => $carts
        ];
        return response($response, 200);
    }

    public function place_order(Request $request, $id)
    {
        $carts = Cart::content();
        //dd($carts);
        $cart_count = Cart::count();
        $subtotal = Cart::SubTotal();
        $total = Cart::Total();
        $address = $request->address . "," . $request->customer_street_number . "," . $request->customer_street_name . ",Apartment #" . $request->customer_apt . "," . $request->customer_city . "," . $request->customer_state . " " . $request->customer_zip . "," . "USA";

        $check_add = customer_info::where('u_id', $id)->first();
        if ($check_add->cus_add_status == '0') {
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
        // dd($request->all(),$carts,$cart_count,$subtotal,$total,$address);

        //    dd($request->all(),$total,$cart_count);

        $order = order::create([
            'cus_id' => $request->cus_id,
            //cus_id => User->id,role=4
            'address' => $address,
            'total_items' => $cart_count,
            'total_price' => $subtotal,
        ]);
        //        dd($order);
        foreach ($carts as $cart) {
            $suborder = suborder::create([
                'order_id' => $order->id,
                'service_id' => $cart->id,
                'service_name' => $cart->name,
                'service_subcat' => $cart->options->subcat_name,
                'order_quantity' => $cart->qty,
                'sub_total' => $cart->subtotal,

            ]);
        }
        // dd($suborder);
        $test = service::find($suborder->service_id);
        $sp_id = $test->u_id;

        $order->sp_id = $sp_id;
        $order->update();

        $customer_name = User::where('id', $request->cus_id)->first();
        $order_info = [
            'order_id' => $order->id,
            'carts' => $carts,
            'total' => $subtotal
        ];
        // Mail::to('codetree.developers@gmail.com')->send(new OrderMailInfo($order_info));
        Mail::to($customer_name->email)->send(new OrderMailInfo($order_info));


        Cart::destroy();

        $response = [
            'success' => true,
            "message" => 'order has been placed.'
        ];
        return response($response, 200);
    }
    public function order_list($id)
    {
        $order = order::where('cus_id', $id)->get();
        if ($order) {
            $response = [
                'success' => true,
                'orders' => $order,
            ];
            return response($response, 200);
        }
    }
    public function myorder($id)
    {
        $order = order::find($id);
        if ($order) {
            $suborders = suborder::where('order_id', $order->id)->get();
            $response = [
                'success' => true,
                'orders' => $order,
                'Sub orders' => $suborders,
            ];
            return response($response, 200);
        } else {
            $response = [
                'success' => false,
                'message' => 'Order does not exist'
            ];
            return response($response, 200);
        }
    }

   
    public function shop_catagory($user_id)
    {
        $catagory = catagory_info::where('u_id', $user_id)->get();
            
            if ($catagory) {
                $response = [
                    'success' => true,
                    'shop_catagory' => $catagory,
                    "message" => 'catagories List.' 
                ];
                return response($response, 200);
            } else {
                $response = [
                    'success' => false,
                    "message" => 'No category found.'
                ];
                return response($response, 200);
            }
        
    }
    public function shop_single_catagory($user_id,$category_id)
    {
            $sub_categories = subcatagory_info::where('u_id', $user_id)->where('catagory_id',$category_id)->get();
            if ($sub_categories) {
                $response = [
                    'success' => true,
                    'shop_sub_catagory' =>$sub_categories,
                    "message" => 'Sub_catagories List.'
                ];
                return response($response, 200);
            } else {
                $response = [
                    'success' => false,
                    "message" => 'No sub category found.'
                ];
                return response($response, 200);
            }
        
    }

    public function shop_sub_catagory($user_id,$sub_category_id)
    {
        $services = service::where('u_id', $user_id)->where('subcatagory_id', $sub_category_id)->get();
        // dd($services);
        if ($services) {
            $response = [
                'success' => true,
                'services' => $services,
                "message" => 'sub-Category service list.'

            ];
            return response($response, 200);
        } else {
            $response = [
                'success' => false,
                "message" => 'sub-Category not found.'
            ];
            return response($response, 200);
        }
    }

    public function shop_service($user_id)
    {
        // $services = service::where('u_id', $user_id)->get();
        $services =   catagory_info::rightJoin('subcatagory_infos', 'catagory_infos.u_id', '=', 'subcatagory_infos.u_id')->where('catagory_infos.u_id', $user_id)->get(['catagory_infos.*'],[ 'subcatagory_infos.*']);
        if ($services) {
            $response = [
                'success' => true,
                'Services' => $services,
                "message" => 'Services.'
            ];
            return response($response, 200);
        } else {
            $response = [
                'success' => false,
                "message" => 'No Services found!!!'
            ];
            return response($response, 200);
        }
    }


    public function individual_documents(Request $id)
    {
        $sp_doc = individual_info::where('u_id', $id)->first();
        if ($sp_doc) {
            $response = [
                'success' => true,
                'individual documents' => $sp_doc,
            ];
            return response($response, 200);
        } else {
            $response = [
                'success' => false,
                "message" => 'individual information not found.'
            ];
            return response($response, 200);
        }
    }


    public function sp_employee()
    {
        $employees = User::where('role_id', '3')->where('emp_status', '0')->get();
        // dd($employees);
        $sp_employees = employee_info::Join('users', 'employee_infos.emp_u_id', 'users.id')->where('sp_id', auth()->id())->get(['employee_infos.*', 'users.first_name', 'users.last_name', 'users.email', 'users.phone']);
        // dd($sp_employees);
        $response = [
            'success' => true,
            'employees' => $employees,
        ];
        return response($response, 200);
    }

    public function autocomplete_emp(Request $request)
    {
        $data = User::where('email', 'LIKE', '%' . $request->name . '%')->where('role_id', '3')->where('emp_status', '0')->get('email');

        return response()->json([
            'status' => 200,
            'email' => $data,
        ]);
    }

    public function sp_employee_add(Request $request, $email)
    {
        $date = Carbon::today();
        //         dd($request->all(),$date);
        $user_info = User::where('email', $email)->first();
        employee_info::create([
            'sp_id' => $request->u_id,
            'emp_u_id' => $user_info->id,
            'join_date' => $date,
        ]);
        $user_info->emp_status = '1';
        $user_info->update();

        // Mail::to('codetree.developers@gmail.com')->send(new AddEmpConfirmMail());
        Mail::to($user_info->email)->send(new AddEmpConfirmMail());
        $response = [
            'success' => true,
            'employee' => $user_info,
            "message" => 'Employee have been successfully Added.'
        ];
        return response($response, 200);
    }

    public function sp_employee_invite(Request $request, $id)
    {
        $shop_name = User::where('id', $id)->first()->shop_name;
        $invite_info = [
            'shop_name' => $shop_name,
            'invite_email' => $request->invite_email,
            'invite_name' => $request->invite_name,
        ];
        Mail::to($request->invite_email)->send(new InviteMail($invite_info));
        $response = [
            'success' => true,
            "message" => 'Employee have been successfully Added.'
        ];
        return response($response, 200);
    }

    public function sp_order_view($id)
    {
        $order_info = suborder::where('order_id', $id)->get();
        $subtotal = $order_info->sum('sub_total');

        return response([
            'order_info' => $order_info,
            'subtotal' => $subtotal,
        ]);
    }

    public function sp_cancel_order(Request $request, $id)
    {
        // dd($request->all());
        $order_info = order::find($id);
        $customer = User::find($order_info->cus_id);
        $order_info->update([
            'order_status' => '3',
        ]);

        Mail::to($customer->email)->send(new OrderCancelMail());
        $response = [
            'success' => true,
            "message" => 'Order canceled successfully.'
        ];
        return response($response, 200);
    }

    public function sp_confirm_order(Request $request, $id)
    {

        $order_info = order::find($id);
        $customer = User::find($order_info->cus_id);
        $order_info->update([
            'order_status' => '1',
            // 1 = order accept
            'assign_emp_id' => $request->employee_for_order,
        ]);

        employee_info::find($request->employee_for_order)->update([
            'work_status' => '1',
        ]);

        $emp = employee_info::find($request->employee_for_order);
        $employee = User::find($emp->emp_u_id);

        Mail::to($customer->email)->send(new OrderMailConfirm());
        Mail::to($employee->email)->send(new OrderMailInfoEmp());
        $response = [
            'success' => true,
            "message" => 'Order confirmed successfully.'
        ];
        return response($response, 200);
    }

    public function sp_assigned_info($id)
    {
        $emp_info = employee_info::Join('users', 'employee_infos.emp_u_id', 'users.id')->where('employee_infos.id', $id)->first(['users.first_name', 'users.last_name', 'users.email', 'users.phone']);
        $response = [
            'success' => true,
            'emp_info' => $emp_info
        ];
        return response($response, 200);
    }

    public function sp_employee_assigned_work($id)
    {
        $emp_id = employee_info::where('emp_u_id', $id)->first()->id;
        $orders = order::Join('users', 'orders.cus_id', 'users.id')->where('orders.assign_emp_id', $emp_id)->get(['orders.*', 'users.first_name', 'users.last_name', 'users.email', 'users.phone']);
        $response = [
            'success' => true,
            "message" => 'Assigned work confirmed successfully.'
        ];
        return response($response, 200);
    }

    public function single_shop_details($id)
    {
        $shop_details = User::rightJoin('shop_infos', 'users.id', '=', 'shop_infos.u_id')->where('users.id', $id)->get(['users.*', 'shop_infos.*']);
        $work_hour = work_hour::where('u_id', $id)->get();
        $shop = [
            'shop' => $shop_details,
            'available_time' => $work_hour,
        ];
        $response = [
            'success' => true,
            'shop' => $shop,
        ];
        return response($response, 200);
    }

    public function User_list()
    {
        $sp = User::where('role_id', '!=', 1)->where('role_id', '!=', 4)->get();
        $response = [
            'success' => true,
            'service_Provider' => $sp,
        ];
        return response($response, 200);
    }
}
