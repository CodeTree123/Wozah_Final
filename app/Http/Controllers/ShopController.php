<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\shop_info;
use App\Models\service_provider_doc;
use App\Models\individual_info;
use App\Models\catagory_info;
use App\Models\subcatagory_info;
use App\Models\service;
use App\Models\employee_info;
use App\Models\order;
use App\Models\suborder;
use File;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Mail;
use App\Mail\OrderCancelMail;
use App\Mail\OrderMailConfirm;
use App\Mail\OrderMailInfoEmp;
use App\Mail\InviteMail;
use App\Mail\AddEmpConfirmMail;
use App\Models\work_hour;

class ShopController extends Controller
{
    //
    public function service_provider_index(){
        if(Auth::user()->role_id == '2'){
            $sp_doc = service_provider_doc::where('u_id',auth()->id())->first();
        }else{
            $sp_doc = individual_info::where('u_id',auth()->id())->first();
        }
        return view('shop_admin.layout.shop_index',compact('sp_doc'));
    }
// Service provider Profile
    public function shop_profile(){
        $sp_info = shop_info::where('u_id','=',auth()->id())->first();
        // dd($sp_info);
        $business_address = $sp_info->street_number_b." ".$sp_info->street_name_b.", Apartment #".$sp_info->apt_b.",".$sp_info->city_b.",".$sp_info->state_b.",".$sp_info->zip_b.",USA.";
        $corporate_address = $sp_info->street_number_c." ".$sp_info->street_name_c.", Apartment #".$sp_info->apt_c.",".$sp_info->city_c.",".$sp_info->state_c.",".$sp_info->zip_c.",USA.";
        return view('shop_admin.layout.profile.shop_profile',compact('sp_info','business_address','corporate_address'));
    }
// Service Provider Documents
    public function shop_documents(){
        $sp_doc = service_provider_doc::where('u_id',auth()->id())->first();
        return view('shop_admin.layout.profile.shop_doc',compact('sp_doc'));
    }
//shop Profile Update
    public function shop_edit_profile(Request $request){
        // dd($request->all());
        $s_image = User::find($request->s_id);
        $filename=$s_image->image;
        if($request->hasFile('image'))
        {
            $destination = 'uploads/shop/profile/'.$s_image->image;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $file= $request->file('image');
            if ($file->isValid()) {
                $filename="shop".date('Ymdhms').'.'.$file->getClientOriginalExtension();
                $file->storeAs('shop/profile',$filename);
            }
        }
        // dd($filename);
        User::find($request->s_id)->update([
            'image' => $filename,
        ]);


        $shop= shop_info::where('u_id','=',$request->s_id)->update([
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

        return back()->with('success','Shop information have been successfully Updated.');

    }
//Documents add
    public function shop_add_documents(Request $request){
        $request->validate([
            'b_ein'=> 'required|mimes:pdf',
            'b_certificate'=> 'required|mimes:pdf',
            'b_registration'=> 'required|mimes:pdf',
            'nail_salon'=> 'required|mimes:pdf',
            'e_certificate'=> 'required|mimes:pdf',
            'b_insurance'=> 'required|mimes:pdf',
            'b_workers'=> 'required|mimes:pdf',
            'driver_license'=> 'required|mimes:pdf',
        ],[
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
        if($request->hasFile('b_ein'))
        {
            $file= $request->file('b_ein');
            if ($file->isValid()) {
                $b_ein_filename="b_ein".date('Ymdhms').'.'.$file->getClientOriginalExtension();
                $file->storeAs('SP_document',$b_ein_filename);
            }
        }
        $b_certificate_filename = '';
        if($request->hasFile('b_certificate'))
        {
            $file= $request->file('b_certificate');
            if ($file->isValid()) {
                $b_certificate_filename="b_certificate".date('Ymdhms').'.'.$file->getClientOriginalExtension();
                $file->storeAs('SP_document',$b_certificate_filename);
            }
        }
        $b_registration_filename = '';
        if($request->hasFile('b_registration'))
        {
            $file= $request->file('b_registration');
            if ($file->isValid()) {
                $b_registration_filename="b_registration".date('Ymdhms').'.'.$file->getClientOriginalExtension();
                $file->storeAs('SP_document',$b_registration_filename);
            }
        }
        $nail_salon_filename = '';
        if($request->hasFile('nail_salon'))
        {
            $file= $request->file('nail_salon');
            if ($file->isValid()) {
                $nail_salon_filename="nail_salon".date('Ymdhms').'.'.$file->getClientOriginalExtension();
                $file->storeAs('SP_document',$nail_salon_filename);
            }
        }
        $e_certificate_filename = '';
        if($request->hasFile('e_certificate'))
        {
            $file= $request->file('e_certificate');
            if ($file->isValid()) {
                $e_certificate_filename="e_certificate".date('Ymdhms').'.'.$file->getClientOriginalExtension();
                $file->storeAs('SP_document',$e_certificate_filename);
            }
        }
        $b_insurance_filename = '';
        if($request->hasFile('b_insurance'))
        {
            $file= $request->file('b_insurance');
            if ($file->isValid()) {
                $b_insurance_filename="b_insurance".date('Ymdhms').'.'.$file->getClientOriginalExtension();
                $file->storeAs('SP_document',$b_insurance_filename);
            }
        }
        $b_workers_filename = '';
        if($request->hasFile('b_workers'))
        {
            $file= $request->file('b_workers');
            if ($file->isValid()) {
                $b_workers_filename="b_workers".date('Ymdhms').'.'.$file->getClientOriginalExtension();
                $file->storeAs('SP_document',$b_workers_filename);
            }
        }
        $driver_license_filename = '';
        if($request->hasFile('driver_license'))
        {
            $file= $request->file('driver_license');
            if ($file->isValid()) {
                $driver_license_filename="driver_license".date('Ymdhms').'.'.$file->getClientOriginalExtension();
                $file->storeAs('SP_document',$driver_license_filename);
            }
        }
        service_provider_doc::where('u_id',$request->user_id)->first()->update([
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
        return back()->with('success','Document Added Successfully');
    }

    public function shop_update_documents(Request $request){
        $id = $request->u_doc_id;
        $doc_name = $request->u_doctype_name;
        $doc_pdf_name = service_provider_doc::find($id)->$doc_name;
        // dd($request->all(),$doc_name,$id,$doc_pdf_name);

        $filename=$doc_pdf_name;
        if($request->hasFile('updateformFile'))
        {
            $destination = 'uploads/SP_document/'.$doc_pdf_name;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $file= $request->file('updateformFile');
            if ($file->isValid()) {
                $filename=$doc_name.date('Ymdhms').'.'.$file->getClientOriginalExtension();
                $file->storeAs('SP_document',$filename);
            }
        }
        service_provider_doc::find($id)->update([
            $doc_name => $filename,
        ]);
        return back()->with('success','Document Updated Successfully');
    }


// Individual Profile
    public function individual_profile(){
        $individual_info = individual_info::where('u_id','=',auth()->id())->first();
        $i_address = $individual_info->i_street_number." ".$individual_info->i_street_name.", Apartment #".$individual_info->i_apt.",".$individual_info->i_city.",".$individual_info->i_state.",".$individual_info->i_zip.",USA.";
        // dd($sp_info);
        return view('shop_admin.layout.profile.individual_profile',compact('individual_info','i_address'));
    }

    public function individual_profile_update(Request $request){
        $individual_info = individual_info::find($request->i_id);
        // dd($request->all(),$individual_info);
        $individual_info->update([
            'i_street_number' => $request->i_street_number,
            'i_street_name' => $request->i_street_name,
            'i_apt' => $request->i_apt,
            'i_city' => $request->i_city,
            'i_state'=> $request->i_state,
            'i_zip' => $request->i_zip
        ]);
        return back()->with('success','Profile information have been successfully Updated.');
    }

    public function individual_documents(){
        $sp_doc = individual_info::where('u_id',auth()->id())->first();
        return view('shop_admin.layout.profile.individual_doc',compact('sp_doc'));
    }

    public function individul_add_documents(Request $request){
        $request->validate([
            'i_driver_license'=> 'required|mimes:pdf',
        ],[
            'i_driver_license.required' => 'The Driver’s License must be required.',

            'i_driver_license.mimes' => 'The Driver’s License must be PDF formatted file.',
        ]);

        $driver_license_filename = '';
        if($request->hasFile('i_driver_license'))
        {
            $file= $request->file('i_driver_license');
            if ($file->isValid()) {
                $i_driver_license_filename="i_driver_license".date('Ymdhms').'.'.$file->getClientOriginalExtension();
                $file->storeAs('SP_document',$i_driver_license_filename);
            }
        }
        individual_info::where('u_id',$request->user_id)->first()->update([
            'doc_add_status' => '1',
            'i_driver_license' => $i_driver_license_filename,
        ]);
        return back()->with('success','Document Added Successfully');
    }

    public function individual_update_documents(Request $request){
        $id = $request->u_doc_id;
        $doc_name = $request->u_doctype_name;
        $doc_pdf_name = individual_info::find($id)->$doc_name;
        // dd($request->all(),$doc_name,$id,$doc_pdf_name);

        $filename=$doc_pdf_name;
        if($request->hasFile('updateformFile'))
        {
            $destination = 'uploads/SP_document/'.$doc_pdf_name;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $file= $request->file('updateformFile');
            if ($file->isValid()) {
                $filename=$doc_name.date('Ymdhms').'.'.$file->getClientOriginalExtension();
                $file->storeAs('SP_document',$filename);
            }
        }
        individual_info::find($id)->update([
            $doc_name => $filename,
        ]);
        return back()->with('success','Document Updated Successfully');
    }

// Catagory
    public function shop_catagory(){
            $catagories = catagory_info::where('u_id','=',auth()->id())->get();
        return view('shop_admin.layout.catagory',compact('catagories'));
    }

    public function shop_catagory_add(Request $request){
        catagory_info::create([
            'u_id' => $request->u_id,
            'catagory_name' => $request->catagory_name,
            'c_description' => $request->description,
            'c_status' => $request->c_status,
        ]);

        return back()->with('success','Catagory information have been successfully Added.');
    }

    public function shop_catagory_edit($id){
        $catagory = catagory_info::find($id);
        return response()->json([
            'status'=>200,
            'cat' => $catagory,
        ]);

    }

    public function shop_catagory_update(Request $request){

        catagory_info::find($request->sp_catagory_id)->update([
            'catagory_name' => $request->catagory_name,
            'c_description' => $request->description,
        ]);

        return back()->with('success','Catagory information have been successfully Updated.');
    }

    public function shop_catagory_delete(Request $request){

        $del_catagory_id = $request->deletingId;
        $del_catagory_info = catagory_info::find($del_catagory_id);

        $destination = 'uploads/shop/catagory/'.$del_catagory_info->c_image;
        if(File::exists($destination)){
            File::delete($destination);
        }
        $del_catagory_info->delete();

        return back()->with('success','Catagory information have been successfully Deleted.');
    }

//Sub Catagory
    public function shop_sub_catagory(){
        $catagories = catagory_info::where('u_id','=',auth()->id())->get();
        $subcatagories = subcatagory_info::where('subcatagory_infos.u_id','=',auth()->id())->Join('catagory_infos','subcatagory_infos.catagory_id','=','catagory_infos.id')->get(['subcatagory_infos.*','catagory_infos.catagory_name']);
        return view('shop_admin.layout.sub_catagory',compact('catagories','subcatagories'));
    }

    public function shop_sub_catagory_add(Request $request){
        // dd($request->all());
        $filename='';
        if($request->hasFile('sub_catagory_image'))
        {

            $file= $request->file('sub_catagory_image');
            if ($file->isValid()) {
                $filename="shopcat".date('Ymdhms').'.'.$file->getClientOriginalExtension();
                $file->storeAs('shop/sub_catagory',$filename);
            }
        }
        // dd($filename);
        subcatagory_info::create([
            'u_id' => $request->u_id,
            'catagory_id' => $request->cat_id,
            'subcatagory_name' => $request->subcatagory_name,
            'sc_description' => $request->description,
            'sc_image' => $filename,
            'sc_status' => $request->sc_status,
        ]);

        return back()->with('success','Sub Catagory information have been successfully Added.');
    }

    public function shop_sub_catagory_edit($id){
        $subcatagory = subcatagory_info::find($id);
        return response()->json([
            'status'=>200,
            'subcat' => $subcatagory,
        ]);

    }

    public function shop_sub_catagory_update(Request $request){
        // dd($request->all());
        $sc_image = subcatagory_info::find($request->shop_subcatagory_id);
        $filename=$sc_image->sc_image;
        if($request->hasFile('sub_catagory_image'))
        {
            $destination = 'uploads/shop/sub_catagory/'.$sc_image->sc_image;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $file= $request->file('sub_catagory_image');
            if ($file->isValid()) {
                $filename="shopcat".date('Ymdhms').'.'.$file->getClientOriginalExtension();
                $file->storeAs('shop/sub_catagory',$filename);
            }
        }
        // dd($filename);
        subcatagory_info::find($request->shop_subcatagory_id)->update([
            'catagory_id' => $request->cat_id,
            'subcatagory_name' => $request->subcatagory_name,
            'sc_description' => $request->description,
            'sc_image' => $filename,
        ]);

        return back()->with('success','Sub Catagory information have been successfully Updated.');
    }


    public function shop_sub_catagory_delete(Request $request){

        $del_subcatagory_id = $request->deletingId;
        $del_subcatagory_info = subcatagory_info::find($del_subcatagory_id);

        $destination = 'uploads/shop/sub_catagory/'.$del_subcatagory_info->sc_image;
        if(File::exists($destination)){
            File::delete($destination);
        }
        $del_subcatagory_info->delete();

        return back()->with('success','Sub Catagory information have been successfully Deleted.');
    }

//Service
    public function shop_service(){
        $subcatagories = subcatagory_info::where('u_id','=',auth()->id())->get();
        $services = service::where('services.u_id','=',auth()->id())
                            ->Join('subcatagory_infos','services.subcatagory_id','=','subcatagory_infos.id')
                            ->Join('catagory_infos','subcatagory_infos.catagory_id','=','catagory_infos.id')
                            ->get(['services.*','subcatagory_infos.subcatagory_name','catagory_infos.catagory_name']);
        return view('shop_admin.layout.service',compact('subcatagories','services'));
    }

    public function shop_service_add(Request $request){
        // dd($request->all());
        service::create([
            'u_id' => $request->u_id,
            'subcatagory_id' => $request->subcat_id,
            'service_name' => $request->service_name,
            's_description' => $request->s_description,
            'price' => $request->price,
            // 'sc_image' => $filename,
            's_status' => $request->s_status,
        ]);

        return back()->with('success','Service information have been successfully Added.');
    }

    public function shop_service_edit($id){
        $service = service::find($id);
        return response()->json([
            'status'=>200,
            'serv' => $service,
        ]);

    }

    public function shop_service_update(Request $request){
        // dd($request->all());
        service::find($request->shop_service_id)->update([
            'subcatagory_id' => $request->sub_cat_id,
            'service_name' => $request->u_service_name,
            's_description' => $request->u_s_description,
            'price' => $request->u_price,
            // 'sc_image' => $filename,
        ]);

        return back()->with('success','Sub Catagory information have been successfully Updated.');
    }

    public function shop_service_delete(Request $request){

        $del_service_id = $request->deletingId;
        $del_service_info = service::find($del_service_id);
        $del_service_info->delete();

        return back()->with('success','Service information have been successfully Deleted.');
    }

    public function sp_employee(){
        $employees = User::where('role_id','3')->where('emp_status','0')->get();
        // dd($employees);
        $sp_employees = employee_info::Join('users','employee_infos.emp_u_id','users.id')->where('sp_id',auth()->id())->get(['employee_infos.*','users.first_name','users.last_name','users.email','users.phone']);
        // dd($sp_employees);
        return view('shop_admin.layout.employee',compact('employees','sp_employees'));
        return json($employees);
    }

    public function sp_employee_add(Request $request){
        $date = Carbon::today();
//         dd($request->all(),$date);
        $user_info = User::where('email',$request->emp_email)->first();
        employee_info::create([
            'sp_id' => $request->u_id,
            'emp_u_id' => $user_info->id,
            'join_date' => $date,
        ]);
        $user_info->emp_status = '1';
        $user_info->update();

        // Mail::to('codetree.developers@gmail.com')->send(new AddEmpConfirmMail());
        Mail::to($user_info->email)->send(new AddEmpConfirmMail());

        return back()->with('success','Employee have been successfully Added.');
    }

    public function autocomplete_emp(Request $request)
    {
        $data = User::where('email','LIKE','%'.$request->name.'%')->where('role_id','3')->where('emp_status','0')->get('email');

        return response()->json([
            'status' => 200,
            'email' => $data,
        ]);
    }

    public function sp_employee_invite(Request $request){
        $shop_name = User::where('id', $request->shop_id)->first()->shop_name;
        $invite_info = [
            'shop_name' => $shop_name,
            'invite_email' => $request->invite_email,
            'invite_name' => $request->invite_name,
        ];
        // dd($request->all(),$invite_info);
        Mail::to($request->invite_email)->send(new InviteMail($invite_info));
        return back()->with('success','Invitation Sent Successfully');

    }

    public function sp_order(){
        $orders = order::Join('users','orders.cus_id','users.id')->where('orders.sp_id',auth()->id())->get(['orders.*','users.first_name','users.last_name','users.email','users.phone']);
        // dd($orders->all());
        $sp_emps = employee_info::Join('users','employee_infos.emp_u_id','users.id')->where('sp_id',auth()->id())->get(['employee_infos.id','users.first_name','users.last_name']);
        // dd($sp_emps);
        return view('shop_admin.layout.order',compact('orders','sp_emps'));
    }
    public function sp_order_view($id){
        $order_info = suborder::where('order_id',$id)->get();
        // $order_total = order::where('id','=',$id)->first()->total_price;
        $subtotal = $order_info->sum('sub_total');
        // dd($order_info->all(),$order_total,$subtotal);
        return response([
            'order_info' => $order_info,
            'subtotal' => $subtotal,
        ]);
    }

    public function sp_cancel_order(Request $request){
        // dd($request->all());
        $order_info = order::find($request->order_id);
        $customer = User::find($order->cus_id);
        $order_info->update([
            'order_status' => '3',  // 3 = order cancel
        ]);


        // Mail::to('codetree.developers@gmail.com')->send(new OrderCancelMail());
        Mail::to($customer->email)->send(new OrderCancelMail());
        return back()->with('success','Order canceled successfully.');

    }

    public function sp_confirm_order(Request $request){

        $order_info = order::find($request->order_id);
        $customer = User::find($order_info->cus_id);
        $order_info->update([
            'order_status' => '1', // 1 = order accept
            'assign_emp_id' => $request->employee_for_order,
        ]);

        employee_info::find($request->employee_for_order)->update([
            'work_status' => '1',
        ]);

        $emp = employee_info::find($request->employee_for_order);
        $employee = User::find($emp->emp_u_id);

        // Mail::to('codetree.developers@gmail.com')->send(new OrderMailConfirm());
        Mail::to($customer->email)->send(new OrderMailConfirm());
        // Mail::to('codetree.developers@gmail.com')->send(new OrderMailInfoEmp());
        Mail::to($employee->email)->send(new OrderMailInfoEmp());
        return back()->with('success','Order confirmed successfully.');

    }

    public function sp_individual_confirm_order($order_id){
        $order_info = order::find($order_id);
        $customer = User::find($order_info->cus_id);
        $order_info->update([
            'order_status' => '1', // 1 = order accept
        ]);

        User::find($order_info->sp_id)->update([
            'sp_work_status' => '1',
        ]);
        return back()->with('success','Order confirmed successfully.');
    }

    public function sp_assigned_info($id){
        $emp_info = employee_info::Join('users','employee_infos.emp_u_id','users.id')->where('employee_infos.id',$id)->first(['users.first_name','users.last_name','users.email','users.phone']);
        return response([
            'status' => '200',
            'emp_info' => $emp_info
        ]);
    }

//Employee's work information
    public function sp_employee_assigned_work(){
        $emp_id = employee_info::where('emp_u_id',auth()->id())->first()->id;
        $orders = order::Join('users','orders.cus_id','users.id')->where('orders.assign_emp_id',$emp_id)->get(['orders.*','users.first_name','users.last_name','users.email','users.phone']);
        // dd(auth()->id(),$emp_id,$orders);
        return view('shop_admin.layout.employee.emp_work',compact('orders'));
    }

    public function sp_employee_assigned_work_done($order_id){
        order::find($order_id)->update([
            'order_status' => 2
        ]);

        return back()->with('success','Order Completed successfully.');
        // dd($order_id,$t);
    }

    public function shop_work_hour()
    {
      $work_hours = work_hour::where('u_id',Auth::user()->id)->get();
      $day_count = work_hour::where('u_id',Auth::user()->id)->count();
      return view('shop_admin.layout.work_houre',compact('work_hours','day_count'));
    }
    public function shop_work_hour_add(Request $request)
    {
        $request->validate([
            'day_name'=> 'required',
        ]);

     work_hour::create([
        'u_id'=>$request->u_id,
        'day_name'=>$request->day_name,
        'opening_time'=>$request->opening_time,
        'closing_time'=>$request->closing_time,
        'day_off'=>$request->day_off,
     ]);
        return back()->with('massage','Work Hour added Successfully');
    }
}
