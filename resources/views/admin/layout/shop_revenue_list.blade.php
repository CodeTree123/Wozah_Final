@extends('admin.admin_master')
@push('custom-link')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
@endpush
@section('content')
<table id="example" class="table table-striped-center" style="width:100%">
    <thead>
        <tr>
            <th>SL.</th>
            <th>Shop Name</th>
            <th>Services</th>
            <th>Customer Address</th>
            <th>Date</th>
            <th>Price</th>
            <th>Profit</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $key => $order)
        <tr>
            <td>{{$key+1}}</td>
            <td>{{$order->shop->shop_name}}</td>
            <td>
                <button class="btn view_order" value="{{$order->id}}">
                    <i class="fa-xl fa-solid fa-eye"></i>
                </button>
            </td>
            <td style="line-break: anywhere;">{{$order->address}}</td>
            <td>
                {{ Carbon\Carbon::parse($order->created_at)->format('d/m/Y ') }}
            </td>
            <td>{{$order->total_price}}</td>
            <td>{{($order->total_price*30)/100}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<!-- Modal for View Order -->
<div class="modal fade" id="ViewOrder" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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

@push('custom-scripts')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();

        $(document).on('click', '.view_order', function() {
            var order_id = $(this).val();
            // alert(order_id);
            $("#ViewOrder").modal('show');
            $.ajax({
                type: "GET",
                url: "/order_view/" + order_id,
                success: function(response) {
                    // console.log(response.order_info);
                    $("#order_info").html("");
                    $.each(response.order_info, function(i, item) {
                        $("#order_info").append('\
                        <tr>\
                            <td>' + item.service_name + '</td>\
                            <td>' + item.service_subcat + '</td>\
                            <td>' + item.order_quantity + '</td>\
                            <td>' + item.sub_total + '</td>\
                        </tr>\
                    ');
                    });

                    $("#total").html("");
                    $("#total").append('\
                    <tr>\
                        <td colspan="3" style="text-align:end">Total</td>\
                        <td >' + response.subtotal + '</td>\
                    </tr>\
                ');
                }
            });
        });
    });
</script>
@endpush

@endsection
