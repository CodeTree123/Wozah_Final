@extends('frontend.master')
@push('custom-link')
<script src="https://cdn.plaid.com/link/v2/stable/link-initialize.js"></script>
@vite(['resources/css/app.css', 'resources/js/app.js'])
@endpush
@section('content')
<div class="container my-4">
    <h4 class="my-4">My Order List</h4>
    <div class="wishlist-table table-content table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="product-price text-center alt-font">Order No.</th>
                    <th class="stock-status text-center alt-font">Ordered Quantity</th>
                    <th class="stock-status text-center alt-font">Order From</th>
                    <th class="stock-status text-center alt-font">Assign To</th>
                    <th class="stock-status text-center alt-font">Order Status</th>
                    <th class="product-subtotal text-center alt-font">Details</th>
                    <th class="product-subtotal text-center alt-font">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td class="product-price text-center"><span class="amount">{{$order->id}}</span></td>
                    <td class="product-price text-center"><span class="amount">{{$order->total_items}}</span></td>
                    <td class="product-price text-center"><span class="amount">
                        @if ($order->assign_emp_id != null)
                        Shop
                        @else
                        Individual
                        @endif
                    </span></td>
                    <td class="product-price text-center"><span class="amount">
                        @if ($order->assign_emp_id != 0)
                        {{$order->shop_forntend_emp_name->first_name}} {{$order->shop_forntend_emp_name->last_name}}
                        @else
                        Individual
                        @endif
                    </span></td>
                    <td class="stock text-center">
                        @if($order->order_status == 0)
                        <span class="">Peinding</span>
                        @elseif($order->order_status == 1)
                        <span class="">Accepted</span>
                        @else
                        <span class="">Completed</span>
                        @endif
                    </td>
                    <td class="product-subtotal text-center">
                        <button type="button" class="btn btn-primary btn-small view_order" value="{{$order->id}}">View</button>
                    </td>
                    @if($order->order_status == 0)
                    <td class="product-subtotal text-center">
                        <button type="button" class="btn  btn-secondary btn-small delete_order" value="{{$order->id}}">Cancel</button>
                    </td>
                    @elseif($order->order_status == 1)
                    <td class="product-subtotal text-center">
                        <button type="button" class="btn  btn-secondary btn-small delete_order" disabled>Cancel</button>
                    </td>
                    @elseif($order->order_status == 2)
                    <td class="product-subtotal text-center">
                        <button type="button" class="btn  btn-danger btn-small link-account" >Pay Now</button>
                    </td>
                    @else
                    <td class="product-subtotal text-center">
                        <button type="button" class="btn  btn-success btn-small ">Paid</button>
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal for view Order -->
<div class="modal fade" id="viewOrder" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">View Order <span id="order_no"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table text-center align-middle">
                    <thead>
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Image</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Sub Total</th>
                        </tr>
                    </thead>
                    <tbody id="view">


                    </tbody>
                    <tfoot id="total">

                    </tfoot>
                </table>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div> -->
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function linkPlaidAccount(linkToken) {
    var linkHandler = Plaid.create({
        token: linkToken,
        onSuccess: function(public_token, metadata) {
            var body = {
                public_token: public_token,
                accounts: metadata.accounts,
                institution: metadata.institution,
                link_session_id: metadata.link_session_id,
                link_token: linkToken
            };
            $.ajax({
                url: "/storePlaidAccount",
                type: "POST",
                data: body,
                success: function(data) {
                    getInvestmentHoldings(data.item_id);
                },
                error: function(err) {
                    console.error("Error linking Plaid account: ", err.responseJSON.error);
                }
            });
        },
        onExit: function(err, metadata) {
            console.error("Error linking Plaid account: ", err);
            linkHandler.destroy();
            if (metadata.link_session_id == null && metadata.status == "requires_credentials") {
                createLinkToken();
            }
        }
    });
    linkHandler.open();
}

    $(document).on('click', '.view_order', function() {
        var order_id = $(this).val();
        $("#viewOrder").modal('show');
        $("#order_no").text(order_id);
        // $.ajax({
        //         type:"GET",
        //         url: "/admin/product/order/view/"+order_id,
        //         success: function(response){
        //             console.log(response.order);

        //             $("#view").html("");
        //             $.each(response.order, function (i,item){

        //                 $("#view").append('\
        //                     <tr>\
        //                         <td>'+item.product_name+'</td>\
        //                         <td><img src="/uploads/product/'+item.image+'" class="shop_image_view"></td>\
        //                         <td>'+item.order_quantity+'</td>\
        //                         <td>'+item.sub_total+'</td>\
        //                     </tr>\
        //                 ');
        //             });
        //             $("#total").html("");
        //             $("#total").append('\
        //                 <tr>\
        //                     <td colspan="4" style="text-align:end">Sub Total</td>\
        //                     <td >'+response.subtotal+'</td>\
        //                 </tr>\
        //                 <tr>\
        //                     <td colspan="4" style="text-align:end">Vat</td>\
        //                     <td >'+response.vat+'</td>\
        //                 </tr>\
        //                 <tr>\
        //                     <td colspan="4" style="text-align:end">Total</td>\
        //                     <td >'+response.order_total+'</td>\
        //                 </tr>\
        //             ');

        //         }
        //     });
    });
</script>
@endpush
