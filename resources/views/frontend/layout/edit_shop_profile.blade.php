@extends('frontend.master')
@section('content')

<div class="container-fluid container-parent">
    <section class="mb-4">
        <div class="row mx-0">
            <div class="col-lg-3">
                <div class="d-flex flex-column ">
                    <a href="{{route('service_provider_index')}}" class="btn btn-light border-bottom my-2 w-100">Home</a>
                    <button type="button" class="btn btn-light border-bottom my-2" id="s_personal_info_section_btn">Shop
                        Information</button>
                    <button type="button" class="btn btn-light border-bottom my-2"
                        id="s_verify_info_section_btn">Shop Documents</button>
                </div>
            </div>
            <div class="col-lg-9 ">
                <!-- Personal Information Tab -->
                <div class="toggle-segment-1 mt-2" id="s_personal_info_section">
                    <h2>Update Your Shop Information</h2>
                    <!--Personal Information Update form   -->
                    <form class="row g-3" action="{{route('shop_edit_profile')}}" method="post">
                      @csrf
                        <div class="col-12">
                          <input type="hidden" class="form-control" name="s_id" value="{{Auth::user()->id}}" id="sLegalName">
                            <label for="sLegalName" class="form-label">Business Legal Name</label>
                            <input type="text" class="form-control" name="b_legal_name" value="{{ old('b_legal_name',$shop->b_legal_name)}}" id="sLegalName">
                        </div>

                        <div class="col-12">
                            <label for="sBusinessDBA" class="form-label">Business DBA</label>
                            <input type="text" class="form-control" name="b_dba" value="{{ old('b_dba',$shop->b_dba)}}" id="sBusinessDBA">
                        </div>

                        <div class="d-flex flex-wrap justified-content-between gap-3 ">
                            <h5 class="">Business Address</h5>
                            <div class="address-type"></div>
                            <div class="col-12">
                                <label for="s_street_number" class="form-label">Street Number</label>
                                <input type="number" class="form-control" name="street_number_b" value="{{ old('street_number_b',$shop->street_number_b)}}" id="s_street_number">
                            </div>

                            <div class="col-2">
                                <label for="s_apartment_no" class="form-label">Apt#</label>
                                <input type="text" class="form-control" name="apt_b" value="{{ old('apt_b',$shop->apt_b)}}" id="s_apartment_no">
                            </div>
                            <div class="col-2">
                                <label for="s_city" class="form-label">City</label>
                                <input type="text" class="form-control" name="city_b" value="{{ old('city_b',$shop->city_b)}}" id="s_city">
                            </div>
                            <div class="col-2">
                                <label for="s_state" class="form-label">State</label>
                                <input type="text" class="form-control" name="state_b" value="{{ old('state_b',$shop->state_b)}}" id="s_state">
                            </div>
                            <div class="col-2">
                                <label for="s_zip" class="form-label">Zip</label>
                                <input type="number" class="form-control" name="zip_b" value="{{ old('zip_b',$shop->zip_b)}}" id="s_zip">
                            </div>
                        </div>

                        <div class="d-flex flex-wrap justified-content-between gap-3 ">
                            <h5 class="">Corporate Address</h5>
                            <div class="address-type"></div>
                            <div class="col-12">
                                <label for="s_Corporate_street_number" class="form-label">Street Number</label>
                                <input type="number" class="form-control" name="street_number_c" value="{{ old('street_number_c',$shop->street_number_c)}}" id="s_Corporate_street_number">
                            </div>

                            <div class="col-2">
                                <label for="s_Corporate_apartment_no" class="form-label">Apt#</label>
                                <input type="text" class="form-control" name="apt_c" value="{{ old('apt_c',$shop->apt_c)}}" id="s_Corporate_apartment_no">
                            </div>
                            <div class="col-2">
                                <label for="s_Corporate_city" class="form-label">City</label>
                                <input type="text" class="form-control" name="city_c" value="{{ old('city_c',$shop->city_c)}}" id="s_Corporate_city">
                            </div>
                            <div class="col-2">
                                <label for="s_Corporate_state" class="form-label">State</label>
                                <input type="text" class="form-control" name="state_c" value="{{ old('state_c',$shop->state_c)}}" id="s_Corporate_state">
                            </div>
                            <div class="col-2">
                                <label for="s_Corporate_zip" class="form-label">Zip</label>
                                <input type="number" class="form-control" name="zip_c" value="{{ old('zip_c',$shop->zip_c)}}" id="s_Corporate_zip">
                            </div>
                        </div>


                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                    <!--Personal Information  form end  -->
                </div>
                <!-- Personal Information Tab End-->


                <!-- Shop Document Information Tab -->
                <div class="toggle-segment-2 mt-2" id="s_verify_info_section">
                    <h2>Verify Shop Payment Information</h2>
                    <!--Payment Information  form -->

                    <div class="row mt-5">

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
                                    <td>{{ Auth::user()->email}}</td>
                                    <td>
                                        @if(Auth::user()->email_verified_at == null)
                                        <h4> <span class="badge bg-warning"></span>Not Verified</h4>
                                        @else
                                        <h4> <span class="badge bg-success">Verified</span> </h4>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Phone Number</td>
                                    <td>{{ Auth::user()->phone}}</td>
                                    <td>
                                        @if(Auth::user()->email_verified_at == null)
                                        <h4> <span class="badge bg-warning"></span>Not Verified</h4>
                                        @else
                                        <h4> <span class="badge bg-success">Verified</span> </h4>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!--Shop Contact Information Table End-->

                        <!-- Shop Document Information Table -->
                        <form method="POST" action="{{route('sp_add_documents')}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}" id="">
                        @if(Auth::user()->role_id == '2')
                        <table class="table ">
                            <h5 class="mt-5">Shop Document Information</h5>
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
                                    <td class="d-flex flex-column">
                                        @if($sp_doc->b_ein == null)
                                        <input type="file" name="b_ein" id="">
                                        <span class="text-danger">@error('b_ein') {{$message}} @enderror</span>
                                        @else
                                        <button>View</button>
                                        @endif
                                    </td>
                                    <td>
                                        @if($sp_doc->b_ein_status == 0)
                                        <h4> <span class="badge bg-warning text-dark">Verification Pending</span></h4>
                                        @else
                                        <h4> <span class="badge bg-warning text-dark">Verification Done</span></h4>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Business Certificate of Authority</td>
                                    <td class="d-flex flex-column">
                                        @if($sp_doc->b_certificate == null)
                                        <input type="file" name="b_certificate" id="">
                                        <span class="text-danger">@error('b_certificate') {{$message}} @enderror</span>
                                        @else
                                        <button>View</button>
                                        @endif
                                    </td>
                                    <td>
                                        @if($sp_doc->b_certificate_status == 0)
                                        <h4> <span class="badge bg-warning text-dark">Verification Pending</span></h4>
                                        @else
                                        <h4> <span class="badge bg-warning text-dark">Verification Done</span></h4>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>Business Registration</td>
                                    <td class="d-flex flex-column">
                                        @if($sp_doc->b_registration == null) 
                                        <input type="file" name="b_registration" id="">
                                        <span class="text-danger">@error('b_registration') {{$message}} @enderror</span>
                                         @else
                                        <button>View</button>
                                        @endif
                                    </td>
                                      <td>
                                        @if($sp_doc->b_registration_status == 0)
                                        <h4> <span class="badge bg-warning text-dark">Verification Pending</span></h4>
                                        @else
                                        <h4> <span class="badge bg-warning text-dark">Verification Done</span></h4>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">4</th>
                                    <td>Nail Salon – Valid License necessary to Operate and Manage</td>
                                    <td>
                                        @if($sp_doc->nail_salon == null)  
                                        <input type="file" name="nail_salon" id="">
                                        <span class="text-danger">@error('nail_salon') {{$message}} @enderror</span>
                                        @else
                                        <button>View</button>
                                        @endif
                                    </td>
                                     <td>
                                        @if($sp_doc->nail_salon == 0)
                                        <h4> <span class="badge bg-warning text-dark">Verification Pending</span></h4>
                                        @else
                                        <h4> <span class="badge bg-warning text-dark">Verification Done</span></h4>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">5</th>
                                    <td>Employee Certification</td>
                                    <td class="d-flex flex-column">
                                        @if($sp_doc->e_certificate == null)  
                                        <input type="file" name="e_certificate" id="">
                                        <span class="text-danger">@error('e_certificate') {{$message}} @enderror</span>
                                        <span class="text-danger">@error('nail_salon') {{$message}} @enderror</span>
                                        @else
                                        <button>View</button>
                                        @endif
                                    </td>
                                     <td>
                                        @if($sp_doc->nail_salon == 0)
                                        <h4> <span class="badge bg-warning text-dark">Verification Pending</span></h4>
                                        @else
                                        <h4> <span class="badge bg-warning text-dark">Verification Done</span></h4>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">6</th>
                                    <td>Business Insurance</td>
                                    <td class="d-flex flex-column">
                                        @if($sp_doc->b_insurance == null)   
                                        <input type="file" name="b_insurance" id="">
                                        <span class="text-danger">@error('b_ein') {{$message}} @enderror</span>
                                        @else
                                        <button>View</button>
                                        @endif
                                    </td>
                                    <td>
                                        @if($sp_doc->nail_salon == 0)
                                        <h4> <span class="badge bg-warning text-dark">Verification Pending</span></h4>
                                        @else
                                        <h4> <span class="badge bg-warning text-dark">Verification Done</span></h4>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">7</th>
                                    <td>Business Workers Comp</td>
                                    <td class="d-flex flex-column">
                                        @if($sp_doc->b_workers == null)    
                                        <input type="file" name="b_workers" id="">
                                        <span class="text-danger">@error('b_workers') {{$message}} @enderror</span>
                                         <span class="text-danger">@error('b_ein') {{$message}} @enderror</span>
                                        @else
                                        <button>View</button>
                                        @endif
                                    </td>
                                    <td>
                                        @if($sp_doc->nail_salon == 0)
                                        <h4> <span class="badge bg-warning text-dark">Verification Pending</span></h4>
                                        @else
                                        <h4> <span class="badge bg-warning text-dark">Verification Done</span></h4>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">8</th>
                                    <td>Owners Valid Driver’s License</td>
                                    <td class="d-flex flex-column">
                                        @if($sp_doc->driver_license == null) 
                                        <input type="file" name="driver_license" id="">
                                        <span class="text-danger">@error('driver_license') {{$message}} @enderror</span> @else
                                        <button>View</button>
                                        @endif
                                    </td>
                                    <td>
                                        @if($sp_doc->nail_salon == 0)
                                        <h4> <span class="badge bg-warning text-dark">Verification Pending</span></h4>
                                        @else
                                        <h4> <span class="badge bg-warning text-dark">Verification Done</span></h4>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        @endif
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                      </form>
                        <!-- Shop Document Information Table End-->
                    </div>

                    <!--Payment Information  form end-->

                </div>
                <!-- Shop Document Information Tab End-->

            </div>
        </div>
    </section>
</div>
<script>
const s_personal_info_section_btn = document.getElementById('s_personal_info_section_btn');

const s_verify_info_section_btn = document.getElementById('s_verify_info_section_btn');

const s_personal_info_section = document.getElementById('s_personal_info_section');

const s_verify_info_section = document.getElementById('s_verify_info_section');

s_personal_info_section_btn.addEventListener("click", () => {
    console.log("clicked");
    s_personal_info_section.style.display = "block";
    s_verify_info_section.style.display = "none";
});

s_verify_info_section_btn.addEventListener("click", () => {
    console.log("clicked");
    s_personal_info_section.style.display = "none";
    s_verify_info_section.style.display = "block";
});
</script>




</div>
</div>

@endsection
