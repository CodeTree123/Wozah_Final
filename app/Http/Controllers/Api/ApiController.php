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
use App\Models\subcatagory_info;
use App\Models\suborder;
use Mail;

use Validator;
use File;
use Gloudemans\Shoppingcart\Facades\Cart;

class ApiController extends Controller
{

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
        $user = customer_info::where('phone', $request->emailorphone)->where('role_id', 4)->get();
        $user1 = customer_info::where('email', $request->emailorphone)->where('role_id', 4)->get();
        if ($user || $user1) {
            if (Hash::check($request->password, $user->password) || Hash::check($request->password, $user1->password)) {
                $response = [
                    'success' => true,
                    'customer' => $user || $user1,
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

    public function shop_login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 401);
        }
        $shop_user = shop_info::where('email', $request->phone)->first();

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
                    "message" => "Invalid Password."
                ];
                return response($response, 200);
            }
        } else {
            $response = [
                'success' => false,
                "message" => 'Shop does not exist.'
            ];
            return response($response, 200);
        }
    }
    public function customer_profile_update(Request $request, $id)
    {
        $user = User::find($id);
        if ($user->phone != $request->phone) {
            $user->phone = $request->phone;
            $user->update();
        }
        $filename = '';
        if ($request->hasFile('customer_image')) {
            $destination = 'uploads/customer/' . $user->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('customer_image');
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
            'customer' => $customer,
            "message" => 'Customer information have been successfully Updated.'
        ];
        return response($response, 200);
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

    public function shop_profile_update(Request $request, $id)
    {

        $shop = shop_info::where('u_id', $id)->update([
            'b_legal_name' => $request->b_legal_name,
            'b_dba' => $request->b_dba,
            'street_number_b' => $request->street_number_b,
            'street_name_b' => $request->street_name_b,
            'apt_b' => $request->apt_b,
            'city_b' => $request->city_b,
            'state_b' => $request->state_b,
            'zip_b' => $request->zip_b,
            'street_number_c' => $request->street_number_c,
            'street_name_c' => $request->street_name_c,
            'apt_c' => $request->apt_c,
            'city_c' => $request->city_c,
            'state_c' => $request->state_c,
            'zip_c' => $request->zip_c
        ]);
        $response = [
            'success' => true,
            'shop' => $shop,
            "message" => 'Shop information have been successfully Updated.'
        ];
        return response($response, 200);
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

    public function addtocart($id)
    {
        $service = service::Join('subcatagory_infos', 'services.subcatagory_id', '=', 'subcatagory_infos.id')->where('services.id', '=', $id)->first(['services.*', 'subcatagory_infos.subcatagory_name']);
        $cart = Cart::add([
            'id' => $id,
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

    public function place_order(Request $request, $id)
    {
        $carts = Cart::content();

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
    public function myorder($id)
    {
        $orders = order::where('cus_id', $id)->get();
        $response = [
            'success' => true,
            'orders' => $orders
        ];
        return response($response, 200);
    }

    //Documents add
    public function shop_add_documents(Request $request, $id)
    {
        $request->validate([
            'b_ein' => 'required|mimes:pdf',
            'b_certificate' => 'required|mimes:pdf',
            'b_registration' => 'required|mimes:pdf',
            'nail_salon' => 'required|mimes:pdf',
            'e_certificate' => 'required|mimes:pdf',
            'b_insurance' => 'required|mimes:pdf',
            'b_workers' => 'required|mimes:pdf',
            'driver_license' => 'required|mimes:pdf',
        ], [
                'b_ein.required' => 'The Business EIN must be required.',
                'b_certificate.required' => 'The Business Certificate of Authority must be required.',
                'b_registration.required' => 'The Business Registration must be required.',
                'nail_salon.required' => 'The Nail Salon must be required.',
                'e_certificate.required' => 'The Employee Certification must be required.',
                'b_insurance.required' => 'The Business Insurance must be required.',
                'b_workers.required' => 'The Business Workers Comp must be required.',
                'driver_license.required' => 'The Owners Valid Driver’s License must be required.',

                'b_ein.mimes' => 'The Business EIN must be PDF formatted file.',
                'b_certificate.mimes' => 'The Business Certificate of Authority must be PDF formatted file.',
                'b_registration.mimes' => 'The Business Registration must be PDF formatted file.',
                'nail_salon.mimes' => 'The Nail Salon must be PDF formatted file.',
                'e_certificate.mimes' => 'The Employee Certification must be PDF formatted file.',
                'b_insurance.mimes' => 'The Business Insurance must be PDF formatted file.',
                'b_workers.mimes' => 'The Business Workers Comp must be PDF formatted file.',
                'driver_license.mimes' => 'The Owners Valid Driver’s License must be PDF formatted file.',
            ]);
        $b_ein_filename = '';
        if ($request->hasFile('b_ein')) {
            $file = $request->file('b_ein');
            if ($file->isValid()) {
                $b_ein_filename = "b_ein" . date('Ymdhms') . '.' . $file->getClientOriginalExtension();
                $file->storeAs('SP_document', $b_ein_filename);
            }
        }
        $b_certificate_filename = '';
        if ($request->hasFile('b_certificate')) {
            $file = $request->file('b_certificate');
            if ($file->isValid()) {
                $b_certificate_filename = "b_certificate" . date('Ymdhms') . '.' . $file->getClientOriginalExtension();
                $file->storeAs('SP_document', $b_certificate_filename);
            }
        }
        $b_registration_filename = '';
        if ($request->hasFile('b_registration')) {
            $file = $request->file('b_registration');
            if ($file->isValid()) {
                $b_registration_filename = "b_registration" . date('Ymdhms') . '.' . $file->getClientOriginalExtension();
                $file->storeAs('SP_document', $b_registration_filename);
            }
        }
        $nail_salon_filename = '';
        if ($request->hasFile('nail_salon')) {
            $file = $request->file('nail_salon');
            if ($file->isValid()) {
                $nail_salon_filename = "nail_salon" . date('Ymdhms') . '.' . $file->getClientOriginalExtension();
                $file->storeAs('SP_document', $nail_salon_filename);
            }
        }
        $e_certificate_filename = '';
        if ($request->hasFile('e_certificate')) {
            $file = $request->file('e_certificate');
            if ($file->isValid()) {
                $e_certificate_filename = "e_certificate" . date('Ymdhms') . '.' . $file->getClientOriginalExtension();
                $file->storeAs('SP_document', $e_certificate_filename);
            }
        }
        $b_insurance_filename = '';
        if ($request->hasFile('b_insurance')) {
            $file = $request->file('b_insurance');
            if ($file->isValid()) {
                $b_insurance_filename = "b_insurance" . date('Ymdhms') . '.' . $file->getClientOriginalExtension();
                $file->storeAs('SP_document', $b_insurance_filename);
            }
        }
        $b_workers_filename = '';
        if ($request->hasFile('b_workers')) {
            $file = $request->file('b_workers');
            if ($file->isValid()) {
                $b_workers_filename = "b_workers" . date('Ymdhms') . '.' . $file->getClientOriginalExtension();
                $file->storeAs('SP_document', $b_workers_filename);
            }
        }
        $driver_license_filename = '';
        if ($request->hasFile('driver_license')) {
            $file = $request->file('driver_license');
            if ($file->isValid()) {
                $driver_license_filename = "driver_license" . date('Ymdhms') . '.' . $file->getClientOriginalExtension();
                $file->storeAs('SP_document', $driver_license_filename);
            }
        }
        service_provider_doc::where('u_id', $id)->first()->update([
            'doc_add_status' => '1',
            'b_ein' => $b_ein_filename,
            'b_certificate' => $b_certificate_filename,
            'b_registration' => $b_registration_filename,
            'nail_salon' => $nail_salon_filename,
            'e_certificate' => $e_certificate_filename,
            'b_insurance' => $b_insurance_filename,
            'b_workers' => $b_workers_filename,
            'driver_license' => $driver_license_filename,
        ]);
        $response = [
            'success' => true,
            "message" => 'Document Added Successfully.'
        ];
        return response($response, 200);
    }

    public function shop_update_documents(Request $request, $id)
    {
        $doc_name = $request->doctype_name;
        $doc_pdf_name = service_provider_doc::find($id)->$doc_name;
        // dd($request->all(),$doc_name,$id,$doc_pdf_name);

        $filename = $doc_pdf_name;
        if ($request->hasFile('updateformFile')) {
            $destination = 'uploads/SP_document/' . $doc_pdf_name;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('updateformFile');
            if ($file->isValid()) {
                $filename = $doc_name . date('Ymdhms') . '.' . $file->getClientOriginalExtension();
                $file->storeAs('SP_document', $filename);
            }
        }
        service_provider_doc::find($id)->update([
            $doc_name => $filename,
        ]);
        $response = [
            'success' => true,
            "message" => 'Document Updated Successfully.'
        ];
        return response($response, 200);
    }

    public function shop_catagory($id)
    {
        $catagories = catagory_info::where('u_id', $id)->get();
        if ($catagories) {
            $response = [
                'success' => true,
                'shop catagories' => $catagories,
                "message" => 'shop catagories List.'
            ];
            return response($response, 200);
        } else {
            $response = [
                'success' => false,
                "message" => 'shop catagories found.'
            ];
            return response($response, 200);
        }
    }
    public function shop_catagory_add(Request $request)
    {
        $catagory = catagory_info::create([
            'u_id' => $request->u_id,
            'catagory_name' => $request->catagory_name,
            'c_description' => $request->description,
            'c_status' => $request->c_status,
        ]);
        $response = [
            'success' => true,
            'shop catagory' => $catagory,
            "message" => 'Catagory information have been successfully Added.'
        ];
        return response($response, 200);
    }
    public function shop_catagory_update(Request $request, $id)
    {
        $category = catagory_info::find($id);
        if ($category) {
            $category->update([
                'catagory_name' => $request->catagory_name,
                'c_description' => $request->description,
            ]);
            $response = [
                'success' => true,
                'shop catagory' => $category,
                "message" => 'Category information have been successfully Updated.'
            ];
            return response($response, 200);
        } else {
            $response = [
                'success' => false,
                "message" => 'Category does not exist.'
            ];
            return response($response, 200);
        }
    }
    public function shop_catagory_delete($id)
    {
        $del_catagory_info = catagory_info::find($id);
        if ($del_catagory_info) {
            $destination = 'uploads/shop/catagory/' . $del_catagory_info->c_image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $del_catagory_info->delete();
            $response = [
                'success' => true,
                "message" => 'Category Deleted successfully.'
            ];
            return response($response, 200);
        } else {
            $response = [
                'success' => false,
                "message" => 'Category not found.'
            ];
            return response($response, 200);
        }
    }

    public function shop_sub_catagory($id, $cat_id)
    {
        $subcatagories = subcatagory_info::where('u_id', $id)->where('catagory_id', $cat_id)->get();
        if ($subcatagories) {
            $response = [
                'success' => true,
                'sub-Category' => $subcatagories,
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
    public function shop_sub_catagory_add(Request $request)
    {

        $filename = '';
        if ($request->hasFile('sub_catagory_image')) {

            $file = $request->file('sub_catagory_image');
            if ($file->isValid()) {
                $filename = "shopcat" . date('Ymdhms') . '.' . $file->getClientOriginalExtension();
                $file->storeAs('shop/sub_catagory', $filename);
            }
        }
        $subcatagories = subcatagory_info::create([
            'u_id' => $request->u_id,
            'catagory_id' => $request->cat_id,
            'subcatagory_name' => $request->subcatagory_name,
            'sc_description' => $request->description,
            'sc_image' => $filename,
            'sc_status' => $request->sc_status,
        ]);
        $response = [
            'success' => true,
            'sub-Category' => $subcatagories,
            "message" => 'Sub Catagory information have been successfully Added.'

        ];
        return response($response, 200);
    }
    public function shop_sub_catagory_update(Request $request, $id)
    {
        $sc_image = subcatagory_info::find($id);
        if ($sc_image) {
            $filename = $sc_image->sc_image;
            if ($request->hasFile('sub_catagory_image')) {
                $destination = 'uploads/shop/sub_catagory/' . $sc_image->sc_image;
                if (File::exists($destination)) {
                    File::delete($destination);
                }
                $file = $request->file('sub_catagory_image');
                if ($file->isValid()) {
                    $filename = "shopcat" . date('Ymdhms') . '.' . $file->getClientOriginalExtension();
                    $file->storeAs('shop/sub_catagory', $filename);
                }
            }
            // dd($filename);
            $sub_category = subcatagory_info::find($id)->update([
                'catagory_id' => $request->cat_id,
                'subcatagory_name' => $request->subcatagory_name,
                'sc_description' => $request->description,
                'sc_image' => $filename,
            ]);
            $response = [
                'success' => true,
                'sub Category' => $sub_category,
                "message" => 'Sub-Category updated successfully.'
            ];
            return response($response, 200);
        } else {
            $response = [
                'success' => false,
                "message" => 'Sub-Category not found.'
            ];
            return response($response, 200);
        }
    }
    public function shop_sub_catagory_delete($id)
    {
        $del_subcatagory_info = subcatagory_info::find($id);
        if ($del_subcatagory_info) {
            $destination = 'uploads/shop/sub_catagory/' . $del_subcatagory_info->sc_image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $del_subcatagory_info->delete();
            $response = [
                'success' => true,
                "message" => 'Sub-Category Deleted successfully.'
            ];
            return response($response, 200);
        } else {
            $response = [
                'success' => false,
                "message" => 'Sub-Category not found.'
            ];
            return response($response, 200);
        }
    }
    public function shop_service($user_id)
    {
        $services = service::where('u_id', $user_id)->get();
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
    public function shop_service_add(Request $request)
    {
        // dd($request->all());
        $services = service::create([
            'u_id' => $request->u_id,
            'subcatagory_id' => $request->subcat_id,
            'service_name' => $request->service_name,
            's_description' => $request->s_description,
            'price' => $request->price,
            // 'sc_image' => $filename,
            's_status' => $request->s_status,
        ]);
        $response = [
            'success' => true,
            'Services' => $services,
            "message" => 'Service information have been successfully Added.'
        ];
        return response($response, 200);
    }
    public function shop_service_update(Request $request, $id)
    {
        // dd($request->all());
        $services = service::find($id);
        if ($services) {
            $services->update([
                'subcatagory_id' => $request->sub_cat_id,
                'service_name' => $request->u_service_name,
                's_description' => $request->u_s_description,
                'price' => $request->u_price,
            ]);
            $response = [
                'success' => true,
                'Services' => $services,
                "message" => 'Services information have been successfully Updated.'
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
    public function shop_service_delete($id)
    {
        $del_service_info = service::find($id);
        if ($del_service_info) {
            $del_service_info->delete();
            $response = [
                'success' => true,
                "message" => 'Service Deleted successfully.'
            ];
            return response($response, 200);
        } else {
            $response = [
                'success' => false,
                "message" => 'Service not found.'
            ];
            return response($response, 200);
        }
    }
    public function individual_profile($id)
    {
        $individual_info = individual_info::where('u_id', $id)->first();
        $response = [
            'success' => true,
            'individual_info' => $individual_info,
        ];
        return response($response, 200);
    }
    public function individual_profile_update(Request $request, $id)
    {
        $individual_info = individual_info::find($id);
        if ($individual_info) {
            $individual_info->update([
                'i_street_number' => $request->i_street_number,
                'i_street_name' => $request->i_street_name,
                'i_apt' => $request->i_apt,
                'i_city' => $request->i_city,
                'i_state' => $request->i_state,
                'i_zip' => $request->i_zip
            ]);
            $response = [
                'success' => true,
                'individual' => $individual_info,
                "message" => 'individual information Updated successfully.'
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
    public function individul_add_documents(Request $request, $id)
    {
        $individual_info = individual_info::where('u_id', $id)->first();
        if ($individual_info) {
            $validator = Validator::make($request->all(), [
                'i_driver_license' => 'required|mimes:pdf',
            ]);
            if ($validator->fails()) {
                return response(['errors' => $validator->errors()->all()], 401);
            }
            if ($validator) {
                $driver_license_filename = '';
                if ($request->hasFile('i_driver_license')) {
                    $file = $request->file('i_driver_license');
                    if ($file->isValid()) {
                        $i_driver_license_filename = "i_driver_license" . date('Ymdhms') . '.' . $file->getClientOriginalExtension();
                        $file->storeAs('SP_document', $i_driver_license_filename);
                    }
                }
                $individual_info->update([
                    'doc_add_status' => '1',
                    'i_driver_license' => $i_driver_license_filename,
                ]);
                $response = [
                    'success' => true,
                    'individual_doc' => $individual_info,
                    "message" => 'individual Document Added Successfully.'
                ];
                return response($response, 200);
            }
        } else {
            $response = [
                'success' => false,
                "message" => 'individual does not exist.'
            ];
            return response($response, 200);
        }
    }
    public function individual_update_documents(Request $request, $id)
    {
        $doc_name = $request->u_doctype_name;
        $doc_pdf_name = individual_info::find($id)->$doc_name;
        if ($doc_pdf_name) {
            $filename = $doc_pdf_name;
            if ($request->hasFile('updateformFile')) {
                $destination = 'uploads/SP_document/' . $doc_pdf_name;
                if (File::exists($destination)) {
                    File::delete($destination);
                }
                $file = $request->file('updateformFile');
                if ($file->isValid()) {
                    $filename = $doc_name . date('Ymdhms') . '.' . $file->getClientOriginalExtension();
                    $file->storeAs('SP_document', $filename);
                }
            }
            $individual_info = individual_info::find($id)->update([
                $doc_name => $filename,
            ]);
            $response = [
                'success' => true,
                'individual documents' => $individual_info,
                "message" => 'individual information updated successfully.'
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
}