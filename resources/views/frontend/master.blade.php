<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{ asset('img/wozah-color-icon.png') }}">

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

    <!--Custom Style CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!--Slick Slider Style CSS -->
    <link rel="stylesheet" href="{{ asset('css/slick.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('css/slick-theme.css') }}">  -->
    <!--AOS Animation Style CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    @stack('custom-link')



    <title>WOZAH </title>
</head>

<body>
    <div class="container-fluid container-parent">

         @include('frontend.include.header')

         @yield('content')

         @include('frontend.include.footer')
         @include('include.message')
    </div>

    <!-- JQuery Library -->
    <script src="{{ asset('js/jquery-library.js') }}"></script>

    <!-- Script -->
    <script src="{{ asset('js/app.js') }}" defer></script>


    <!-- Slick Slider JS -->
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- Custom JS -->
    <script src="{{ asset('js/script.js') }}"></script>

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

    @stack('scripts')

</body>


</html>
