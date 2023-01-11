    <!-- Footer Section -->
    <div class="footer-container ">
        <footer class="py-5 text-white container-fluid">
            <div class="row text-center d-flex flex-wrap">
                <div class="col-lg-2 col-md-2 col-sm-12 col-12   ">
                    <h5>Section</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-white">Home</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-white">Home</a></li>
                        <li class="nav-item mb-2">
                            <a href="{{route('contact_us')}}" class="nav-link p-0 text-white">
                                Contact Us
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="{{route('faq')}}" class="nav-link p-0 text-white">
                                FAQs
                            </a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="{{route('about_us')}}" class="nav-link p-0 text-white">
                                About US
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12 col-12 offset-1  ">
                    <form>
                        <h5>Subscribe to our newsletter</h5>
                        <p>Monthly digest of whats new and exciting from us.</p>
                        <div class="d-flex  ">
                            <label for="newsletter1" class="visually-hidden">Email address</label>
                            <input id="newsletter1" type="text" class="form-control" placeholder="Email address">
                            <button class="btn btn-primary" type="button">Subscribe</button>
                        </div>
                    </form>
                </div>


                <div class="col-lg-4 col-md-4 col-sm-12 col-12 offset-1">
                    <div class="  app-download d-flex  ">
                        <div class="row">
                            <div class=" border-bottom mb-2"> Download Our App</div>

                            <div class="col">
                                <a href="#" class=" ">
                                    <img class=" " src="{{ asset('img/andro_download_white_bg.png') }}" alt="">
                                </a>
                            </div>

                            <div class="col">
                                <a href="#" class=" ">
                                    <img class=" " src="{{ asset('img/app_store_download_white_bg.png') }}" alt="">
                                </a>
                            </div>
                            <div class="d-flex justify-content-center ">
                                <ul class="list-unstyled d-flex justify-content-start    mt-2">
                                    <h6>Follow Us - </h6>
                                    <li class="ms-3"><a class="link-white text-white" href="#">
                                            <i class="fa-brands fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li class="ms-3"><a class="link-white text-white" href="#">
                                            <i class="fab fa-instagram"></i>
                                        </a></li>
                                    <li class="ms-3"><a class="link-white text-white" href="#">
                                            <i class="fa-brands fa-facebook-f"></i>
                                        </a></li>
                                </ul>
                            </div>
                        </div>

                           
                    </div>
                </div>


            </div>
    </div>

    </footer>
    <div class="d-flex bg-dark justify-content-center    border-top text-white ">
        <p>&copy; Developed by CODETREE</p>
        <p></p>
    </div>