@component('mail::message')
# Hello,

<p>Congratulations! Your order is confirmed successfully. We assigned services person for you.</p>

@component('mail::panel')
<p>Service Provider Information,</p>
<p style="margin-bottom:0px">Order: 1250</p>
<p style="margin-bottom:0px">Service Provider Name: Test</p>
<p style="margin-bottom:0px">Name: Mabalou Iniasta</p>
<p style="margin-bottom:0px">Phone: 01987563241</p>
<p style="margin-bottom:0px">Email: mabalou@gmail.com</p>
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
