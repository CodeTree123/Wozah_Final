 @extends('frontend.master')
 @section('content')
 <title>US PROJECT-Service_List</title>
 <div class="container-flush">
     <section class="section-products">
         <div class="container">
             <div class="row  ">
                 <div class="col-md-8 col-lg-6">
                     <div class="header">
                         <div class="shop-summary">
                             <div class="shop-name">
                                 <h2 class="d-inline ">
                                     <!-- Vista Salon & Spa -->
                                     @if($shop_info->shop_name != null)
                                        {{$shop_info->shop_name}}
                                     @else
                                        {{$shop_info->first_name}} {{$shop_info->last_name}}
                                     @endif
                                 </h2>
                                 <span class="shop-rating-field">
                                     <i class="fa-solid fa-star "></i>
                                     <span class="shop-rating"> 4.5/5</span>
                                 </span>
                             </div>
                             <div class="shop-time">
                                 <span>
                                     Tues-Sat <br> 09:00am-11:00pm
                                 </span>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             @foreach ($catagories as $cat)
             <div class="row mb-4">
                 <h4>{{$cat->catagory_name}}</h4>
                 <hr>
                 <!-- Single Product -->
                 @foreach ($subcatagories as $subcat)
                 @if($cat->id == $subcat->catagory_id)
                 <div class="col-md-6 col-lg-4 col-xl-3 service-card mb-1 ">
                     <a href="{{route('service_detail',[$shop_info->u_id,$subcat->id])}}">
                         <div class="sub_cat_container rounded">
                             <div class="sub_cat_img_container">
                                 <img src="{{asset('uploads/shop/sub_catagory/'.$subcat->sc_image)}}" alt="Avatar" class="sub_cat_image rounded-top img-fluid">
                                 <!-- <img src="{{ asset('img/service_page/hair_service/designer_haircut.png') }}" alt="Avatar" class="sub_cat_image rounded-top img-fluid" > -->
                             </div>
                             <div class="sub_cat_middle">
                                 <div class="sub_cat_text">
                                     <span class=" overlay_icon ">Check Details </span>
                                 </div>
                             </div>
                             <span class="sub_cat_text_badge  my-3">New</span>
                             <div class="sub_cat_bottom   d-flex justify-content-between align-items-center mt-3 mb-3">
                                 <p class="sub_cat_bottom_title m-0">{{$subcat->subcatagory_name}}</p>
                                 <i class="fa-solid fa-arrow-right fa-xl"></i>
                             </div>
                         </div>
                     </a>
                 </div>
                 @endif
                 @endforeach
             </div>
             @endforeach
         </div>
     </section>
 </div>
 @endsection