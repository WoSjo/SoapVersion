@extends('layouts.app')

@section('title',
    title_case(
        trans_choice(
            'soap_server.soap server',
            $servers->count() === 0 ? 1 : 2
        ) . ' ' . __('soap_server.for account')
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
                                    'soap_server.soap server',
                                    $servers->count()
                                ) . ' ' . __('soap_server.for account')
                            ) }}
                        </span>
                        <span class="pull-right">
                            <a href="{{ route('soap.servers.create') }}" class="btn btn-primary btn-xs">
                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                            </a>
                        </span>
                    </div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>{{ title_case(__('soap_server.name')) }}</th>
                                    <th>{{ title_case(__('soap_server.slug')) }}</th>
                                    <th>{{ title_case(__('soap_server.host')) }}</th>
                                    <th>{{ title_case(__('soap_server.port')) }}</th>
                                    <th>{{ title_case(__('utility.actions')) }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($servers as $server)
                                    <tr>
                                        <td>{{ $server->name }}</td>
                                        <td>{{ $server->slug }}</td>
                                        <td>{{ $server->host }}</td>
                                        <td>{{ $server->port }}</td>
                                        <td>
                                            <a href="{{ route('soap.servers.edit', $server) }}"
                                               class="btn btn-primary pull-right" role="button">
                                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">{{ __('utility.no records found') }}</td>
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