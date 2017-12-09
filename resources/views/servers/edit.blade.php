@extends('layouts.app')

@section(
    'title',
    title_case(
        __('utility.update', [
            'type' => trans_choice('soap_server.soap server', $server->count())
        ])
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
                                __('utility.update') . ' ' .
                                trans_choice(
                                    'soap_server.soap server',
                                    $server->count()
                                )
                            ) }}
                        </span>
                        <span class="pull-right">
                            <a href="{{ route('servers.index') }}" class="btn btn-primary btn-xs">
                                <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                            </a>
                        </span>
                    </div>

                    <div class="panel-body">
                        @include('servers.partials.form', [
                            'url' => route('servers.update', $server),
                            'model' => $server,
                            'method' => 'PUT'
                        ])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
