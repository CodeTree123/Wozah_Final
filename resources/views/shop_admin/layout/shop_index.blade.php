@extends('shop_admin.shop_master')
@section('content')
  
    @if($sp_doc->doc_add_status == 0) 
        <div class="alert alert-danger" role="alert">
            Without Wozah Verification, your information will not show into the customer system. 
            <br>
            
            For this, First provide  profile information for your shop . Then add your documents .
            @if(Auth::user()->role_id == '2')
            <a href="{{route('shop_profile')}}" class="link-primary text-decoration-underline fw-bold">Click here to provide information</a>
            @else
            <a href="{{route('individual_profile')}}" class="link-primary text-decoration-underline fw-bold">Click here to provide information</a>
            @endif
        </div>
    @endif
    @if(Auth::user()->role_id == '2')
        <h1>Welcome to Shop Admin Panel</h1>
    @else
        @if(Auth::user()->role_id == '3' && Auth::user()->emp_status == '1')
        <h1>Welcome to Employee Panel</h1>
        @else
        <h1>Welcome to Individual Admin Panel</h1>
        @endif
    @endif
        
    
@endsection