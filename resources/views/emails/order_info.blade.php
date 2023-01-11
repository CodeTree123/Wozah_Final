@component('mail::message')
# Hello,

You have submitted the order succesfully.Shop owner will contact you soon.
<p>Order Informations:</p>
<p>Order Number : <span>{{$order_info['order_id']}}</span></p>
@component('mail::table')
<table style="text-align:center">
    <tr>
        <th>#</th>
        <th>Product Name</th>
        <th>Quantity</th>
        <th>Price</th>
    </tr>
    @foreach($order_info['carts'] as $key=>$cart)
    <tr>
        <td>{{intval($key) + 1}}</td>
        <td>{{$cart->name}}</td>
        <td>{{$cart->qty}}</td>
        <td>$ {{$cart->subtotal}}</td>
    </tr>
    @endforeach
    <tr>
        <td colspan="3">Total Cost</td>
        <td>$ {{$order_info['total']}}</td>
    </tr>
</table>
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
