@extends('shop_admin.shop_master')
@section('content')
<div class="d-flex justify-content-between align-items-center my-3">
    <h4>My Profile Information</h4>
    <div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ProfileUpdate">Update Profile Information</button>
        <a href="{{route('individual_documents')}}" class="btn btn-primary">Documents</a>
    </div>
</div>
<div>
    <p>Name: {{Auth::user()->first_name}} {{Auth::user()->last_name}}</p>
    <p>Email: {{Auth::user()->email}}</p>
    <p>Phone Number: {{Auth::user()->phone}}</p>
    <p>Address: {{$i_address}}</p>
    @if(Auth::user()->user_status == '0')
        <p>Wozah Verification Status: <span class="text-danger">Not Verified</span></p>
    @else
        <p>Wozah Verification Status: <span class="text-success">Verified</span></p>
    @endif
</div>

<!-- Modal for Profile Update -->
<div class="modal fade" id="ProfileUpdate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Profile Update</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('individual_profile_update')}}" method="post">
                 @csrf
                 @method('PUT')
                 <input type="hidden" class="form-control" name="i_id" value="{{$individual_info->id}}" id="sLegalName">
                    <!--Personal Information Update form   -->
                    <div class="row">
                        <div class="col-4">
                            <label for="uFirstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" name="u_first_name" value="{{ old('u_first_name',Auth::user()->first_name)}}" id="uFirstName">
                        </div>
                        <div class="col-4">
                            <label for="uLastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" name="u_last_name" value="{{ old('u_last_name',Auth::user()->last_name)}}" id="uLastName">
                        </div>
                        
                        <div class="col-4">
                            <label for="uShopPhone" class="form-label">Phone</label>
                            <input type="tel" class="form-control" name="u_shop_phone" value="{{ old('u_shop_phone',Auth::user()->phone)}}" id="uShopPhone">
                        </div>
                        <div class="col-12">
                            <label for="uShopEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" name="u_shop_email" value="{{ old('u_shop_email',Auth::user()->email)}}" id="uShopEmail">
                        </div>
                        <div class="col-12">
                            <label for="sLegalName" class="form-label">Profile Picture</label>
                            <input type="file" class="form-control" name="" id="sLegalName">
                        </div>
                    </div>

                    <div class="d-flex flex-wrap justified-content-between gap-3 ">
                        <h5 class="">Address</h5>
                        <div class="address-type"></div>
                        <div class="row">
                            <div class="col-3">
                                <label for="s_street_number" class="form-label">Street Number</label>
                                <input type="number" class="form-control" name="i_street_number" value="{{ old('i_street_number',$individual_info->i_street_number)}}" id="s_street_number">
                            </div>
                            <div class="col-9">
                                <label for="s_street_name" class="form-label">Street Name</label>
                                <input type="text" class="form-control" name="i_street_name" value="{{ old('i_street_name',$individual_info->i_street_name)}}" id="s_street_name">
                            </div>

                            <div class="col-3">
                                <label for="s_apartment_no" class="form-label">Apt#</label>
                                <input type="text" class="form-control" name="i_apt" value="{{ old('i_apt',$individual_info->i_apt)}}" id="s_apartment_no">
                            </div>
                            <div class="col-3">
                                <label for="s_city" class="form-label">City</label>
                                <input type="text" class="form-control" name="i_city" value="{{ old('i_city',$individual_info->i_city)}}" id="s_city">
                            </div>
                            <div class="col-3">
                                <label for="s_state" class="form-label">State</label>
                                <input type="text" class="form-control" name="i_state" value="{{ old('i_state',$individual_info->i_state)}}" id="s_state">
                            </div>
                            <div class="col-3">
                                <label for="s_zip" class="form-label">Zip</label>
                                <input type="number" class="form-control" name="i_zip" value="{{ old('i_zip',$individual_info->i_zip)}}" id="s_zip">
                            </div>
                        </div>
                    </div>
                    <!--Personal Information  form end  -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Send</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection