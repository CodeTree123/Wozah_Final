@component('mail::message')
# Hello,

<p>Order(1250) is assigned to you.</p>

@component('mail::panel')
<p>Customer Information,</p>
<p style="margin-bottom:0px">Name: Sajjat Iniasta</p>
<p style="margin-bottom:0px">Phone: 32165311</p>
<p style="margin-bottom:0px">Email: sajjat@gmail.com</p>
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
