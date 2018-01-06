@component('layouts.create')
    @slot(
        'title',
        title_case(
            __('utility.existing', [
                'type' => trans_choice('endpoint.choice', 1)
            ])
        )
    )

    @slot('action', 'update')
    @slot('route', route('servers.endpoints.index', $server))

    @include('servers.endpoints.partials.form', [
        'url' => route('servers.endpoints.update', [$server, $endpoint]),
        'action' => 'update',
        'type' => 'existing',
        'model' => $endpoint,
        'method' => 'PUT',
    ])
@endcomponent