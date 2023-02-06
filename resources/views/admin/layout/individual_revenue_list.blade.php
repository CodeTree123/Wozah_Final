@extends('admin.admin_master')
@push('custom-link')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
@endpush
@section('content')
        <table id="example" class="table table-striped " style="width:100%">
            <thead>
                <tr>
                    <th>SL.</th>
                    <th>Customer name</th>
                    <th>Customer Address</th>
                    <th>Services</th>
                    <th>Date</th>
                    <th>Price</th>
                    <th>Profit</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $key => $order)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$order->user->first_name}} {{$order->user->last_name}}</td>
                    <td style="line-break: anywhere;">{{$order->address}}</td>
                    <td>
                        <button class="btn view_order" value="{{$order->id}}">
                            <i class="fa-xl fa-solid fa-eye"></i>
                        </button>
                    </td>
                    <td>
                        {{ Carbon\Carbon::parse($order->created_at)->format('d/m/Y ') }}
                    </td>
                    <td>{{$order->total_price}}</td>
                    <td>{{($order->total_price*30)/100}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
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
