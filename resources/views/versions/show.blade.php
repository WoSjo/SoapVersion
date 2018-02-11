@extends('layouts.app')

@section(
    'title',
    title_case(
        trans_choice(
            'version.choice',
            1
        ) . ' ' . __('version.for endpoint')
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
                                __('utility.view') . ' ' .
                                trans_choice('version.choice', 1)
                            ) }} {{ $version->id }}
                        </span>
                        <span class="pull-right">
                            <a href="{{ route('endpoints.versions.index', $endpoint) }}" class="btn btn-primary btn-xs">
                                <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                            </a>
                        </span>
                    </div>
                    <div class="panel-body">
                        @if ($hasDifferences)
                            {!! $diffRenderer !!}
                        @else
                            <p>{{ ucfirst(__('version.no differences have been found')) }}.</p>
                            <p>
                                <a href="{{ route('endpoints.versions.index', $endpoint) }}">{{ title_case(__('utility.go back')) }}</a>.
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

