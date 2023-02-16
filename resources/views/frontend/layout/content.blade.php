@extends('frontend.master')
@section('content')
<section>
            <div class="hero">
                <!-- <img class=" " src="{{ asset('img/banner.jpg ') }}" alt=""> -->
            </div>
        </section>
        <div class="container">
            <div class="px-4 py-5 my-5 text-center mx-auto ">
                <h1 class="display-5 fw-bold ">Making life easier</h1>
                <div class="col-lg-6 mx-auto">
                    <p class="lead mb-4 shadow p-3">
                        To become the world’s favorite at-home service provider, and to be the most customer-centric company in the world
                    </p>
                    <div class="d-grid gap-2 d-sm-flex justify-content-sm-center ">

                        <button type="button" class=" shadow border border-dark custom-border-radius-1 custom-hover-1  p-1 btn-lg px-4 gap-3"
                        data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop"
                        >Get Started</button>
                    </div>
                </div>
            </div>
        </div>
        <section class="  " data-aos="zoom-in-up">
            <div class="container">
                <h2 class="mb-3"> Popular Salon & Spa Centers </h2>
                <div class="row mt-5 align-items-center shadow">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-12 pb-5">
                        <img class="service align-center x  " src="{{ asset('img/service.jpg') }}" alt="">
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-12 col-12 ">
                        <div class="row align-middle shop_list">
                            @foreach($shops->chunk(2) as $shop)
                            <div class="col-lg-3 col-md-3 col-sm-3 col-3 pb-3 text-center">
                                @foreach($shop as $single_shop)
                                <a href="{{route('service_list',[$single_shop->id])}}">
                                    <!-- <p>{{$single_shop->u_id}}</p> -->
                                    <img class="sub-service mx-auto img-fluid border border-dark" src="{{ asset('uploads/shop/profile/'.$single_shop->image) }}" alt="">
                                    <span  class="shop-name">{{$single_shop->shop_name}}</span>
                                </a>
                                @endforeach
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @if($individuals->isNotEmpty())
        <section class="mt-5" data-aos="zoom-in-up">
            <div class="container">
                <h2 class="mb-3"> Our Individual Service Provider </h2>
                <div class="row mt-5 align-items-center shadow">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-12 pb-5">
                        <img class="service align-center x  " src="{{ asset('img/service.jpg') }}" alt="">
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-12 col-12 ">
                        <div class="row align-middle shop_list">
                            @foreach($individuals->chunk(2) as $individual)
                            <div class="col-lg-3 col-md-3 col-sm-3 col-3 pb-3 text-center">
                                @foreach($individual as $single_individual)
                                <a href="{{route('service_list',[$single_individual->id])}}">
                                    <p>{{$single_shop->u_id}}</p>
                                    <img class="sub-service mx-auto img-fluid border border-dark" src="{{ asset('img/service.jpg') }}" alt="">
                                    <span  class="shop-name">{{$single_individual->first_name}} {{$single_individual->last_name}}</span>
                                </a>
                                @endforeach
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif




        <section class="container-fluid pt-5 section-one">
            <h2 class="text-center">Happiness Guaranty</h2>
            <div
                class="  pt-5 d-flex justify-content-xxl-around justify-content-xl-around justify-content-lg-around justify-content-md-around justify-content-sm-around  justify-content-around mx-5 my-4">
                <div class="text-center four-box mr-2 p-2">
                    <i class="fa-solid fa-handshake  "></i>
                    <p>Expert Professionals</p>
                </div>
                <div class="text-center four-box mr-2 p-2">
                    <i class="fa-solid fa-user-shield"></i>
                    <p>Security</p>
                </div>
                <div class="text-center four-box mr-2 p-2">
                    <i class="fa-solid fa-people-carry-box"></i>
                    <p>Work Surety</p>
                </div>
                <div class="text-center four-box mr-2 p-2">
                    <i class="fa-solid fa-headset"></i>
                    <p>24/7 Customer Support</p>
                </div>
            </div>
        </section>
@endsection
