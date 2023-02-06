@extends('admin.admin_master')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Shop List</h1>
        <!-- Button trigger modal -->
        <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddCatagory">
        Add Catagory
        </button> -->
    </div>

    <table class="table align-middle">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">User Name</th>
            <th scope="col">Email</th>
            <th scope="col">Phone</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($shops as $key=>$shop)
            <tr>
                <td>{{$key + 1}}</td>
                <td>{{$shop->shop_name}}</td>
                <td>{{$shop->email}}</td>
                <td>{{$shop->phone}}</td>
                <td>
                    @if($shop->user_status == '0')
                    pending
                    @else
                    Verified
                    @endif
                </td>
                <td>
                    <a href="{{route('admin_shop_details',$shop->id)}}" class="btn">
                        View Details
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

@endsection


@push('custom-scripts')
<script>
    $(document).ready(function(){

    });
</script>
@endpush
