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
                                <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                            </a>
                        </span>
                    </div>

                    <div class="panel-body">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection