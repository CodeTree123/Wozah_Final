@extends('shop_admin.shop_master')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Catagory</h1>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddCatagory">
        Add Catagory
        </button>
    </div>

    <table class="table align-middle text-center">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Catagory Name</th>
{{--      <th scope="col">Catagory Image</th>--}}
      <th scope="col">Description</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($catagories as $key=>$cat)
    <tr>
      <th scope="row">{{$key + 1}}</th>
      <td>{{$cat->catagory_name}}</td>
      <td>{{$cat->c_description}}</td>
      <td>
        @if($cat->c_status == 1)
            <p class=" btn btn-success mb-0">Active</p>
        @else
            <p class="btn btn-warning mb-0">Inactive</p>
        @endif
      </td>
      <td>
        <button class="btn update_cat" value="{{$cat->id}}">
        <i class="fa-regular fa-lg fa-pen-to-square"></i>   
        </button>
        <button class="btn delete_cat" data-cat-name="{{$cat->catagory_name}}" value="{{$cat->id}}">
        <i class="fa-regular fa-lg fa-trash-can"></i>  
    </button>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>


<!-- Modal for add catagory -->
<div class="modal fade" id="AddCatagory" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Catagory</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('shop_catagory_add')}}" method="post" enctype="multipart/form-data">
             @csrf
                <div class="modal-body">
                    <input type="hidden" class="form-control" name="u_id" value="{{ Auth::user()->id}}">
                    <input type="hidden" class="form-control" name="c_status" value="1">
                    <div class="mb-3">
                        <label for="catagory" class="form-label">Catagory Name</label>
                        <input type="text" class="form-control" id="catagory" name="catagory_name" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="c_description" name="description">
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
<div class="modal fade" id="UpdateCatagory" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Update Catagory</h5>
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
                        <input type="text" class="form-control" id="catagory_name" name="catagory_name" aria-describedby="emailHelp">
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
<div class="modal fade" id="DeleteCatagory" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                    <h5 class="text-danger">Are You Sure to Delete This <span id="Cat-Name" class="text-black"></span> Catagory?</h5>
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
    $(document).ready(function(){
        $(document).on('click', '.update_cat',function(){
            var update_id = $(this).val();
            $("#UpdateCatagory").modal('show');
            $.ajax({
                    type:"GET",
                    url: "/shop/catagory/edit/"+update_id,
                    success: function(response){
                        // console.log(response.cat);
                        $('#sp_catagory_id').val(update_id);
                        $('#catagory_name').val(response.cat.catagory_name);
                        $('#cat_description').val(response.cat.c_description);
                    }
                });
        });

        $(document).on('click', '.delete_cat',function(){
            var deleteId = $(this).val();
            var dataCatName = $(this).attr("data-cat-name");
            $("#DeleteCatagory").modal('show');
            $('#del_cat_id').val(deleteId);
            $('#Cat-Name').text(dataCatName);
        });

    });
</script>
@endpush
