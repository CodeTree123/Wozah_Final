<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{ asset('img/fav.png') }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Galada&family=Noto+Sans+Bengali:wght@300&family=Noto+Serif+Bengali:wght@100&family=Poppins:wght@500&family=Shippori+Antique+B1&display=swap" rel="stylesheet">

    <!-- Font Awsome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    @stack('custom-link')

    <!--Custom Style CSS for header -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Custom style CSS for Body -->
    <link rel="stylesheet" href="{{ asset('css/style_shop.css') }}">


    <title>US PROJECT </title>
</head>

<body>
    <div class="container-fluid container-parent">

        @include('admin.include.header')
        @include('admin.include.side_manu')
        <section class="my-container pt-0">
            <div class="ms-3">
                <button class="btn mt-2" id="menu-btn" style="padding: 5px 8px;">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
            <section class="p-4 pt-0">
                @yield('content')
            </section>
        </section>
        @include('include.message')
    </div>

    <div id="FullImageView">
        <img id="FullImage"/>
        <span id="FullViewClose">&times;</span>
    </div>


    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.min.js" integrity="sha384-5h4UG+6GOuV9qXh6HqOLwZMY4mnLPraeTrjT5v07o347pj6IkfuoASuGBhfDsp3d" crossorigin="anonymous"></script>
    <!-- custom js -->

    <!-- Script -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- JQuery Library -->
    <script src="{{ asset('js/jquery-library.js') }}"></script>

    <!-- Slick Slider JS -->
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- Custom JS -->
    <script src="{{ asset('js/script.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function() {
            window.setTimeout(function () {
                $(".test").alert('close');
            }, 2000);

            $("#menu-btn").click(function (){
                $("#sidebar").toggleClass("active-nav");
                $("#sidebar_shade").toggleClass("active-shadow");
                $(".my-container").toggleClass("active-cont");
            });

            $("#FullViewImgSrc").click(function (){
                var ImgLink = $(this).attr('src');
                alert(ImgLink);
                $("#FullImage").attr('src',ImgLink);
                $("#FullImageView").css("display","block");
            });

            $("#FullViewClose").click(function (){
                $("#FullImageView").css("display","none");
            });
        });
    </script>

    <script>    
    $(document).ready(function() {

        // $(window).on('load', function(){
        //     $(".cus_btn").trigger('click');
        // });
        let timer1, timer2;
        // $(".cus_btn").on("click", function(){
            $(".cus_toast").toggleClass("active");
            $(".progress").toggleClass("active");
            timer1 = setTimeout(() => {
                $(".cus_toast").removeClass("active");
            }, 3000); //1s = 1000 milliseconds

            timer2 = setTimeout(() => {
                $(".progress").removeClass("active");
            }, 3300);
        // });

        $(".close").on("click", function(){
            $(".cus_toast").removeClass("active");
            setTimeout(() => {
                $(".progress").removeClass("active");
            },300);

            clearTimeout(timer1);
            clearTimeout(timer2);

        });
      });
  </script>

    @stack('custom-scripts')

</body>


</html>
