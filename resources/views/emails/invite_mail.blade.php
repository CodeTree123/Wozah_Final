@component('mail::message')
# Hello {{$invite_info['invite_name']}}

You have a invitation from {{$invite_info['shop_name']}}. To registration, please click the Registration button below.

@component('mail::button', ['url' => '/individual_registration'])
Registration
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
