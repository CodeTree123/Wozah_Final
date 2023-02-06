@extends('frontend.master')
@section('content')

<div class="container-fluid container-parent">
    <section class="mb-4">
        <div class="row mx-0">
            <div class="col-lg-3">
                <div class="d-flex flex-column ">
                    <!-- <a href="#customer_personal_info_section" style="display: contents;">
                        <button type="button" class="btn btn-light border-bottom my-2"  id="customer_personal_info_section_btn">My Information</button>
                    </a>
                    <a href="#customer_payment_info_section" style="display: contents;">
                        <button type="button" class="btn btn-light border-bottom my-2" id="customer_payment_info_section_btn">Payment Information</button>
                    </a> -->
                    <button type="button" class="btn btn-light border-bottom my-2" id="customer_personal_info_section_btn">My Information</button>
                    <button type="button" class="btn btn-light border-bottom my-2" id="customer_personal_info_update_section_btn">Update Information</button>
                    <button type="button" class="btn btn-light border-bottom my-2" id="customer_payment_info_section_btn">Payment Information</button>
                </div>
            </div>
            <div class="col-lg-9 ">
                <div class="toggle-segment-1 mt-2" id="customer_personal_info_section">
                    <h2>Your Personal Information</h2>
                    <!--Personal Information Update form   -->
                    <div class="  ">


                        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 ">
                            <div class="col-auto m-4">
                                <div class="profile_info_img_wrapper ">
                                    @if($customer->image == null)
                                    <img src="{{asset('img/profile-image.jpg')}}" alt="" class="img-fluid rounded">
                                    @else
                                    <img src="{{asset('uploads/customer/'.$customer->image)}}" alt="" class="img-fluid rounded">
                                    @endif
                                </div>
                            </div>
                            <div class="col p-4 d-flex flex-column position-static">
                                <strong class="d-inline-block mb-2 text-primary">Personal Info</strong>
                                <h3 class="mb-0">Name: <span class="fw-normarl">{{$customer->first_name." ".$customer->last_name}}</span></h3>
                                <p class="card-text mb-auto">Email: <span class="fw-normal">{{$customer->email}}</span>.</p>
                                <p class="card-text mb-auto">Phone: <span class="fw-normal">{{$customer->phone}}</span>.</p>
                                <p class="card-text mb-auto">Gender: <span class="fw-normal">{{$customer->gender}}</span>.</p>
                                <p class="card-text mb-auto">Address: 
                                    @if($customer->customer_street_number == null || $customer->customer_street_name == null || $customer->customer_apt == null || $customer->customer_city == null || $customer->customer_state == null || $customer->customer_zip == null)
                                    <span class="fw-normal text-danger">There was no address added yet.</span>
                                    @else
                                    <span class="fw-normal">{{$customer->customer_street_number." ". $customer->customer_street_name .", Apartment #". $customer->customer_apt .",". $customer->customer_city .",". $customer->customer_state .",". $customer->customer_zip .",USA"}}</span>.
                                    @endif
                                </p>

                            </div>

                        </div>

                        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 ">
                            <div class="col-auto m-4">
                                <div class="profile_info_img_wrapper ">
                                    <img src="{{asset('img/payment.jpg')}}" alt="" class="img-fluid rounded">
                                </div>
                            </div>
                            <div class="col p-4 d-flex flex-column position-static">
                                <strong class="d-inline-block mb-2 text-primary">Payment Info</strong>
                                <p class="card-text mb-auto">CC:
                                    @if($customer->c_cc == null)
                                    <span class="fw-normal text-danger">There was no CC added yet.</span>
                                    @else
                                    <span class="fw-normal">{{$customer->c_cc}}</span>.
                                    @endif
                                </p>
                                <p class="card-text mb-auto">EXP:
                                    @if($customer->c_card_exp == null)
                                    <span class="fw-normal text-danger">There was no EXP added yet.</span>
                                    @else
                                    <span class="fw-normal">{{$customer->c_card_exp}}</span>.
                                    @endif
                                </p>
                                <p class="card-text mb-auto">CVV:
                                    @if($customer->c_cvv == null)
                                    <span class="fw-normal text-danger">There was no CVV added yet.</span>
                                    @else
                                    <span class="fw-normal">{{$customer->c_cvv}} </span>.
                                    @endif
                                </p>
                                <p class="card-text mb-auto">ZIP:
                                    @if($customer->c_payment_zip == null)
                                    <span class="fw-normal text-danger">There was no ZIP added yet.</span>
                                    @else
                                    <span class="fw-normal">{{$customer->c_payment_zip}}</span>.
                                    @endif
                                </p>
                            </div>

                        </div>
                    </div>

                    <!--Personal Information  form end  -->
                </div>
                <div class="toggle-segment-2 mt-2" id="customer_personal_info_update_section">
                    <h2>Update Your Personal Information</h2>
                    <!--Personal Information Update form   -->

                    <form class="row g-3" action="{{route('profile_update')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="{{old('verify') ? 'd-none': 'row g-3'}} ">
                            <input type="hidden" class="form-control" name="id" value="{{ Auth::user()->id}}">
                            {{-- <div class="col-12">
                                <label for="c_address" class="form-label">Address</label>
                                <input type="text" class="form-control" name="customer_address" value="{{old('customer_address',$customer->customer_address)}}" id="c_address">
                                
                            </div> --}}

                            <div class="col-6">
                                <label for="c_street_number" class="form-label">Street Number</label>
                                <input type="number" class="form-control" name="customer_street_number" value="{{old('customer_street_number',$customer->customer_street_number)}}" id="c_street_number">
                                <span class="text-danger mt-3">@error('customer_street_number') {{$message}} @enderror</span>
                            </div>

                            <div class="col-6">
                                <label for="c_street_name" class="form-label">Street Name</label>
                                <input type="text" class="form-control" name="customer_street_name" value="{{old('customer_street_name',$customer->customer_street_name)}}" id="c_street_name">
                                <span class="text-danger mt-3">@error('customer_street_name') {{$message}} @enderror</span>
                            </div>

                            <div class="col-3">
                                <label for="c_apartment_no" class="form-label">Apt#</label>
                                <input type="text" class="form-control" name="customer_apt" value="{{old('customer_apt',$customer->customer_apt)}}" id="c_apartment_no">
                                <span class="text-danger mt-3">@error('customer_apt') {{$message}} @enderror</span>
                            </div>
                            <div class="col-3">
                                <label for="c_city" class="form-label">City</label>
                                <input type="text" class="form-control" name="customer_city" value="{{old('customer_city',$customer->customer_city)}}" id="c_city">
                                <span class="text-danger mt-3">@error('customer_city') {{$message}} @enderror</span>
                            </div>
                            <div class="col-3">
                                <label for="c_state" class="form-label">State</label>
                                <input type="text" class="form-control" name="customer_state" value="{{old('customer_state', $customer->customer_state)}}" id="c_state">
                                <span class="text-danger mt-3">@error('customer_state') {{$message}} @enderror</span>
                            </div>
                            <div class="col-3">
                                <label for="c_zip" class="form-label">Zip</label>
                                <input type="number" class="form-control" name="customer_zip" value="{{old('customer_zip', $customer->customer_zip)}}" id="c_zip">
                                <span class="text-danger mt-3">@error('customer_zip') {{$message}} @enderror</span>
                            </div>

                            <div class="col-3">
                                <label for="c_phone" class="form-label">Phone No.</label>
                                <input type="tel" class="form-control" name="phone" value="{{old('phone',$customer->phone)}}" id="c_phone" placeholder="Phone">
                            </div>
                            <div class="col-6">
                                <label for="formFile" class="form-label">Profile Picture</label>
                                <input class="form-control" type="file" id="formFile" name="customer_image">
                            </div>
                            <div class="col-3 text-center">
                                @if($customer->image != null)
                                <img src="{{asset('uploads/customer/'.$customer->image)}}" alt="" width="100px" height="100px">
                                @endif
                            </div>

                            <div class="col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="m" value="Male" {{($customer->gender == 'Male') ? 'checked' : ''}}>
                                    <label class="form-check-label" for="m">Male</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="f" value="Female" {{($customer->gender == 'Female') ? 'checked' : ''}}>
                                    <label class="form-check-label" for="f">Female</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="preferNot" value="Prefer Not to Say" {{($customer->gender == 'Prefer Not to Say') ? 'checked' : ''}}>
                                    <label class="form-check-label" for="preferNot">Prefer Not to Say</label>
                                </div>
                            </div>
                        </div>
                        @if(old('verify'))
                        @if (Session::has('otp_msg'))
                        <div class="alert alert-success">
                            <p>{!! Session::get('otp_msg') !!}</p>
                        </div>
                        @endif

                        <div class="col-12">
                            <label for="otp" class="form-label">Verify Otp.</label>
                            <input type="tel" class="form-control" name="otp" value="" id="otp" placeholder="Otp">
                        </div>

                        <div class="card-header mb-3">
                            <p class="d-flex align-items-center mb-0">
                                Didn't get otp ??
                                <button type="submit" class="btn p-0 ms-2 text-decoration-underline">Click Here</button>
                            </p>
                        </div>
                        @endif


                        <div class="col-12">
                            <div class="d-flex">
                                <button type="submit" class="btn btn-primary ">Update</button>
                                @if(old('verify'))
                                <a href="{{route('edit_user_profile')}}" class="btn btn-primary ms-3">Cancel</a>
                                @endif
                            </div>
                        </div>
                    </form>

                    <!--Personal Information  form end  -->
                </div>


                <div class="toggle-segment-2 mt-2" id="customer_payment_info_section">
                    <h2>Edit Your Payment Information</h2>
                    <!--Payment Information  form -->
                    <form action="{{route('payment_update')}}" class="row g-3" method="post">
                        @csrf

                        <input type="hidden" class="form-control" name="id" value="{{ Auth::user()->id}}">

                        <div class="col-6">
                            <label for="c_cc" class="form-label">CC #</label>
                            <input type="numbder" class="form-control" id="c_cc" name="c_cc" value="{{old('c_cc',$customer->c_cc)}}">
                        </div>
                        <div class="col-6">
                            <label for="c_card_exp" class="form-label">Exp</label>
                            <input type="month" class="form-control" id="c_card_exp" name="c_card_exp" value="{{old('c_card_exp',$customer->c_card_exp)}}">
                        </div>

                        <div class="col-6">
                            <label for="c_cvv" class="form-label">CVV</label>
                            <input type="number" class="form-control" id="c_cvv" name="c_cvv" value="{{old('c_cvv',$customer->c_cvv)}}">
                        </div>

                        <div class="col-6">
                            <label for="c_payment_zip" class="form-label">ZIP</label>
                            <input type="number" class="form-control" id="c_payment_zip" name="c_payment_zip" value="{{old('c_payment_zip',$customer->c_payment_zip)}}">
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                    <!--Payment Information  form end-->

                </div>

            </div>
        </div>
    </section>
