@extends('shop_admin.shop_master')
@section('content')
<div class="d-flex justify-content-between align-items-center my-3">
    <h4>Shop Information</h4>
    <a href="{{route('shop_profile')}}" class="btn btn-primary">Back to Profile</a>
</div>
<div class="my-3">
    <!--Shop Contact Information Table -->
    <table class="table ">
        <h5>Shop Contact Information</h5>
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
    <form method="POST" action="{{route('shop_add_documents')}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="user_id" value="{{Auth::user()->id}}" id="">
        @if(Auth::user()->role_id == '2')
        <table class="table align-middle text-center">
            <h5 class="mt-5">Shop Document Information</h5>
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
                    <td>Business EIN</td>
                    <td>
                        @if($sp_doc->b_ein == null)
                        <div class="d-flex flex-column">
                            <input type="file" name="b_ein" id="">
                            <span class="text-danger">@error('b_ein') {{$message}} @enderror</span>
                        </div>
                        @else
                            <a href="{{asset('uploads/SP_document/'.$sp_doc->b_ein)}}" class="btn btn-primary" target="_blank">View</a>
                            @if($sp_doc->b_ein_status == 0)
                            <span class="btn btn-primary doc_update" data-doc_id="{{$sp_doc->id}}" data-docType-name="b_ein">Update</span>
                            @endif
                        @endif
                    </td>
                    <td>
                        @if($sp_doc->b_ein_status == 0)
                        <h4> <span class="badge bg-warning text-dark">Verification Pending</span></h4>
                        @else
                        <h4> <span class="badge bg-success text-white">Verification Done</span></h4>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Business Certificate of Authority</td>
                    <td>
                        @if($sp_doc->b_certificate == null)
                        <div class="d-flex flex-column">
                            <input type="file" name="b_certificate" id="">
                            <span class="text-danger">@error('b_certificate') {{$message}} @enderror</span>
                        </div>
                        @else
                        <a href="{{asset('uploads/SP_document/'.$sp_doc->b_certificate)}}" class="btn btn-primary" target="_blank">View</a>
                            @if($sp_doc->b_certificate_status == 0)
                            <span class="btn btn-primary doc_update" data-doc_id="{{$sp_doc->id}}" data-docType-name="b_certificate">Update</span>
                            @endif
                        @endif
                    </td>
                    <td>
                        @if($sp_doc->b_certificate_status == 0)
                        <h4> <span class="badge bg-warning text-dark">Verification Pending</span></h4>
                        @else
                        <h4> <span class="badge bg-success text-white">Verification Done</span></h4>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Business Registration</td>
                    <td>
                        @if($sp_doc->b_registration == null) 
                        <div class="d-flex flex-column">
                            <input type="file" name="b_registration" id="">
                            <span class="text-danger">@error('b_registration') {{$message}} @enderror</span>
                        </div>
                            @else
                        <a href="{{asset('uploads/SP_document/'.$sp_doc->b_registration)}}" class="btn btn-primary" target="_blank">View</a>
                            @if($sp_doc->b_registration_status == 0)
                            <span class="btn btn-primary doc_update" data-doc_id="{{$sp_doc->id}}" data-docType-name="b_registration">Update</span>
                            @endif
                        @endif
                    </td>
                        <td>
                        @if($sp_doc->b_registration_status == 0)
                        <h4> <span class="badge bg-warning text-dark">Verification Pending</span></h4>
                        @else
                        <h4> <span class="badge bg-success text-white">Verification Done</span></h4>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th scope="row">4</th>
                    <td>Nail Salon – Valid License necessary to Operate and Manage</td>
                    <td>
                        @if($sp_doc->nail_salon == null) 
                        <div class="d-flex flex-column"> 
                            <input type="file" name="nail_salon" id="">
                            <span class="text-danger">@error('nail_salon') {{$message}} @enderror</span>
                        </div>
                        @else
                        <a href="{{asset('uploads/SP_document/'.$sp_doc->nail_salon)}}" class="btn btn-primary" target="_blank">View</a>
                            @if($sp_doc->nail_salon_status == 0)
                            <span class="btn btn-primary doc_update" data-doc_id="{{$sp_doc->id}}" data-docType-name="nail_salon">Update</span>
                            @endif
                        @endif
                    </td>
                        <td>
                        @if($sp_doc->nail_salon_status == 0)
                        <h4> <span class="badge bg-warning text-dark">Verification Pending</span></h4>
                        @else
                        <h4> <span class="badge bg-success text-white">Verification Done</span></h4>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th scope="row">5</th>
                    <td>Employee Certification</td>
                    <td>
                        @if($sp_doc->e_certificate == null)
                        <div class="d-flex flex-column">
                            <input type="file" name="e_certificate" id="">
                            <span class="text-danger">@error('e_certificate') {{$message}} @enderror</span>
                        </div>
                        @else
                            <a href="{{asset('uploads/SP_document/'.$sp_doc->e_certificate)}}" class="btn btn-primary" target="_blank">View</a>
                            @if($sp_doc->e_certificate_status == 0)
                            <span class="btn btn-primary doc_update" data-doc_id="{{$sp_doc->id}}" data-docType-name="e_certificate">Update</span>
                            @endif
                        @endif
                    </td>
                        <td>
                        @if($sp_doc->e_certificate_status == 0)
                        <h4> <span class="badge bg-warning text-dark">Verification Pending</span></h4>
                        @else
                        <h4> <span class="badge bg-success text-white">Verification Done</span></h4>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th scope="row">6</th>
                    <td>Business Insurance</td>
                    <td>
                        @if($sp_doc->b_insurance == null)
                        <div class="d-flex flex-column">   
                            <input type="file" name="b_insurance" id="">
                            <span class="text-danger">@error('b_insurance') {{$message}} @enderror</span>
                        </div>
                        @else
                            <a href="{{asset('uploads/SP_document/'.$sp_doc->b_insurance)}}" class="btn btn-primary" target="_blank">View</a>
                            @if($sp_doc->b_insurance_status == 0)
                            <span class="btn btn-primary doc_update" data-doc_id="{{$sp_doc->id}}" data-docType-name="b_insurance">Update</span>
                            @endif
                        @endif
                    </td>
                    <td>
                        @if($sp_doc->b_insurance_status == 0)
                        <h4> <span class="badge bg-warning text-dark">Verification Pending</span></h4>
                        @else
                        <h4> <span class="badge bg-success text-white">Verification Done</span></h4>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th scope="row">7</th>
                    <td>Business Workers Comp</td>
                    <td>
                        @if($sp_doc->b_workers == null) 
                        <div class="d-flex flex-column">   
                            <input type="file" name="b_workers" id="">
                            <span class="text-danger">@error('b_workers') {{$message}} @enderror</span>
                        </div>
                        @else
                            <a href="{{asset('uploads/SP_document/'.$sp_doc->b_workers)}}" class="btn btn-primary" target="_blank">View</a>
                            @if($sp_doc->b_workers_status == 0)
                            <span class="btn btn-primary doc_update" data-doc_id="{{$sp_doc->id}}" data-docType-name="b_workers">Update</span>
                            @endif
                        @endif
                    </td>
                    <td>
                        @if($sp_doc->b_workers_status == 0)
                        <h4> <span class="badge bg-warning text-dark">Verification Pending</span></h4>
                        @else
                        <h4> <span class="badge bg-success text-white">Verification Done</span></h4>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th scope="row">8</th>
                    <td>Owners Valid Driver’s License</td>
                    <td>
                        @if($sp_doc->driver_license == null)
                        <div class="d-flex flex-column">
                            <input type="file" name="driver_license" id="">
                            <span class="text-danger">@error('driver_license') {{$message}} @enderror</span>
                        </div>
                        @else
                            <a href="{{asset('uploads/SP_document/'.$sp_doc->driver_license)}}" class="btn btn-primary" target="_blank">View</a>
                            @if($sp_doc->driver_license_status == 0)
                            <span class="btn btn-primary doc_update" data-doc_id="{{$sp_doc->id}}" data-docType-name="driver_license">Update</span>
                            @endif
                        @endif
                    </td>
                    <td>
                        @if($sp_doc->driver_license_status == 0)
                        <h4> <span class="badge bg-warning text-dark">Verification Pending</span></h4>
                        @else
                        <h4> <span class="badge bg-success text-white">Verification Done</span></h4>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
        @endif
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
                <form action="{{route('shop_update_documents')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="u_doc_id" name="u_doc_id" value="">
                    <input type="hidden" id="u_doctype_name" name="u_doctype_name" value="">
                    <div class="mb-3">
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