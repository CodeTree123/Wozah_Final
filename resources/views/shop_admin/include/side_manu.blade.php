
<nav class="navbar navbar-expand d-flex flex-column align-item-start p-0" id="sidebar">
    <!-- <a href="{{route('service_provider_index')}}" class="   text-dark text-decoration-none">
        <img class="logo mx-auto d-block" src="{{ asset('img/logo.png') }}" alt="">
    </a> -->
    <a href="#" class="navbar-brand text-dark mt-3">
        <h3 class="font-weight-bold">
            @if(Auth::user()->role_id == 2)
                {{Auth::user()->shop_name}}
            @else
                {{Auth::user()->first_name}} {{Auth::user()->last_name}}
            @endif
        </h3>
    </a>
    <ul class="navbar-nav d-flex flex-column mt-3 w-100">
        <li class="nav-item w-100">
            <a href="{{route('service_provider_index')}}" class="nav-link text-dark pl-4">Home</a>
        </li>
        @if(Auth::user()->emp_status != 1)
        <li class="nav-item w-100">
            <a href="{{route('shop_catagory')}}" class="nav-link text-dark pl-4">Catagory</a>
        </li>
        <li class="nav-item w-100">
            <a href="{{route('shop_sub_catagory')}}" class="nav-link text-dark pl-4">Sub Catagory</a>
        </li>
        <li class="nav-item w-100">
            <a href="{{route('shop_service')}}" class="nav-link text-dark pl-4">Service</a>
        </li>
        @if(Auth::user()->role_id == '2')
        <li class="nav-item w-100">
            <a href="{{route('sp_employee')}}" class="nav-link text-dark pl-4">Employee</a>
        </li>
        {{--        <li class="nav-item w-100">--}}
        {{--            <a class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">--}}
        {{--              Employee--}}
        {{--            </a>--}}
        {{--            <div class="collapse " id="collapseExample">--}}
        {{--                  <a href="{{route('sp_employee')}}" class="nav-link text-dark pl-4">Employee List</a>--}}
        {{--            </div>--}}
        {{--            <div class="collapse " id="collapseExample">--}}
        {{--                  <a href="#" class="nav-link text-dark pl-4">Invite Employee</a>--}}
        {{--            </div>--}}
        {{--        </li>--}}
        @endif
        <li class="nav-item w-100">
            <a href="{{route('sp_order')}}" class="nav-link text-dark pl-4">Order</a>
        </li>
        @else
        <li class="nav-item w-100">
            <a href="{{route('sp_employee_assigned_work')}}" class="nav-link text-dark pl-4">Assigned Work</a>
        </li>
        @endif
    </ul>
</nav>
<div class="b-example-divider" id="sidebar_shade"></div>
