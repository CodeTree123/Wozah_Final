@extends('frontend.master')
@section('content')
    <title>US PROJECT </title>



  <div class="container-fluid container-parent">
    
    <section>
       <div class="container my-3">
        <div class="row">

                <!--Login Form -->
           <div class="col-lg-6 mx-auto">
                <h5 class=" " id=" ">Login to your shop account </h5>
                </h5>
               <form action="{{route('shop_login')}}" method="post">
                 @csrf
               <div class="form-floating mb-3">
                    <input type="email" class="form-control new-form-control" name="email"  id="shopEmail" placeholder=" " required value="{{old('email')}}">
                    <label for="shopEmail">Email</label>
                </div>
                <span class="text-danger">@error('email') {{$message}} @enderror</span>

                <div class="form-floating " id="show_hide_password">

                    <input type="password" class="form-control new-form-control" name="password" id="bPassword" placeholder="Password" autocomplete="on" required>
                    <label for="bPassword" class="  password-label">
                        Password
                    </label>
                    <i class="fa fa-eye-slash toggle-password" aria-hidden="true"></i>
                </div>
                <span class="text-danger">@error('password') {{$message}} @enderror</span>

               <button type="submit" class="btn btn-primary my-4"  >Login</button>
               </form>
               <a href="{{route('shop_registration')}}" id="">Need a account for your shop?
                <span class="text-primary">Please Register Your shop</span>
                </a>

           </div>
            </div>


            <!-- //<a href="{{route('edit_shop_profile')}}" class="text-danger  ">
                         Edit shop profile
                        </a> -->
    </div>



    </section>

    </div>
  </div>


  <script>


  </script>
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


