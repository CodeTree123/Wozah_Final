@extends('admin.admin_master')
@section('content')
    @if($shop_info->user_status == '0')
    <!-- Shop Document Information Tab -->
    <div class="mt-2" id="s_verify_info_section">
        <div>
            <h5>Unverified Shop Information</h5>
            <div class="d-flex justify-content-between">
                <p>Shop Name: {{$shop_info->shop_name}}</p>
                <p>Business Legal Name: {{$shop_info->b_legal_name}}</p>
                <p>Business DBA: {{$shop_info->b_dba}}</p>
            </div>
            <p>Business Address: {{$business_address}}</p>
            <p>Corporate Address: {{$corporate_address}}</p>
            @if($shop_info->user_status == '0')
            <p>Wozah Verification Status: <span class="text-danger">Not Verified</span></p>
            @endif
        </div>

        <div class="mt-3">
            <!--Shop Contact Information Table -->
            <table class="table ">
                <h5>Shop Contact Information</h5>
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Contact Information Type</th>
                        <th scope="col">Contact Information</th>
                        <th scope="col">Verification Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Email</td>
                        <td>{{ $shop_info->email}}</td>
                        <td>
                            @if($shop_info->email_verified_at != null)
                            <h4> <span class="badge bg-success">Verified</span> </h4>
                            @else
                            <h4> <span class="badge bg-warning">Not Verified</span> </h4>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Phone Number</td>
                        <td>{{ $shop_info->phone}}</td>
                        <td>
                            @if($shop_info->verified_at != 0)
                            <h4> <span class="badge bg-success">Verified</span> </h4>
                            @else
                            <h4> <span class="badge bg-warning">Not Verified</span> </h4>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <!--Shop Contact Information Table End-->

            <!-- Shop Document Information Table -->
            <div class="mt-5 d-flex justify-content-between align-items-center">
                <h5 class="mt-3">Shop Document Information</h5>
                @if($sp_doc->b_ein_status == '1' && $sp_doc->b_certificate_status == '1' && $sp_doc->b_registration_status == '1' && $sp_doc->nail_salon_status == '1' && $sp_doc->e_certificate_status == '1' && $sp_doc->b_insurance_status == '1' && $sp_doc->b_workers_status == '1' && $sp_doc->driver_license_status == '1')
                    <a href="{{route('admin_sp_verification_status',$shop_info->u_id)}}" class="btn btn-primary me-5">Click Here To Verify This Shop</a>
                @endif
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Document Type</th>
                        <th scope="col">Document</th>
                        <th scope="col">Verification Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Business EIN</td>
                        <td>
                            <a href="{{asset('uploads/SP_document/'.$sp_doc->b_ein)}}" class="btn btn-primary" target="_blank">View</a>
                        </td>
                        <td>
                            @if($sp_doc->b_ein_status == 0)
                            <a href="{{route('admin_sp_doc_status',['b_ein_status',$sp_doc->id])}}" class="btn btn-warning text-dark">Verification Pending</a>
                            @else
                            <h4> <span class="badge bg-success text-white">Verification Done</span></h4>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Business Certificate of Authority</td>
                        <td>
                            <a href="{{asset('uploads/SP_document/'.$sp_doc->b_certificate)}}" class="btn btn-primary" target="_blank">View</a>
                        </td>
                        <td>
                            @if($sp_doc->b_certificate_status == 0)
                            <a href="{{route('admin_sp_doc_status',['b_certificate_status',$sp_doc->id])}}" class="btn btn-warning text-dark">Verification Pending</a>
                            @else
                            <h4> <span class="badge bg-success text-white">Verification Done</span></h4>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Business Registration</td>
                        <td>
                           <a href="{{asset('uploads/SP_document/'.$sp_doc->b_registration)}}" class="btn btn-primary" target="_blank">View</a>
                        </td>
                        <td>
                            @if($sp_doc->b_registration_status == 0)
                            <a href="{{route('admin_sp_doc_status',['b_registration_status',$sp_doc->id])}}" class="btn btn-warning text-dark">Verification Pending</a>
                            @else
                            <h4> <span class="badge bg-success text-white">Verification Done</span></h4>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">4</th>
                        <td>Nail Salon – Valid License necessary to Operate and Manage</td>
                        <td>
                            <a href="{{asset('uploads/SP_document/'.$sp_doc->nail_salon)}}" class="btn btn-primary" target="_blank">View</a>
                        </td>
                        <td>
                            @if($sp_doc->nail_salon_status == 0)
                            <a href="{{route('admin_sp_doc_status',['nail_salon_status',$sp_doc->id])}}" class="btn btn-warning text-dark">Verification Pending</a>
                            @else
                            <h4> <span class="badge bg-success text-white">Verification Done</span></h4>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">5</th>
                        <td>Employee Certification</td>
                        <td>
                            <a href="{{asset('uploads/SP_document/'.$sp_doc->e_certificate)}}" class="btn btn-primary" target="_blank">View</a>
                        </td>
                        <td>
                            @if($sp_doc->e_certificate_status == 0)
                            <a href="{{route('admin_sp_doc_status',['e_certificate_status',$sp_doc->id])}}" class="btn btn-warning text-dark">Verification Pending</a>
                            @else
                            <h4> <span class="badge bg-success text-white">Verification Done</span></h4>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">6</th>
                        <td>Business Insurance</td>
                        <td>
                            <a href="{{asset('uploads/SP_document/'.$sp_doc->b_insurance)}}" class="btn btn-primary" target="_blank">View</a>
                        </td>
                        <td>
                            @if($sp_doc->b_insurance_status == 0)
                            <a href="{{route('admin_sp_doc_status',['b_insurance_status',$sp_doc->id])}}" class="btn btn-warning text-dark">Verification Pending</a>
                            @else
                            <h4> <span class="badge bg-success text-white">Verification Done</span></h4>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">7</th>
                        <td>Business Workers Comp</td>
                        <td>
                            <a href="{{asset('uploads/SP_document/'.$sp_doc->b_workers)}}" class="btn btn-primary" target="_blank">View</a>
                        </td>
                        <td>
                            @if($sp_doc->b_workers_status == 0)
                            <a href="{{route('admin_sp_doc_status',['b_workers_status',$sp_doc->id])}}" class="btn btn-warning text-dark">Verification Pending</a>
                            @else
                            <h4> <span class="badge bg-success text-white">Verification Done</span></h4>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">8</th>
                        <td>Owners Valid Driver’s License</td>
                        <td>
                            <a href="{{asset('uploads/SP_document/'.$sp_doc->driver_license)}}" class="btn btn-primary" target="_blank">View</a>
                        </td>
                        <td>
                            @if($sp_doc->driver_license_status == 0)
                            <a href="{{route('admin_sp_doc_status',['driver_license_status',$sp_doc->id])}}" class="btn btn-warning text-dark">Verification Pending</a>
                            @else
                            <h4> <span class="badge bg-success text-white">Verification Done</span></h4>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- Shop Document Information Table End-->
        </div>

        <!--Payment Information  form end-->

    </div>
    <!-- Shop Document Information Tab End-->
    @else
    <div>
        <h5>Verified Shop Information</h5>
        <div class="d-flex justify-content-between">
            <p>Shop Name: {{$shop_info->shop_name}}</p>
            <p>Business Legal Name: {{$shop_info->b_legal_name}}</p>
            <p>Business DBA: {{$shop_info->b_dba}}</p>
        </div>
        <p>Business Address: {{$business_address}}</p>
        <p>Corporate Address: {{$corporate_address}}</p>
    </div>
    @endif
    
@endsection
