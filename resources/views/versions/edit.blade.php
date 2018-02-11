@component('layouts.create')
    @slot(
        'title',
        title_case(
            __('utility.existing', [
                'type' => trans_choice('version.choice', 1)
            ])
        )
    )

    @slot('action', 'update')
    @slot('route', route('endpoints.versions.index', $endpoint))

    @include('versions.partials.edit_form', [
        'url' => route('endpoints.versions.update', [$endpoint, $version]),
        'action' => 'update',
        'type' => 'existing',
        'model' => $version,
        'method' => 'PUT',
        'disabledResult' => true,
    ])
@endcomponent