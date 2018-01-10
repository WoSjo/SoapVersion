@component('mail::message')

# {{ $headerText }}.

@if ($viewButton)
    @component('mail::button', ['url' => route('endpoints.versions.show', [$endpoint, $version])])
        {{ __('utility.view') }} {{ trans_choice('version.choice', 1) }}
    @endcomponent
@endif

{!! $difference !!}
<br>
Thanks,<br>
{{ config('app.name') }}
@endcomponent