@component('layouts.create')
    @slot(
        'title',
        title_case(
            __('utility.new record', [
                'type' => trans_choice('endpoint.choice', 1)
            ])
        )
    )

    @slot('route', route('servers.endpoints.index', $server))

    @include('servers.endpoints.partials.form', [
        'url' => route('servers.endpoints.store', $server),
        'action' => 'create',
        'type' => 'new',
        'model' => null
    ])
@endcomponent