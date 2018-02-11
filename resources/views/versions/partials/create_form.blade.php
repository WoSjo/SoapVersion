{{ Form::model($model, ['url' => $url, 'class' => 'form-horizontal', 'method' => $method ?? 'post']) }}
@include('form-components.select', [
    'name' => 'endpoint_id',
    'label' => trans_choice('endpoint.choice', 1),
    'items' => $endpoints,
    'selected' => $selected ?? null
])

<div class="form-group">
    <div class="col-sm-offset-1 col-sm-11">
        {{ Form::submit(
            __("utility.$action") . ' ' . __("utility.$type", [
                'type' => trans_choice('version.choice', 1)
            ]),
            ['class' => 'btn btn-default'])
        }}
    </div>
</div>
{{ Form::close() }}
