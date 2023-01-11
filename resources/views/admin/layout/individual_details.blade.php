@extends('admin.admin_master')
@section('content')
    @if($individual_info->user_status == '0')
    <!-- Shop Document Information Tab -->
    <div class="mt-2" id="s_verify_info_section">
        <div>
            <h5>Unverified Shop Information</h5>
            <div class="d-flex justify-content-between">
                <p>Name: {{$individual_info->first_name}} {{$individual_info->last_name}}</p>
            </div>
            <p>Address: {{$i_address}}</p>
            @if($individual_info->user_status == '0')
            <p>Wozah Verification Status: <span class="text-danger">Not Verified</span></p>
            @endif
        </div>

        <div class="mt-3">
            <!--Shop Contact Information Table -->
            <table class="table ">
                <h5>Individual Contact Information</h5>
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
                        <td>{{ $individual_info->email}}</td>
                        <td>
                            @if($individual_info->email_verified_at != null)
                            <h4> <span class="badge bg-success">Verified</span> </h4>
                            @else
                            <h4> <span class="badge bg-warning">Not Verified</span> </h4>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Phone Number</td>
                        <td>{{ $individual_info->phone}}</td>
                        <td>
                            @if($individual_info->verified_at != 0)
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
                <h5 class="mt-3">Individual Document Information</h5>
                @if($individual_info->i_driver_license_status == '1')
                    <a href="{{route('admin_sp_verification_status',$individual_info->u_id)}}" class="btn btn-primary me-5">Click Here To Verify</a>
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
                        <td>Owners Valid Driver’s License</td>
                        <td>
                            <a href="{{asset('uploads/SP_document/'.$individual_info->i_driver_license)}}" class="btn btn-primary" target="_blank">View</a>
                        </td>
                        <td>
                            @if($individual_info->i_driver_license_status == 0)
                            <a href="{{route('admin_i_doc_status',['i_driver_license_status',$individual_info->id])}}" class="btn btn-warning text-dark">Verification Pending</a>
                            @else
                            <h4> <span class="badge bg-success">Verification Done</span></h4>
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
        <h5>Verified Individual Information</h5>
        <div class="d-flex justify-content-between">
            <p>Name: {{$individual_info->first_name}} {{$individual_info->last_name}}</p>
        </div>
        <p>Address: {{$i_address}}</p>
    </div>
    @endif
    
@endsection
