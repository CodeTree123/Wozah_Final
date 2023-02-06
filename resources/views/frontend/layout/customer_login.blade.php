@extends('frontend.master')
@section('content')


  <div class="container-fluid container-parent">


    <section>
       <div class="container my-3">
        <div class="row">
                <!--Login Form -->
           <div class="col-lg-6 mx-auto">
                <h5 class=" " id=" ">Login For Customer</h5>

                {{--@if(Session::has('fail'))
                    <div class="alert alert-danger">{{Session::get('fail')}}</div>
                @endif--}}

               <form action="{{route('customer_login')}}" method="post">
                 @csrf

                <span class="text-danger mt-3">@error('emailorphone') {{$message}} @enderror</span>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control new-form-control" name="emailorphone"  id="loginCustomer" placeholder=" "  value="{{old('emailorphone')}}">
                    <label for="loginCustomer">Email/Phone Number</label>
                </div>

                <span class="text-danger mt-3">@error('password') {{$message}} @enderror</span>
                <div class="form-floating " id="show_hide_password">
                    <input type="password" class="form-control new-form-control  " name="password" id="loginPassword" placeholder="Password" autocomplete="on">
                    <label for="loginPassword" class="  password-label">
                        Password
                    </label>
                    <i class="fa fa-eye-slash toggle-password" aria-hidden="true"></i>
                </div>

                <div class="d-grid gap-2">
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
                </div>
                <div class="d-grid gap-2">
                    <button class="btn btn-primary   border my-2" type="submit">
                            Login
                    </button>
                </div>
                </form>
                <a href="{{route('customer_registration')}}" id="">Need a account?
                    <span class="text-primary">Please Register</span>
                </a>
           </div>

            </div>



    </div>



    </section>





    </div>
  </div>

  @endsection


  @push('scripts')
  <script>
 
 $(document).ready(function () {
    const show_hide_password_icon = document.querySelector("#show_hide_password i");
    const show_hide_password_input_field = document.querySelector("#show_hide_password input");

    $(show_hide_password_icon).on( "click", function () {  

          if ($(show_hide_password_input_field).attr("type") === "text") {

            $(show_hide_password_input_field).attr("type", "password");
 
            $(show_hide_password_icon).addClass("fa-eye-slash");
            $(show_hide_password_icon).removeClass("fa-eye");

            }
          else if($(show_hide_password_input_field).attr("type") === "password") {
            $(show_hide_password_input_field).attr("type", "text");
            
            $(show_hide_password_icon).addClass(" fa-eye");
            $(show_hide_password_icon).removeClass("fa-eye-slash");
            }
        }
    );
});

</script>
@endpush
