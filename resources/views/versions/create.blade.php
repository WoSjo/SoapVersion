@component('layouts.create')
    @slot(
        'title',
        title_case(
            __('utility.new record', [
                'type' => trans_choice('version.choice', 1)
            ])
        )
    )

    @slot('action', 'create')
    @slot('route', route('endpoints.versions.index', $endpoint))

    @include('versions.partials.create_form', [
        'url' => route('endpoints.versions.store', $endpoint),
        'action' => 'create',
        'type' => 'new',
        'model' => null,
        'selected' => $endpoint->id,
    ])
@endcomponent