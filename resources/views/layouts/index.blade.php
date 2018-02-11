@extends('layouts.app')

@section('title', $title)

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="left">
                            {{ title_case(
                                __('utility.create') . ' ' .
                                $title
                            ) }}
                        </span>
                        <span class="pull-right">
                            <a href="{{ $route }}" class="btn btn-primary btn-xs">
                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                            </a>
                        </span>
                    </div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    @foreach($header as $item)
                                        <th>{{ title_case($item) }}</th>
                                    @endforeach
                                    @if ($showAction === true)
                                        <th>{{ title_case(__('utility.actions')) }}</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                {{ $slot }}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection