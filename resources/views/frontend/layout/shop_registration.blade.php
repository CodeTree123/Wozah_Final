@extends('frontend.master')
@section('content')
<div class="container-fluid container-parent">

    <section>
        <div class="container my-3">
            <div class="row">

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a href="{{url('/shop_registration')}}" class="nav-link text-black {{request()->is('shop_registration') ? 'active' : ''}}" id="shop_registration-tab" role="tab" aria-controls="shop_registration" aria-selected="true">Shop Registration</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a href="{{url('/individual_registration')}}" class="nav-link text-black {{request()->is('individual_registration') ? 'active' : ''}}" role="tab" aria-controls="individual_registration" aria-selected="false">Individual Registration</a>
                </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane {{request()->is('shop_registration') ? 'active' : ''}}" id="{{url('/shop_registration')}}" role="tabpanel" aria-labelledby="shop_registration-tab">
                        <!--Shop Login Form -->
                        <div class="col-lg-6 mx-auto">
                            <h5 class="my-3" id=" ">New Shop Registration </h5>
                            <form action="{{route('new_register')}}" method="post">
                            @csrf
                                <div class="{{old('verify') ? 'd-none': 'row g-3'}} ">
                                    <input type="hidden" class="form-control new-form-control" name="role_id" value="2">

                                    <span class="text-danger mt-3">@error('shop_name') {{$message}} @enderror</span>
                                    <div class="form-floating m-0 mb-3">
                                        <input type="text" class="form-control new-form-control" name="shop_name" id="bName" placeholder=" " value="{{old('shop_name')}}">
                                        <label for="bName">Shop Name</label>
                                    </div>

                                    <span class="text-danger m-0">@error('email') {{$message}} @enderror</span>
                                    <div class="form-floating m-0 mb-3">
                                        <input type="text" class="form-control new-form-control" name="email" id="bEmail" placeholder=" " value="{{old('email')}}">
                                        <label for="bEmail">Shop Email</label>
                                    </div>

                                    <span class="text-danger m-0">@error('phone') {{$message}} @enderror</span>
                                    <div class="form-floating m-0 mb-3">
                                        <input type="tel" class="form-control new-form-control" name="phone" id="bPhone" placeholder=" " value="{{old('phone')}}">
                                        <label for="bPhone">Contact Number</label>
                                    </div>

                                    <div class="form-floating m-0 mb-3">
                                        <input type="text" class="form-control new-form-control" name="shop_address" id="bAddress" placeholder=" " value="{{old('shop_address')}}">
                                        <label for="bAddress">Shop Address</label>
                                    </div>

                                    <span class="text-danger m-0">@error('password') {{$message}} @enderror</span>
                                    <div class="form-floating m-0 mb-3">
                                        <div class="input-group"  >
                                            <input type="password" class="form-control new-form-control password_input" name="password" id="bPassword"
                                                placeholder="Password" autocomplete="on" value="{{old('password')}}">
                                            <label for="bPassword"></label>
                                        </div>
                                    </div>

                                    <span class="text-danger m-0">@error('password_confirmation') {{$message}} @enderror</span>
                                    <div class="form-floating m-0 mb-3">
                                        <div class="input-group" >
                                            <input type="password" class="form-control new-form-control password_input" name="password_confirmation" id="bConfirmPassword" placeholder="Confirm Password" autocomplete="on" value="{{old('password_confirmation')}}">
                                            <label for="bConfirmPassword"></label>
                                        </div>
                                    </div>
                                    <div class=" m-0 mb-3">
                                        <p id="" class="show_hide_password">
                                            <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                            <span>Show Password</span>
                                        </p>
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

                                <div class="d-flex">
                                    <button type="submit" class="btn btn-primary ">Register</button>
                                    @if(old('verify'))
                                        <a href="{{route('shop_registration')}}" class="btn btn-primary ms-3">Cancel</a>
                                    @endif
                                </div>
                                
                            </form>
                                Already Have a shop account?
                            <a href="{{route('shop_login_view')}}">
                                <p class="font-weight-bold d-inline text-primary">Login to your shop account</p>
                            </a>
                        </div>
                    </div>
                    <div class="tab-pane {{request()->is('individual_registration') ? 'active' : ''}}" id="{{url('/individual_registration')}}" role="tabpanel" aria-labelledby="individual_registration-tab">
                        <!--Individual Login Form -->
                        <div class="col-lg-6 mx-auto">
                            <h5 class="my-3" id=" ">New Individual Registration </h5>

                            @if(Session::has('success'))
                            <div class="alert alert-success">{{Session::get('success')}}</div>
                            @endif
                            @if(Session::has('fail'))
                            <div class="alert alert-danger">{{Session::get('fail')}}</div>
                            @endif

                            <form action="{{route('new_register')}}" method="post" class="mb-3">
                            @csrf

                                <div class="{{old('verify') ? 'd-none': 'row g-3'}} ">
                                    <input type="hidden" class="form-control new-form-control" name="role_id" value="3">

                                    <span class="text-danger mt-3">@error('first_name') {{$message}} @enderror</span>
                                    <div class="form-floating m-0 mb-3">
                                        <input type="text" class="form-control new-form-control" name="first_name" id="fName" placeholder=" " value="{{old('first_name')}}">
                                        <label for="fName">First Name</label>
                                    </div>

                                    <span class="text-danger mt-0">@error('last_name') {{$message}} @enderror</span>
                                    <div class="form-floating m-0 mb-3">
                                        <input type="text" class="form-control new-form-control" name="last_name" id="lName" placeholder=" " value="{{old('last_name')}}">
                                        <label for="lName">Last Name</label>
                                    </div>

                                    <span class="text-danger mt-0">@error('email') {{$message}} @enderror</span>
                                    <div class="form-floating m-0 mb-3">
                                        <input type="email" class="form-control new-form-control" name="email" id="email" placeholder=" " value="{{old('email')}}">
                                        <label for="email">Enter Your Email</label>
                                    </div>

                                    <span class="text-danger mt-0">@error('phone') {{$message}} @enderror</span>
                                    <div class="form-floating m-0 mb-3">
                                        <input type="tel" class="form-control new-form-control" name="phone" id="loginPhone" placeholder=" " value="{{old('phone')}}">
                                        <label for="loginPhone">Phone Number</label>
                                    </div>

                                    <span class="text-danger mt-0">@error('password') {{$message}} @enderror</span>
                                    <div class="form-floating m-0 mb-3">
                                        <div class="input-group" >
                                            <input type="password" class="form-control new-form-control password_input_individual" name="password" id="cPassword"
                                                placeholder="Password" autocomplete="on" value="{{old('password')}}">
                                            <label for="cPassword"></label>
                                        </div>
                                    </div>

                                    <span class="text-danger mt-0">@error('password_confirmation') {{$message}} @enderror</span>
                                    <div class="form-floating m-0 mb-3">
                                        <div class="input-group"  >
                                            <input type="password" class="form-control new-form-control password_input_individual" name="password_confirmation" id="cConfirmPassword"
                                                placeholder="Confirm Password" autocomplete="on" value="{{old('password_confirmation')}}">
                                            <label for="cConfirmPassword"></label>
                                            <br>
                                        </div>
                                           <div class="my-3">
                                    <p   class="show_hide_password_individual">
                                        <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                        <span>Show Password</span>
                                    </p>
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


                                <div class="d-flex">
                                    <button type="submit" class="btn btn-primary ">Register</button>
                                    @if(old('verify'))
                                        <a href="{{route('customer_registration')}}" class="btn btn-primary ms-3">Cancel</a>
                                    @endif
                                </div>

                            </form>
                            <a href="{{route('shop_login_view')}}">
                                Already Have a account?
                                <p class="font-weight-bold d-inline text-primary">Login to your shop account</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>


        </div>



    </section>

</div>
</div>


<script>

</script>
@endsection
