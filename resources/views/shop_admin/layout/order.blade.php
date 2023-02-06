@extends('shop_admin.shop_master')

@push('custom-link')
<!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->
@endpush

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Order</h1>
    <!-- Button trigger modal -->
    <div>
    </div>
</div>

<table class="table align-middle text-center">
    <thead>

        <tr>
            <th scope="col" width="1%">#</th>
            <th scope="col" width="12.5%">Name</th>
            <th scope="col" width="12.5%">Contact</th>
            <th scope="col" width="12.5%">Address</th>
            <th scope="col" width="12.5%">Requested At</th>
            <th scope="col" width="12.5%">Status</th>
            <th scope="col" width="12.5%">Services</th>
            <th scope="col" width="12.5%">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $key => $order)
        <tr>
            <td>{{$key + 1}}</td>
            <td>{{$order->first_name}} {{$order->last_name}}</td>
            <td>{{$order->email}}<br/>{{$order->phone}}</td>
            <td>{{$order->address}}</td>
            <td>
                {{ Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}
            </td>
            <td>
                @if($order->order_status == '3')
                    <p class="text-success mb-0">Completed</p>
                @elseif($order->order_status == '2')
                    <p class="text-success mb-0">Finished</p>
                @elseif($order->order_status == '1')
                    <p class="text-success mb-0">Accepted</p>
                @else
                    <p class="text-danger mb-0">Pending</p>
                @endif
            </td>
            <td>
                <button class="btn view_order" value="{{$order->id}}">
                    <i class="fa-xl fa-solid fa-eye"></i>
                </button>
            </td>
            <td>
                @if($order->order_status == '0')
                    @if(auth()->user()->role_id == 3 && auth()->user()->emp_status == 0)
                    <a href="{{route('individual_confirm_order',$order->id)}}" type="button" class="btn btn-success" >
                        <i class="fa-lg fa-solid fa-check"></i>
                    </a>
                    @else
                    <button type="button" class="btn btn-success confirm_order" value="{{$order->id}}">
                        <i class="fa-lg fa-solid fa-check"></i>
                    </button>
                    @endif
                <button type="button" class="btn btn-danger cancel_order" value="{{$order->id}}">
                    <i class="fa-lg fa-solid fa-xmark"></i>
                </button>
                @elseif($order->order_status == '1')
                    @if(auth()->user()->role_id == 3 && auth()->user()->emp_status == 0)
                        <a href="{{route('sp_employee_assigned_work_status',$order->id)}}" type="button" class="btn btn-success" value="{{$order->id}}">
                            <i class="fa-lg fa-solid fa-check-double"></i>
                        </a>
                    @else
                    <button type="button" class="btn btn-success assign_emp" value="{{$order->assign_emp_id}}">Assigned</button>
                    @endif
                @elseif($order->order_status == '2')
                <button class="btn btn-danger">Not Paid</button>
                @else
                <button class="btn btn-danger">Paid</button>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Modal for View Order -->
<div class="modal fade" id="ViewOrder" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Order Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="">
                <table class="table text-center align-middle">
                    <thead>
                    <tr>
                        <th scope="col">Service Name</th>
                        <th scope="col">Service Catagory</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Sub Total</th>
                    </tr>
                    </thead>
                    <tbody id="order_info">

                    </tbody>
                    <tfoot id="total">

                    </tfoot>
                </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal for Cancel Order Modal -->
<div class="modal fade" id="CancelOrder" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Cancel Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('cancel_order')}}" method="post">
                @csrf
                <div class="modal-body">
                    <input type="text" id="cancel_order_id" name="order_id" value="">
                    <div class="col-12 mb-3">
                        <p>Are you sure you want to cancel the order?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Confirm</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal for Confirm Order Modal -->
<div class="modal fade" id="ConfirmOrder" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Confirm Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('confirm_order')}}" method="post">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="order_id" name="order_id" value="">
                    <div class="col-12 mb-3">
                        <label for="employee_for_order" class="form-label">Select Employee</label>
                        <select class="form-control custom-form-control multi" name="employee_for_order" aria-label="Default select example" style="width:100%;" id="employee_for_order">
                            @foreach($sp_emps as $sp_emp)
                            <option value="{{$sp_emp->id}}">{{$sp_emp->first_name}} {{$sp_emp->last_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Confirm</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal for Assigned Employee Info Modal -->
<div class="modal fade" id="AssignEmp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Assigned Employee Info</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="assigned_view">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>




@endsection


@push('custom-scripts')
<!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->

<script>

$(document).ready(function() {
    $(document).on('click', '.view_order', function() {
        var order_id = $(this).val();
        // alert(order_id);
        $("#ViewOrder").modal('show');
        $.ajax({
            type: "GET",
            url: "/service_provider/order_view/" + order_id,
            success: function(response) {
                // console.log(response.order_info);
                $("#order_info").html("");
                $.each(response.order_info, function (i,item){
                    $("#order_info").append('\
                        <tr>\
                            <td>'+item.service_name+'</td>\
                            <td>'+item.service_subcat+'</td>\
                            <td>'+item.order_quantity+'</td>\
                            <td>'+item.sub_total+'</td>\
                        </tr>\
                    ');
                });

                $("#total").html("");
                $("#total").append('\
                    <tr>\
                        <td colspan="3" style="text-align:end">Total</td>\
                        <td >'+response.subtotal+'</td>\
                    </tr>\
                ');
            }
        });
    });

    $(document).on('click', '.confirm_order', function() {
        var orderID = $(this).val();
        $("#ConfirmOrder").modal('show');
        $('#order_id').val(orderID);
    });

    $(document).on('click', '.cancel_order', function() {
        var orderID = $(this).val();
        $("#CancelOrder").modal('show');
        $('#cancel_order_id').val(orderID);
    });

    $(document).on('click', '.assign_emp', function() {
        var assignedID = $(this).val();
        $("#AssignEmp").modal('show');
        $.ajax({
            type: "GET",
            url: "/service_provider/assigned_info/"+assignedID,
            success: function (response) {
                $("#assigned_view").html("");
                $("#assigned_view").append('\
                    <p>Name: <span>'+response.emp_info.first_name+' '+response.emp_info.last_name+'</span></p>\
                    <p>Email: <span>'+response.emp_info.email+'</span></p>\
                    <p>Phone: <span>'+response.emp_info.phone+'</span></p>\
                ');
            }
        });
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
