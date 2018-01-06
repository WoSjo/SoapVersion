@component('layouts.create')
    @slot(
        'title',
        title_case(
            __('utility.existing', [
                'type' => trans_choice('soap_server.soap server', $server->count())
            ])
        )
    )

    @slot('action', 'update')
    @slot('route', route('servers.index'))

    @include('servers.partials.form', [
        'url' => route('servers.update', $server),
        'action' => 'update',
        'type' => 'existing',
        'model' => $server,
        'method' => 'PUT'
    ])
@endcomponent
