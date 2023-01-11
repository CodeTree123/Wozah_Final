@extends('shop_admin.shop_master')
@section('content')
<div class="d-flex justify-content-between align-items-center my-3">
    <h4>My Profile Information</h4>
    <a href="{{route('individual_profile')}}" class="btn btn-primary">Back to Profile</a>
</div>
<div class="my-3">
    <!--Shop Contact Information Table -->
    <table class="table ">
        <h5>Contact Information</h5>
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Contact Information Type</th>
                <th scope="col">Contact Information</th>
                <th scope="col">Verification Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Email</td>
                <td>{{ Auth::user()->email}}</td>
                <td>
                    @if(Auth::user()->email_verified_at == null)
                    <h4> <span class="badge bg-warning"></span>Not Verified</h4>
                    @else
                    <h4> <span class="badge bg-success">Verified</span> </h4>
                    @endif
                </td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Phone Number</td>
                <td>{{ Auth::user()->phone}}</td>
                <td>
                    @if(Auth::user()->email_verified_at == null)
                    <h4> <span class="badge bg-warning"></span>Not Verified</h4>
                    @else
                    <h4> <span class="badge bg-success">Verified</span> </h4>
                    @endif
                </td>
            </tr>
        </tbody>
    </table>
    <!--Shop Contact Information Table End-->

    <!-- Shop Document Information Table -->
    <form method="POST" action="{{route('individul_add_documents')}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="user_id" value="{{Auth::user()->id}}" id="">
        <table class="table align-middle text-center">
            <h5 class="mt-5">Document Information</h5>
            <thead>
                <tr>
                    <th scope="col" width="5%">#</th>
                    <th scope="col" width="35%">Document Type</th>
                    <th scope="col" width="35%">Document</th>
                    <th scope="col" width="25%">Verification Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Driver’s License</td>
                    <td>
                        @if($sp_doc->i_driver_license == null)
                        <div class="d-flex flex-column">
                            <input type="file" name="i_driver_license" id="">
                            <span class="text-danger">@error('i_driver_license') {{$message}} @enderror</span>
                        </div>
                        @else
                            <a href="{{asset('uploads/SP_document/'.$sp_doc->i_driver_license)}}" class="btn btn-primary" target="_blank">View</a>
                            @if($sp_doc->driver_license_status == 0)
                            <span class="btn btn-primary doc_update" data-doc_id="{{$sp_doc->id}}" data-docType-name="i_driver_license">Update</span>
                            @endif
                        @endif
                    </td>
                    <td>
                        @if($sp_doc->i_driver_license_status == 0)
                        <h4> <span class="badge bg-warning text-dark">Verification Pending</span></h4>
                        @else
                        <h4> <span class="badge bg-success ">Verification Done</span></h4>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="row mb-0">
            <div class="col-md-6 offset-md-4">
                @if($sp_doc->doc_add_status == 0) 
                <button type="submit" class="btn btn-primary">
                    {{ __('Submit') }}
                </button>
                @endif
            </div>
        </div>
    </form>
    <!-- Shop Document Information Table End-->
</div>

<!-- Modal for Update Doc File -->
    <div class="modal fade" id="UpdateDoc" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Update/Replace Document</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('individual_update_documents')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="u_doc_id" name="u_doc_id" value="">
                    <input type="hidden" id="u_doctype_name" name="u_doctype_name" value="">
                    <div class="m-3">
                        <input class="form-control" type="file" id="updateformFile" name="updateformFile">
                    </div>
                    
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
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
        $(document).on('click','.doc_update',function(){
            var doc_id = $(this).attr('data-doc_id');
            var doc_type = $(this).attr('data-docType-name');
            $('#UpdateDoc').modal('show');
            $('#u_doc_id').val(doc_id);
            $('#u_doctype_name').val(doc_type);
        });
    });
</script>
@endpush