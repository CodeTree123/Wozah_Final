@extends('shop_admin.shop_master')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Sub Catagory</h1>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddSubCatagory">
        Add Sub Catagory
    </button>
</div>

<table class="table align-middle text-center">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Sub Catagory Name</th>
            <th scope="col">Catagory Name</th>
            <th scope="col">Image</th>
            <th scope="col">Description</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($subcatagories as $key=>$subcat)
        <tr>
            <th scope="row">{{$key + 1}}</th>
            <td>{{$subcat->subcatagory_name}}</td>
            <td>{{$subcat->catagory_name}}</td>
            <td>
                @if($subcat->sc_image == null)
                <img src="{{ asset('img/service.jpg')}}" class="shop_image_view">
                @else
                <img src="{{asset('/uploads/shop/sub_catagory/'.$subcat->sc_image)}}" class="shop_image_view" id="FullViewImgSrc">
                @endif
            </td>
            <td>{{$subcat->sc_description}}</td>
            <td>
                @if($subcat->sc_status == 1)
                <p class=" btn btn-success mb-0">Active</p>

                @else
                <p class="btn btn-warning mb-0">Inactive</p>
                @endif
            </td>
            <td>
                <button class="btn update_subcat" value="{{$subcat->id}}">
                    <i class="fa-regular fa-lg fa-pen-to-square"></i>
                </button>
                <button class="btn delete_subcat" data-subcat-name="{{$subcat->subcatagory_name}}" value="{{$subcat->id}}">
                    <i class="fa-regular fa-lg fa-trash-can"></i>
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Modal for add sub catagory -->
<div class="modal fade" id="AddSubCatagory" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Sub Catagory</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('shop_sub_catagory_add')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" class="form-control" name="u_id" value="{{ Auth::user()->id}}">
                    <input type="hidden" class="form-control" name="sc_status" value="1">
                    <div class="mb-3">
                        <label for="catagory" class="form-label">Select Catagory Name</label>
                        <select class="form-select" aria-label="Default select example" name="cat_id" id="catagory">
                            @foreach($catagories as $catagory)
                            <option value="{{$catagory->id}}">{{$catagory->catagory_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="catagory" class="form-label">Sub Catagory Name</label>
                        <input type="text" class="form-control" id="catagory" name="subcatagory_name" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="sc_description" name="description">
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Catagory Image</label>
                        <input class="form-control" type="file" id="formFile" name="sub_catagory_image">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal for update catagory -->
<div class="modal fade" id="UpdateSubCatagory" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Update Sub Catagory</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('shop_sub_catagory_update')}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" class="form-control" name="shop_subcatagory_id" value="" id="shop_subcatagory_id">
                    <!-- <input type="text" class="form-control" name="c_status" value="1"> -->
                    <div class="mb-3">
                        <label for="catagory" class="form-label">Select Catagory Name</label>
                        <select class="form-select" aria-label="Default select example" name="cat_id" id="U_catagory" value="">
                            @foreach($catagories as $catagory)
                            <option value="{{$catagory->id}}">{{$catagory->catagory_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="catagory_name" class="form-label">Sub Catagory Name</label>
                        <input type="text" class="form-control" id="u_subcatagory_name" name="subcatagory_name" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="u_subcat_description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="u_subcat_description" name="description">
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <label for="formFile" class="form-label">Sub Catagory Image</label>
                            <input class="form-control" type="file" id="formFile" name="sub_catagory_image">
                        </div>
                        <div class="col-4">
                            <label for="subcat_image">Previous Image</label>
                            <div id="subcat_image" class="mt-2">

                            </div>
                        </div>
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
<div class="modal fade" id="DeleteSubCatagory" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Delete Sub Catagory</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('shop_sub_catagory_delete')}}" method="post">
                @csrf
                @method('delete')
                <div class="mb-3 text-center">
                    <h5 class="text-danger">Are You Sure to Delete This <span class="text-black" id="SubCat-Name"></span> Sub Catagory?</h5>
                </div>
                <input type="hidden" class="form-control" id="del_subcat_id" name="deletingId">
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
        $(document).on('click', '.update_subcat', function() {
            var update_id = $(this).val();
            $("#UpdateSubCatagory").modal('show');
            $.ajax({
                type: "GET",
                url: "/shop/sub_catagory/edit/" + update_id,
                success: function(response) {
                    // console.log(response.subcat);
                    $('#shop_subcatagory_id').val(update_id);
                    $('#U_catagory').val(response.subcat.catagory_id);
                    $('#u_subcatagory_name').val(response.subcat.subcatagory_name);
                    $('#u_subcat_description').val(response.subcat.sc_description);
                    $('#subcat_image').html("");
                    $('#subcat_image').append('\
                            <img src="/uploads/shop/sub_catagory/' + response.subcat.sc_image + ' "class="shop_image_view" id="FullViewImgSrc">\
                        ')
                }
            });
        });

        $(document).on('click', '.delete_subcat', function() {
            var deleteId = $(this).val();
            var dataSubCatName = $(this).attr("data-subcat-name");
            $("#DeleteSubCatagory").modal('show');
            $('#del_subcat_id').val(deleteId);
            $('#SubCat-Name').text(dataSubCatName);
        });

    });
</script>
@endpush