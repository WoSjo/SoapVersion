@component('layouts.index')
    @slot(
        'title',
        title_case(
            trans_choice(
                'version.choice',
                $versions->count() === 0 ? 1 : 2
            ) . ' ' . __('version.for endpoint')
        )
    )

    @slot('showAction', true)
    @slot('route', route('endpoints.versions.create', $endpoint))
    @slot('actionRoute', 'endpoints.versions.edit')
    @slot('actionParameters', [$endpoint])

    @slot('header', [
        trans_choice('endpoint.choice', 1),
        trans_choice('version.choice', 1),
        __('version.compare'),
        __('version.result'),
    ])

    @slot('items', $versions)

    @forelse($versions as $version)
        <tr>
            <td>
                <a href="{{ route('servers.endpoints.edit', [$version->endpoint->server, $version->endpoint]) }}">{{ $version->endpoint->function }}</a>
            </td>
            <td>
                @if($version->version_id !== null)
                    <a href="{{ route('endpoints.versions.edit', [$endpoint, $version->version_id]) }}">{{ trans_choice('version.choice', 1) }} {{ $version->version_id }}</a>
                @endif
            </td>
            <td>{{ $version->compare === true ? __('utility.yes') : __('utility.no') }}</td>
            <td>{{ str_limit($version->endpoint_result, 50) }}</td>
            <td>
                <div class="button-group pull-right">
                    <a href="{{ route('endpoints.versions.show', [$endpoint, $version->id]) }}"
                       class="btn btn-primary" role="button">
                        <span class="glyphicon glyphicon-file" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('endpoints.versions.edit', [$endpoint, $version->id]) }}"
                       class="btn btn-primary" role="button">
                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                    </a>
                </div>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="4">{{ __('utility.no records found') }}</td>
        </tr>
    @endforelse

@endcomponent