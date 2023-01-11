 @extends('frontend.master')
 @section('content')

 <title>US PROJECT-Service Detail</title>



 <div class="container-flush">

     <section class="section-products div-color-1">
         <div class="container">

             <div style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
                 aria-label="breadcrumb">
                 <ol class="breadcrumb">
                     <li class="breadcrumb-item">
                         <a href="/">
                             Home
                         </a>
                     </li>
                     <li class="breadcrumb-item active" aria-current="page">
                         @if($shop_info->shop_name != null)
                             <a href="{{route('service_list',[$shop_info->u_id])}}">
                                 <!-- Vista Salon & Spa -->
                                 {{$shop_info->shop_name}}
                             </a>
                         @else
                             <a href="{{route('service_list',[$shop_info->u_id])}}">
                                 <!-- Vista Salon & Spa -->
                                 {{$shop_info->first_name}} {{$shop_info->last_name}}
                             </a>
                         @endif
                     </li>
                     <li class="breadcrumb-item " aria-current="page" id="service-category">
                         <!-- Hair Styling -->
                         {{$subcat}}
                     </li>
                 </ol>
             </div>

             </nav>
             <div class="row gx-5">

                 <div class="col-lg-8 col-md-8 col-sm-8 col-8 div-color-2">

                     <ul class="nav nav-pills  mb-3 service-detail-ul" id="pills-tab" role="tablist">
                         @foreach($services as $key=>$service)
                         <li class="nav-item" role="presentation">
                             <button class="btn   custom-hover-1 {{ $loop->first ? 'active' : ''}}"
                                 id="pills-straight-hair-tab{{$key + 1}}" data-bs-toggle="pill"
                                 data-bs-target="#pills-straight-hair{{$key + 1}}" type="button" role="tab"
                                 aria-controls="pills-straight-hair{{$key + 1}}"
                                 aria-selected="true">{{$service->service_name}}</button>
                         </li>
                         @endforeach

                     </ul>
                     <div class="tab-content" id="pills-tabContent">
                         @foreach ($services as $key=>$service)
                         <div class="tab-pane service-parent fade show {{ $loop->first ? 'active' : ''}}"
                             id="pills-straight-hair{{$key + 1}}" role="tabpanel"
                             aria-labelledby="pills-straight-hair-tab{{$key + 1}}">
                             <div class="d-flex justify-content-between align-items-center">

                                 <h1 class="d-inline service-title">{{$service->service_name}}</h1>

                                 <div>
                                     <span>Price</span>
                                     <span class="price-value">${{$service->price}}</span>
                                     <span class="person-quanitty">/person</span>
                                 </div>
                             </div>
                             <h3 class="text-secondary service-tagline">{{$service->s_description}}</h3>

                             <h5> Additional Information</h5>
                             <ul>
                                 <li class="service-features">Lorem ipsum dolor sit amet.</li>
                                 <li class="service-features">Lorem ipsum dolor sit amet.</li>
                                 <li class="service-features">Lorem ipsum dolor sit amet.</li>
                                 <li class="service-features">Lorem ipsum dolor sit amet.</li>
                                 <li class="service-features">Lorem ipsum dolor sit amet.</li>
                             </ul>
                             <a href="{{route('addtocart',[$service->id])}}" class="btn btn-outlined add-to-cart">Add to Cart</a>
                         </div>
                         @endforeach


                     </div>


                 </div>
                 <div class="col-lg-4 col-md-4 col-sm-4 col-4 div-color-3  ">
                     <div class="cart-item mt-2">
                        @php
                        $carts = cart();
                        $count_cart = count($carts);
                        @endphp
                        @if($count_cart != 0)
                         <h4 class="full-cart">Your Order List</h4>
                        @else
                         <h4 class="full-cart">Your order list is Empty</h4>
                        @endif
                         <div class="list-group cart-parent">
                            @foreach($carts as $cart)
                             <div class="list-group-item list-group-item-action" aria-current="true">
                                 <div class="d-flex w-100 justify-content-between">
                                     <h5 class="mb-1">{{$cart->options->subcat_name}}</h5>
                                     <span class="remove-btn">
                                         <a href="{{route('cartdelete',[$cart->rowId])}}">
                                             <i class="fa-solid fa-minus fa-sm"></i>
                                         </a>
                                     </span>
                                 </div>
                                 <p class="mb-1">{{$cart->name}}</p>
                                 <div class="d-flex justify-content-between align-items-center">
                                     <small class="quanity">
                                         <div class="input-group inline-group flex-nowrap">
                                             <div class="input-group-prepend">
                                                <form id="dec" action="{{route('updatecart_dec')}}" method="post">
                                                @csrf
                                                @method('PUT')
                                                    <input type="hidden" value="{{$cart->rowId}}" id="row_id" name="row_id">
                                                    <button class="btn-outline  custom-hover-1 btn-minus" >
                                                        <i class="fa fa-minus"></i>
                                                    </button>
                                                </form>
                                             </div>
                                             <input class="update_cart quantity-input mx-2" min="0" name="quantity" value="{{$cart->qty}}" type="number" id="test">

                                             <span class="service-counter px-3"></span>
                                             <div class="input-group-append">
                                                <form id="dec" action="{{route('updatecart_inc')}}" method="post">
                                                @csrf
                                                @method('PUT')
                                                    <input type="hidden" value="{{$cart->rowId}}" id="row_id" name="row_id">
                                                    <button class="btn-outline custom-hover-1 btn-plus">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </form>
                                             </div>
                                             /person
                                         </div>
                                     </small>
                                     <small> ${{$cart->subtotal}}</small>
                                 </div>
                             </div>
                             @endforeach

                         </div>
                     </div>
                     <div class="total-price text-end my-3">
                        <small>Total: <span>$ {{ Cart::subtotal() }}</span></small>
                     </div>
                     <a href="{{route('checkout')}}" type="button" class="btn btn-outlined checkout-btn {{$count_cart == 0 ? 'd-none' : ''}}">Checkout</a>
                 </div>
             </div>
         </div>
     </section>




 </div>

 @endsection


 @push('scripts')

<script>
    $(document).ready(function(){

        // $(".dec").on('submit',function(e){
        //     e.preventDefault();
        //     var row_id = $('#row_id').val();
        //     alert(row_id);

        //     $.ajax({
        //     type:'PUT',
        //     data:{row_id:title},
        //     success:function(data){
        //             if($.isEmptyObject(data.error)){
        //                 alert(data.success);
        //                 location.reload();
        //             }else{
        //                 printErrorMsg(data.error);
        //             }
        //         }
        //     });

        // });

        $(document).on('click', '.delete_cat',function(){
            var deleteId = $(this).val();
            $("#DeleteCatagory").modal('show');
            $('#del_cat_id').val(deleteId);
        });

    });
</script>
@endpush
