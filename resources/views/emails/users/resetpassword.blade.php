<x-mail::message>
# We received a request to reset your password

Use the link below to set up a new password for your account.

    @component('mail::button', ['url' => url('/new-password').'?token='.$token])
        SET NEW PASSWORD
    @endcomponent

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
