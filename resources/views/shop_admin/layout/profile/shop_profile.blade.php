@extends('shop_admin.shop_master')
@section('content')
<div class="d-flex justify-content-between align-items-center my-3">
    <h4>Shop Information</h4>
    <div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ProfileUpdate">Update Profile Information</button>
        <a href="{{route('shop_documents')}}" class="btn btn-primary">Documents</a>
    </div>
</div>
<div>
    <p>Shop Name: {{Auth::user()->shop_name}}</p>
    <p>Email: {{Auth::user()->email}}</p>
    <p>Phone Number: {{Auth::user()->phone}}</p>
    <p>Business Address: {{$business_address}}</p>
    <p>Corporate Address: {{$corporate_address}}</p>
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
                <form action="{{route('shop_edit_profile')}}" method="post" enctype="multipart/form-data">
                 @csrf
                 <input type="hidden" class="form-control" name="s_id" value="{{Auth::user()->id}}" id="sLegalName">
                    <!--Personal Information Update form   -->
                    <div class="row">
                        <div class="col-4">
                            <label for="uShopName" class="form-label">Shop Name</label>
                            <input type="text" class="form-control" name="u_shop_name" value="{{ old('u_shop_name',Auth::user()->shop_name)}}" id="uShopName">
                        </div>
                        <div class="col-4">
                            <label for="uShopEmail" class="form-label">Shop Email</label>
                            <input type="email" class="form-control" name="u_shop_email" value="{{ old('u_shop_email',Auth::user()->email)}}" id="uShopEmail">
                        </div>
                        <div class="col-4">
                            <label for="uShopPhone" class="form-label">Shop Phone</label>
                            <input type="tel" class="form-control" name="u_shop_phone" value="{{ old('u_shop_phone',Auth::user()->phone)}}" id="uShopPhone">
                        </div>
                        <div class="col-12">
                            <label for="sLegalName" class="form-label">Business Legal Name</label>
                            <input type="text" class="form-control" name="b_legal_name" value="{{ old('b_legal_name',$sp_info->b_legal_name)}}" id="sLegalName">
                        </div>
                        <div class="col-6">
                            <label for="image" class="form-label">Shop Image</label>
                            <input type="file" class="form-control" name="image" id="image">
                        </div>

                        <div class="col-12">
                            <label for="sBusinessDBA" class="form-label">Business DBA</label>
                            <input type="text" class="form-control" name="b_dba" value="{{ old('b_dba',$sp_info->b_dba)}}" id="sBusinessDBA">
                        </div>
                    </div>

                    <div class="d-flex flex-wrap justified-content-between gap-3 ">
                        <h5 class="">Business Address</h5>
                        <div class="address-type"></div>
                        <div class="row">
                            <div class="col-3">
                                <label for="s_street_number" class="form-label">Street Number</label>
                                <input type="number" class="form-control" name="street_number_b" value="{{ old('street_number_b',$sp_info->street_number_b)}}" id="s_street_number">
                            </div>
                            <div class="col-9">
                                <label for="s_street_name" class="form-label">Street Name</label>
                                <input type="text" class="form-control" name="street_name_b" value="{{ old('street_name_b',$sp_info->street_name_b)}}" id="s_street_name">
                            </div>

                            <div class="col-3">
                                <label for="s_apartment_no" class="form-label">Apt#</label>
                                <input type="text" class="form-control" name="apt_b" value="{{ old('apt_b',$sp_info->apt_b)}}" id="s_apartment_no">
                            </div>
                            <div class="col-3">
                                <label for="s_city" class="form-label">City</label>
                                <input type="text" class="form-control" name="city_b" value="{{ old('city_b',$sp_info->city_b)}}" id="s_city">
                            </div>
                            <div class="col-3">
                                <label for="s_state" class="form-label">State</label>
                                <input type="text" class="form-control" name="state_b" value="{{ old('state_b',$sp_info->state_b)}}" id="s_state">
                            </div>
                            <div class="col-3">
                                <label for="s_zip" class="form-label">Zip</label>
                                <input type="number" class="form-control" name="zip_b" value="{{ old('zip_b',$sp_info->zip_b)}}" id="s_zip">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap justified-content-between gap-3 ">
                        <h5 class="">Corporate Address</h5>
                        <div class="address-type"></div>
                        <div class="row">
                            <div class="col-3">
                                <label for="s_Corporate_street_number" class="form-label">Street Number</label>
                                <input type="number" class="form-control" name="street_number_c" value="{{ old('street_number_c',$sp_info->street_number_c)}}" id="s_Corporate_street_number">
                            </div>
                            <div class="col-9">
                                <label for="s_Corporate_street_name" class="form-label">Street Name</label>
                                <input type="text" class="form-control" name="street_name_c" value="{{ old('street_name_c',$sp_info->street_name_c)}}" id="s_Corporate_street_name">
                            </div>

                            <div class="col-3">
                                <label for="s_Corporate_apartment_no" class="form-label">Apt#</label>
                                <input type="text" class="form-control" name="apt_c" value="{{ old('apt_c',$sp_info->apt_c)}}" id="s_Corporate_apartment_no">
                            </div>
                            <div class="col-3">
                                <label for="s_Corporate_city" class="form-label">City</label>
                                <input type="text" class="form-control" name="city_c" value="{{ old('city_c',$sp_info->city_c)}}" id="s_Corporate_city">
                            </div>
                            <div class="col-3">
                                <label for="s_Corporate_state" class="form-label">State</label>
                                <input type="text" class="form-control" name="state_c" value="{{ old('state_c',$sp_info->state_c)}}" id="s_Corporate_state">
                            </div>
                            <div class="col-3">
                                <label for="s_Corporate_zip" class="form-label">Zip</label>
                                <input type="number" class="form-control" name="zip_c" value="{{ old('zip_c',$sp_info->zip_c)}}" id="s_Corporate_zip">
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
