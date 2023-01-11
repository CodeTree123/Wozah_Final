@extends('admin.admin_master')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Individual List</h1>
        <!-- Button trigger modal -->
        <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddCatagory">
        Add Catagory
        </button> -->
    </div>

    <table class="table align-middle text-center">
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
            @foreach ($individuals as $key=>$individual)
            <tr>
                <td>{{$key + 1}}</td>
                <td>{{$individual->first_name}} {{$individual->last_name}}</td>
                <td>{{$individual->email}}</td>
                <td>{{$individual->phone}}</td>
                <td>
                    @if($individual->user_status == '0')
                      <p class=" btn btn-warning mb-0">Pending</p>

                    
                    @else
                        <p class=" btn btn-success mb-0">Verified</p> 
                    
                    @endif
                </td>
                <td>
                    <a href="{{route('admin_individual_details',$individual->id)}}" class="btn">
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
