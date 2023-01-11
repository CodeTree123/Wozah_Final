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
                                    <img src="{{asset('img/profile-image.jpg')}}" alt="" class="img-fluid rounded">
                                </div>
                            </div>
                            <div class="col p-4 d-flex flex-column position-static">
                                <strong class="d-inline-block mb-2 text-primary">Personal Info</strong>
                                <h3 class="mb-0">Name: <span class="fw-normarl">Mickel</span></h3>
                                <p class="card-text mb-auto">Email: <span class="fw-normal">michekl@michkel.com</span>.</p>
                                <p class="card-text mb-auto">Phone: <span class="fw-normal">+12027953213</span>.</p>
                                <p class="card-text mb-auto">Gender: <span class="fw-normal">Male</span>.</p>
                                <p class="card-text mb-auto">Address: <span class="fw-normal">Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis, ducimus.</span>.</p>
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
                                <p class="card-text mb-auto">CC: <span class="fw-normal">123456</span>.</p>
                                <p class="card-text mb-auto">EXP: <span class="fw-normal">09/24</span>.</p>
                                <p class="card-text mb-auto">CVV: <span class="fw-normal">456 </span>.</p>
                                <p class="card-text mb-auto">ZIP: <span class="fw-normal">654 256</span>.</p>
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
                            <div class="col-12">
                                <input type="hidden" class="form-control" name="id" value="{{ Auth::user()->id}}">
                                <label for="c_address" class="form-label">Address</label>
                                <input type="text" class="form-control" name="customer_address" value="{{old('customer_address',$list->customer_address)}}" id="c_address">
                            </div>

                            <div class="col-6">
                                <label for="c_street_number" class="form-label">Street Number</label>
                                <input type="number" class="form-control" name="customer_street_number" value="{{old('customer_street_number',$list->customer_street_number)}}" id="c_street_number">
                            </div>

                            <div class="col-6">
                                <label for="c_street_name" class="form-label">Street Name</label>
                                <input type="text" class="form-control" name="customer_street_name" value="{{old('customer_street_name',$list->customer_street_name)}}" id="c_street_name">
                            </div>

                            <div class="col-3">
                                <label for="c_apartment_no" class="form-label">Apt#</label>
                                <input type="text" class="form-control" name="customer_apt" value="{{old('customer_apt',$list->customer_apt)}}" id="c_apartment_no">
                            </div>
                            <div class="col-3">
                                <label for="c_city" class="form-label">City</label>
                                <input type="text" class="form-control" name="customer_city" value="{{old('customer_city',$list->customer_city)}}" id="c_city">
                            </div>
                            <div class="col-3">
                                <label for="c_state" class="form-label">State</label>
                                <input type="text" class="form-control" name="customer_state" value="{{old('customer_state', $list->customer_state)}}" id="c_state">
                            </div>
                            <div class="col-3">
                                <label for="c_zip" class="form-label">Zip</label>
                                <input type="number" class="form-control" name="customer_zip" value="{{old('customer_zip', $list->customer_zip)}}" id="c_zip">
                            </div>

                            <div class="col-3">
                                <label for="c_phone" class="form-label">Phone No.</label>
                                <input type="tel" class="form-control" name="phone" value="{{old('phone',$list->phone)}}" id="c_phone" placeholder="Phone">
                            </div>
                            <div class="col-9">
                                <label for="formFile" class="form-label">Profile Picture</label>
                                <input class="form-control" type="file" id="formFile" name="customer_image">
                            </div>

                            <div class="col-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="m" value="male" {{($list->gender == 'male') ? 'checked' : ''}}>
                                    <label class="form-check-label" for="m">Male</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="f" value="female" {{($list->gender == 'female') ? 'checked' : ''}}>
                                    <label class="form-check-label" for="f">Female</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="preferNot" value="not_preferred" {{($list->gender == 'not_preferred') ? 'checked' : ''}}>
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
                            <input type="numbder" class="form-control" id="c_cc" name="c_cc" value="{{old('c_cc',$list->c_cc)}}">
                        </div>
                        <div class="col-6">
                            <label for="c_card_exp" class="form-label">Exp</label>
                            <input type="month" class="form-control" id="c_card_exp" name="c_card_exp" value="{{old('c_card_exp',$list->c_card_exp)}}">
                        </div>

                        <div class="col-6">
                            <label for="c_cvv" class="form-label">CVV</label>
                            <input type="number" class="form-control" id="c_cvv" name="c_cvv" value="{{old('c_cvv',$list->c_cvv)}}">
                        </div>

                        <div class="col-6">
                            <label for="c_payment_zip" class="form-label">ZIP</label>
                            <input type="number" class="form-control" id="c_payment_zip" name="c_payment_zip" value="{{old('c_payment_zip',$list->c_payment_zip)}}">
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