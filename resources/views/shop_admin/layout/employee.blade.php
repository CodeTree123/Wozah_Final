@extends('shop_admin.shop_master')

@push('custom-link')
@endpush

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Employee</h1>
    <!-- Button trigger modal -->
    <div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddEmployee">
            Add Employee
        </button>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#InviteEmployee">
            Invite
        </button>
    </div>
</div>

<table class="table align-middle">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Employee Name</th>
            <th scope="col">Employee Phone</th>
            <th scope="col">Employee Email</th>
            <th scope="col">Joining Date</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($sp_employees as $key=>$sp_emp)
        <tr>
            <td>{{$key + 1}}</td>
            <td>{{$sp_emp->first_name}} {{$sp_emp->last_name}}</td>
            <td>{{$sp_emp->phone}}</td>
            <td>{{$sp_emp->email}}</td>
            <td>{{ Carbon\Carbon::parse($sp_emp->join_date)->format('d/m/Y') }}</td>
            <td>
                @if($sp_emp->work_status == 1)
                <span class="badge text-bg-light"> On Work</span>
                
                @else
                <span class="badge bg-primary">Available</span>
                
                 
                @endif
            </td>
            <td>
                <button class="btn update_emp" value="{{$sp_emp->id}}">
                <i class="fa-regular fa-lg fa-pen-to-square"></i>   

                </button>
                <!-- <button class="btn delete_cat" data-cat-name="{{$sp_emp->catagory_name}}" value="{{$sp_emp->id}}">delete</button> -->
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


<!-- Modal for add employee -->
<div class="modal fade" id="AddEmployee" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('sp_employee_add')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" class="form-control" name="u_id" value="{{ Auth::user()->id}}">
{{--                    <div class="mb-3">--}}
{{--                        <label for="emp_id" class="form-label">Select Employee</label>--}}
{{--                        <select class="form-select" aria-label="Default select example" name="emp_id" id="emp_id">--}}
{{--                            @foreach($employees as $emp)--}}
{{--                            <option value="{{$emp->id}}">{{$emp->first_name}} {{$emp->last_name}} - {{$emp->phone}}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}
                    <div class="">
                        <label for="emp_email" class="form-label">Select Employee</label>
                        <input type="text" class="form-control" id="emp_email" name="emp_email" autocomplete="off">
                    </div>
                    <ul id="product_list" class="list-group" style="position: fixed; z-index: 1; width: 24%"></ul>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal for invite employee -->
<div class="modal fade" id="InviteEmployee" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Invite Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('sp_employee_invite')}}" method="post">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="shop_id" value="{{auth()->user()->id}}">
                    <div class="">
                        <label for="emp_email" class="form-label">Enter Email For Invitation</label>
                        <input type="email" class="form-control" id="emp_email" name="invite_email">
                    </div>
                    <div class="">
                        <label for="emp_name" class="form-label">Enter Name</label>
                        <input type="text" class="form-control" id="emp_name" name="invite_name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Send</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal for update catagory -->
<div class="modal fade" id="UpdateEmployee" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Update Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('shop_catagory_update')}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" class="form-control" name="sp_catagory_id" value="" id="sp_catagory_id">
                    <!-- <input type="text" class="form-control" name="c_status" value="1"> -->
                    <div class="mb-3">
                        <label for="catagory_name" class="form-label">Catagory Name</label>
                        <input type="text" class="form-control" id="catagory_name" name="catagory_name"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="cat_description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="cat_description" name="description">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal for delete catagory -->
<div class="modal fade" id="DeleteCatagory" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Delete Catagory</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('shop_catagory_delete')}}" method="post">
                @csrf
                @method('delete')
                <div class="mb-3 text-center">
                    <h5 class="text-danger">Are You Sure to Delete This <span id="Cat-Name" class="text-black"></span>
                        Catagory?</h5>
                </div>
                <input type="hidden" class="form-control" id="del_cat_id" name="deletingId">
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Yes,Delete</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection


@push('custom-scripts')
<script>
$(document).ready(function() {

    $('#emp_email').on('keyup',function () {
        var query = $(this).val();
        $.ajax({
            url:'{{ route('autocomplete_emp') }}',
            type:'GET',
            data:{'name':query},
            success:function (response) {
                // $('#product_list').html(data);
                $("#product_list").html("");

                if (response.email != ''){
                    $.each(response.email, function (i,item){
                        $("#product_list").append('\
                                <li class="list-group-item" style="cursor:pointer">'+item.email+'</li>\
                        ');
                    });
                }else{
                    $("#product_list").append('\
                            <li class="list-group-item" style="cursor:pointer">No data Found</li>\
                    ');
                }
            }
        })
    });
    $(document).on('click', 'li', function(){
        var value = $(this).text();
        $('#emp_email').val(value);
        $('#product_list').html("");
    });

    $(document).on('click', '.update_emp', function() {
        var update_id = $(this).val();
        // $("#UpdateEmployee").modal('show');
        // $.ajax({
        //     type: "GET",
        //     url: "/shop/catagory/edit/" + update_id,
        //     success: function(response) {
        //         // console.log(response.cat);
        //         $('#sp_catagory_id').val(update_id);
        //         $('#catagory_name').val(response.cat.catagory_name);
        //         $('#cat_description').val(response.cat.c_description);
        //     }
        // });
    });

    $(document).on('click', '.delete_cat', function() {
        // var deleteId = $(this).val();
        // var dataCatName = $(this).attr("data-cat-name");
        // $("#DeleteCatagory").modal('show');
        // $('#del_cat_id').val(deleteId);
        // $('#Cat-Name').text(dataCatName);
    });

});
</script>
@endpush
