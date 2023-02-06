
<nav class="navbar navbar-expand d-flex flex-column align-item-start p-0" id="sidebar">
    <!-- <a href="{{route('service_provider_index')}}" class="   text-dark text-decoration-none">
        <img class="logo mx-auto d-block" src="{{ asset('img/logo.png') }}" alt="">
    </a> -->
    <!-- <a href="#" class="navbar-brand text-dark mt-3">
        <h3 class="font-weight-bold">

        </h3>
    </a> -->
    <ul class="navbar-nav d-flex flex-column mt-3 w-100">
        <li class="nav-item w-100">
            <a href="{{route('admin_deshboard')}}" class="nav-link text-dark pl-4">Home</a>
        </li>
        <li class="nav-item w-100">
            <a href="{{route('revenue_shop')}}" class="nav-link text-dark pl-4">Shop Revenue</a>
        </li>
        <li class="nav-item w-100">
            <a href="{{route('revenue_individual')}}" class="nav-link text-dark pl-4">individual Revenue</a>
        </li>
        <li class="nav-item w-100">
            <a href="{{route('admin_verified_shop_list')}}" class="nav-link text-dark pl-4">Verified Shop List</a>
        </li>
        <li class="nav-item w-100">
            <a href="{{route('admin_unverified_shop_list')}}" class="nav-link text-dark pl-4">Unverified Shop List</a>
        </li>
        <li class="nav-item w-100">
            <a href="{{route('admin_verified_individual_list')}}" class="nav-link text-dark pl-4">Verified Individual List</a>
        </li>
        <li class="nav-item w-100">
            <a href="{{route('admin_unverified_individual_list')}}" class="nav-link text-dark pl-4">Unverified Individual List</a>
        </li>
    </ul>
</nav>
<div class="b-example-divider" id="sidebar_shade"></div>