</div>
<script>
    const customer_personal_info_section_btn = document.getElementById('customer_personal_info_section_btn');
    const customer_personal_info_update_section_btn = document.getElementById('customer_personal_info_update_section_btn');
    const customer_payment_info_section_btn = document.getElementById('customer_payment_info_section_btn');
    const my_order_list_section_btn = document.getElementById('my_order_list_section_btn');

    const customer_personal_info_section = document.getElementById('customer_personal_info_section');
    const customer_personal_info_update_section = document.getElementById('customer_personal_info_update_section');
    const customer_payment_info_section = document.getElementById('customer_payment_info_section');
    const my_order_list_section = document.getElementById('my_order_list_section');

    customer_personal_info_section_btn.addEventListener("click", () => {
        customer_personal_info_section.style.display = "block";
        customer_personal_info_update_section.style.display = "none";
        customer_payment_info_section.style.display = "none";
    });

    customer_personal_info_update_section_btn.addEventListener("click", () => {
        customer_personal_info_section.style.display = "none";
        customer_personal_info_update_section.style.display = "block";
        customer_payment_info_section.style.display = "none";
    });

    customer_payment_info_section_btn.addEventListener("click", () => {
        customer_personal_info_section.style.display = "none";
        customer_personal_info_update_section.style.display = "none";
        customer_payment_info_section.style.display = "block";
    });

    my_order_list_section_btn.addEventListener("click", () => {
        customer_personal_info_section.style.display = "none";
        customer_personal_info_update_section.style.display = "none";
        customer_payment_info_section.style.display = "none";
        my_order_list_section.style.display = "block";
    });
</script>




</div>
</div>

@endsection