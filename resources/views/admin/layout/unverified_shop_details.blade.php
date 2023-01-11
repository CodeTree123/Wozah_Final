@extends('admin.admin_master')
@section('content')

    <!-- Shop Document Information Tab -->
    <div class="mt-2" id="s_verify_info_section">
        <div>
            <h5>Shop Information</h5>
            <div class="d-flex justify-content-between">
                <p>Shop Name: {{$shop_info->shop_name}}</p>
                <p>Business Legal Name: {{$shop_info->b_legal_name}}</p>
                <p>Business DBA: {{$shop_info->b_dba}}</p>
            </div>
            <p>Business Address: {{$business_address}}</p>
            <p>Corporate Address: {{$corporate_address}}</p>
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
            <table class="table ">
                <h5 class="mt-3">Shop Document Information</h5>
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
                            <button>View</button>
                        </td>
                        <td>
                            <h4> <span class="badge bg-success">Verified</span></h4>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Business Certificate of Authority</td>
                        <td>
                            <button>View</button>
                        </td>
                        <td>
                            <h4> <span class="badge bg-success">Verified</span></h4>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Business Registration</td>
                        <td>
                           <button>View</button>
                        </td>
                        <td>
                            <h4> <span class="badge bg-success">Verified</span></h4>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">4</th>
                        <td>Nail Salon – Valid License necessary to Operate and Manage</td>
                        <td>
                            <button>View</button>
                        </td>
                        <td>
                            <h4> <span class="badge bg-success">Verified</span></h4>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">5</th>
                        <td>Employee Certification</td>
                        <td>
                            <button>View</button>
                        </td>
                        <td>
                            <h4> <span class="badge bg-success">Verified</span></h4>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">6</th>
                        <td>Business Insurance</td>
                        <td>
                            <button>View</button>
                        </td>
                        <td>
                            <h4> <span class="badge bg-success">Verified</span></h4>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">7</th>
                        <td>Business Workers Comp</td>
                        <td>
                            <button>View</button>
                        </td>
                        <td>
                            <h4> <span class="badge bg-success">Verified</span></h4>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">8</th>
                        <td>Owners Valid Driver’s License</td>
                        <td>
                            <button>View</button>
                        </td>
                        <td>
                            <h4> <span class="badge bg-success">Verified</span></h4>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- Shop Document Information Table End-->
        </div>

        <!--Payment Information  form end-->

    </div>
    <!-- Shop Document Information Tab End-->

@endsection
