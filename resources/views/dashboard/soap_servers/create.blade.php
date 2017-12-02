@extends('layouts.app')

@section(
    'title',
    title_case(
        __('utility.new record', [
            'type' => trans_choice('soap_server.soap server', 1)
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
                                __('utility.create') . ' ' .
                                trans_choice(
                                    'soap_server.soap server',
                                    $translationChoice
                                )
                            ) }}
                        </span>
                        <span class="pull-right">
                            <a href="{{ route('soap-servers.index') }}" class="btn btn-primary btn-xs">
                                <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                            </a>
                        </span>
                    </div>

                    <div class="panel-body">
                        @include('dashboard.soap_servers.partials.form', [
                            'url' => route('soap-servers.store'),
                            'model' => null
                        ])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

