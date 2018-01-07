@component('mail::message')

    # {{ __('version.differece found') }}

    {!! $difference !!}

    @component('mail::button', ['url' => route('endpoints.versions.show', [$endpoint, $version])])
        View Order
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent