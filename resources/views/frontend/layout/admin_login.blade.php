@extends('frontend.master')
@section('content')


  <div class="container-fluid container-parent">


    <section>
       <div class="container my-5">
        <div class="row py-2">
                <!--Login Form -->
           <div class="col-lg-6 mx-auto">
                <h5 class="mb-3" id=" ">Login For Admin</h5>

                {{--@if(Session::has('fail'))
                    <div class="alert alert-danger">{{Session::get('fail')}}</div>
                @endif--}}

               <form action="{{route('admin_login')}}" method="post">
                 @csrf

                <span class="text-danger mt-3">@error('email') {{$message}} @enderror</span>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control new-form-control" name="email"  id="email" placeholder=" "  value="{{old('email')}}">
                    <label for="email">Email</label>
                </div>

                <span class="text-danger mt-3">@error('password') {{$message}} @enderror</span>
                <div class="form-floating " id="show_hide_password">
                    <input type="password" class="form-control new-form-control  " name="password" id="loginPassword" placeholder="Password" autocomplete="on">
                    <label for="loginPassword" class="  password-label">
                        Password
                    </label>
                    <i class="fa fa-eye-slash toggle-password" aria-hidden="true"></i>
                </div>

                <!-- <div class="d-grid gap-2">
                    <button class="btn new-form-control border mt-4" type="button">
                        <img src="{{ asset('img/social_media/google-icon.png ') }}" alt="">
                        Login With Google
                    </button>
                </div>

                <div class="d-grid gap-2">
                    <button class="btn new-form-control border my-2" type="button">
                        <img src="{{ asset('img/social_media/apple-icon.png ') }}" alt="">
                            Login With Apple
                    </button>
                </div>

                <div class="d-grid gap-2">
                    <button class="btn new-form-control border my-2" type="button">
                        <img src="{{ asset('img/social_media/facebook-icon.png ') }}" alt="">
                            Login With Facebook
                    </button>
                </div> -->
                <div class="d-grid gap-2 mt-2">
                    <button class="btn btn-primary   border my-2" type="submit">
                            Login
                    </button>
                </div>
                </form>
                <!-- <a href="{{route('customer_registration')}}" id="">Need a account?
                    <span class="text-primary">Please Register</span>
                </a> -->
           </div>

            </div>



    </div>



    </section>





    </div>
  </div>

  @endsection
