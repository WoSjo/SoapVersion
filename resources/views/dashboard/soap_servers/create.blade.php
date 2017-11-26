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

@endsection

