@extends('shop_admin.shop_master')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Today's Work List</h1>
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
                <button class="btn view_order" value="{{$order->id}}">
                    <i class="fa-xl fa-solid fa-eye"></i>
                </button>
            </td>
            <td>
                @if($order->order_status != 2)
                <a href="{{route('sp_employee_assigned_work_status',$order->id)}}" type="button" class="btn btn-success work_done" value="{{$order->id}}">
                    <i class="fa-lg fa-solid fa-check"></i>
                </a>
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
                        <!-- <th scope="col">Sub Total</th> -->
                    </tr>
                    </thead>
                    <tbody id="order_info">
                        
                    </tbody>
                    <!-- <tfoot id="total">
                        
                    </tfoot> -->
                </table>
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
                // $("#total").html("");
                // $("#total").append('\
                //     <tr>\
                //         <td colspan="3" style="text-align:end">Total</td>\
                //         <td >'+response.subtotal+'</td>\
                //     </tr>\
                // ');
            }
        });
    });

});
</script>
@endpush