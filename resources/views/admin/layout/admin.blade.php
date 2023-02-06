@extends('admin.admin_master')
@section('content')
    <h1>Welcome to Admin Panel</h1>

    <p>{{Auth::user()->first_name}}</p>
    <p>{{Auth::user()->last_name}}</p>
    <p>{{Auth::user()->phone}}</p>
    <p>{{Auth::user()->email}}</p>
    <p>{{Auth::user()->role_id}}</p>
    
@endsection