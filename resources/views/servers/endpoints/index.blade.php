@extends('layouts.app')

@section('title',
    title_case(
        trans_choice(
            'endpoint.choice',
            $endpoints->count() === 0 ? 1 : 2
        ) . ' ' . __('endpoint.for server')
    )
)

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="left">
                            {{ title_case(
                                trans_choice(
                                    'endpoint.choice',
                                    $endpoints->count()
                                ) . ' ' . __('endpoint.for server')
                            ) }}
                        </span>
                        <span class="pull-right">
                            <a href="{{ route('servers.endpoints.create', $server) }}" class="btn btn-primary btn-xs">
                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                            </a>
                        </span>
                    </div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>{{ title_case(__('endpoint.function')) }}</th>
                                    <th>{{ title_case(__('general.name')) }}</th>
                                    <th>{{ title_case(__('general.data')) }}</th>
                                    <th>{{ title_case(__('utility.actions')) }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($endpoints as $endpoint)
                                    <tr>
                                        <td>{{ $endpoint->function }}</td>
                                        <td>{{ $endpoint->name }}</td>
                                        <td>{{ $endpoint->data }}</td>
                                        <td>
                                            <div class="button-group pull-right">
                                                <a href="{{ route('servers.endpoints.edit', [$server, $endpoint]) }}"
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
