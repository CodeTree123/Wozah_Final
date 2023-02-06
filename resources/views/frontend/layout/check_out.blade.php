 @extends('frontend.master')

 @section('content')

 <div class="container mb-4">
     <div class="py-5 text-center">
         <h2>Checkout form</h2>
         <p class="lead">Below is an example form built entirely with Bootstrap’s form controls. Each required form group has a validation state that can be triggered by attempting to submit the form without completing it.</p>
     </div>

     <div class="row g-5">
         <div class="col-md-5 col-lg-4 order-md-last">
             <h4 class="d-flex justify-content-between align-items-center mb-3">
                 <span class="text-primary">Your cart</span>
                 <span class="badge bg-primary rounded-pill">{{ count(Cart::content()) }}</span>
             </h4>
             <ul class="list-group mb-3">
                 @php
                 $carts = cart();
                 $count_cart = count($carts);
                 @endphp
                 @foreach ($carts as $cart)
                 <li class="list-group-item d-flex justify-content-between lh-sm">
                     <div>
                         <small class="text-muted">Catagory: {{$cart->options->subcat_name}} </small>
                         <h6 class="my-0">Service: {{$cart->name}}</h6>
                         <p class="my-0">Quantity: {{$cart->qty}}</p>
                     </div>
                     <span class="text-muted">${{$cart->subtotal}}</span>
                 </li>
                 @endforeach

                 <li class="list-group-item d-flex justify-content-between">
                     <span>Total (USD)</span>
                     <strong>$ {{ Cart::subtotal() }}</strong>
                 </li>
             </ul>

             <!-- <form class="card p-2">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Promo code">
            <button type="submit" class="btn btn-secondary">Redeem</button>
          </div>
        </form> -->
         </div>
         <div class="col-md-7 col-lg-8">
             <h4 class="mb-3">Billing address</h4>
             <form action="{{route('place_order')}}" class="needs-validation" novalidate="" method="post">
                 @csrf
                 <input type="hidden" name="cus_id" value="{{auth()->user()->id}}">
                 <div class="row g-3">
                     <div class="col-sm-6">
                         <label for="firstName" class="form-label">First name</label>
                         <input type="text" class="form-control" id="firstName" placeholder="" value="{{$user->first_name}}" required="">
                     </div>

                     <div class="col-sm-6">
                         <label for="lastName" class="form-label">Last name</label>
                         <input type="text" class="form-control" id="lastName" placeholder="" value="{{$user->last_name}}" required="">
                     </div>

                     <div class="col-12">
                         <label for="email" class="form-label">Email</label>
                         <input type="email" class="form-control" id="email" value="{{$user->email}}">
                     </div>

                     <div class="col-12 border border-dark pb-2">
                         <div class="row g-3 ">
                             <div class="col-12">
                                 <label for="address" class="form-label">Address</label>
                                 <input type="text" class="form-control" id="address" name="address" value="{{$user->customer_address}}">
                             </div>
                             <div class="col-6">
                                 <label for="c_street_number" class="form-label">Street Number</label>
                                 <input type="number" class="form-control" name="customer_street_number" value="{{$user->customer_street_number}}" id="c_street_number">
                             </div>
                             <div class="col-6">
                                 <label for="c_street_name" class="form-label">Street Name</label>
                                 <input type="text" class="form-control" name="customer_street_name" value="{{$user->customer_street_name}}" id="c_street_name">
                             </div>
                             <div class="col-3">
                                 <label for="c_apartment_no" class="form-label">Apt#</label>
                                 <input type="text" class="form-control" name="customer_apt" value="{{$user->customer_apt}}" id="c_apartment_no">
                             </div>
                             <div class="col-3">
                                 <label for="c_city" class="form-label">City</label>
                                 <input type="text" class="form-control" name="customer_city" value="{{$user->customer_city}}" id="c_city">
                             </div>
                             <div class="col-3">
                                 <label for="c_state" class="form-label">State</label>
                                 <input type="text" class="form-control" name="customer_state" value="{{$user->customer_state}}" id="c_state">
                             </div>
                             <div class="col-3">
                                 <label for="c_zip" class="form-label">Zip</label>
                                 <input type="number" class="form-control" name="customer_zip" value="{{$user->customer_zip}}" id="c_zip">
                             </div>
                         </div>
                     </div>
                 </div>
                 <hr class="my-4">

                 <button class="w-100 btn btn-primary btn-lg" type="submit">Place Order</button>
             </form>
         </div>
     </div>
 </div>
 @endsection

