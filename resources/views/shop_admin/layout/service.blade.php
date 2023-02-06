@extends('shop_admin.shop_master')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Service</h1>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddService">
        Add Service
    </button>
</div>

<table class="table align-middle text-center">
    <thead>
        <tr>
            <th  scope="col">#</th>
            <th  scope="col">Service Name</th>
            <th  scope="col">Sub Catagory Name</th>
            <th  scope="col">Catagory Name</th>
            <th  scope="col">Description</th>
            <th  scope="col">Price</th>
            <th  scope="col">Status</th>
            <th  scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($services as $key=>$service)
        <tr>
            <th scope="row">{{$key + 1}}</th>
            <td>{{$service->service_name}}</td>
            <td>{{$service->subcatagory_name}}</td>
            <td>{{$service->catagory_name}}</td>
            <td>{{$service->s_description}}</td>
            <td>{{$service->price}}</td>
            <td>
                @if($service->s_status == 1)
                <p class=" btn btn-success mb-0">Active</p>
                @else
                <p class="btn btn-warning mb-0">Inactive</p>
                @endif
            </td>
            <td>
                <button class="btn update_service" value="{{$service->id}}">
                    <i class="fa-regular fa-lg fa-pen-to-square"></i>
                </button>
                <button class="btn delete_service" data-service-name="{{$service->service_name}}" value="{{$service->id}}">
                    <i class="fa-regular fa-lg fa-trash-can"></i>
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Modal for add service -->
<div class="modal fade" id="AddService" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Service</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('shop_service_add')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" class="form-control" name="u_id" value="{{ Auth::user()->id}}">
                    <input type="hidden" class="form-control" name="s_status" value="1">
                    <div class="mb-3">
                        <label for="catagory" class="form-label">Select Sub Catagory Name</label>
                        <select class="form-select" aria-label="Default select example" name="subcat_id" id="catagory">
                            @foreach($subcatagories as $subcatagory)
                            <option value="{{$subcatagory->id}}">{{$subcatagory->subcatagory_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="service" class="form-label">Service Name</label>
                        <input type="text" class="form-control" id="service" name="service_name" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="s_description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="s_description" name="s_description">
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="text" class="form-control" id="price" name="price">
                    </div>
                    <!-- <div class="mb-3">
                            <label for="formFile" class="form-label">Catagory Image</label>
                            <input class="form-control" type="file" id="formFile" name="catagory_image">
                        </div> -->
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal for update service -->
<div class="modal fade" id="UpdateService" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Update Service</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('shop_service_update')}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" class="form-control" name="shop_service_id" value="" id="shop_service_id">
                    <!-- <input type="text" class="form-control" name="c_status" value="1"> -->
                    <div class="mb-3">
                        <label for="sub_cat_id" class="form-label">Select Sub Catagory Name</label>
                        <select class="form-select" aria-label="Default select example" name="sub_cat_id" id="sub_cat_id" value="">
                            @foreach($subcatagories as $subcatagory)
                            <option value="{{$subcatagory->id}}">{{$subcatagory->subcatagory_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="u_service_name" class="form-label">Service Name</label>
                        <input type="text" class="form-control" id="u_service_name" name="u_service_name" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="u_s_description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="u_s_description" name="u_s_description">
                    </div>
                    <div class="mb-3">
                        <label for="u_price" class="form-label">Price</label>
                        <input type="text" class="form-control" id="u_price" name="u_price">
                    </div>
                    <!-- <div class="mb-3">
                            <label for="formFile" class="form-label">Catagory Image</label>
                            <input class="form-control" type="file" id="formFile" name="sub_catagory_image">
                        </div> -->
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal for delete service -->
<div class="modal fade" id="DeleteService" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Delete Service</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('shop_service_delete')}}" method="post">
                @csrf
                @method('delete')
                <div class="mb-3 text-center">
                    <h5 class="text-danger">Are You Sure to Delete This <span class="text-black" id="Service-Name"></span> Service?</h5>
                </div>
                <input type="hidden" class="form-control" id="del_serv_id" name="deletingId">
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
        $(document).on('click', '.update_service', function() {
            var update_id = $(this).val();
            $("#UpdateService").modal('show');
            $.ajax({
                type: "GET",
                url: "/shop/service/edit/" + update_id,
                success: function(response) {
                    // console.log(response.serv);
                    $('#shop_service_id').val(update_id);
                    $('#sub_cat_id').val(response.serv.subcatagory_id);
                    $('#u_service_name').val(response.serv.service_name);
                    $('#u_s_description').val(response.serv.s_description);
                    $('#u_price').val(response.serv.price);
                }
            });
        });

        $(document).on('click', '.delete_service', function() {
            var deleteId = $(this).val();
            var serviceName = $(this).attr("data-service-name");
            $("#DeleteService").modal('show');
            $('#del_serv_id').val(deleteId);
            $('#Service-Name').text(serviceName);
        });

    });
</script>
@endpush