@component('layouts.create')
    @slot(
        'title',
        title_case(
            __('utility.new record', [
                'type' => trans_choice('soap_server.soap server', 1)
            ])
        )
    )

    @slot('action', 'create')
    @slot('route', route('servers.index'))

    @include('servers.partials.form', [
        'url' => route('servers.store'),
        'action' => 'create',
        'type' => 'new',
        'model' => null
    ])
@endcomponent