{{ Form::model($model, ['url' => $url, 'class' => 'form-horizontal', 'method' => $method ?? 'post']) }}
@include('form-components.checkbox', [
    'name' => 'compare',
    'label' => __('version.compare'),
])

@include('form-components.textarea', [
    'name' => 'endpoint_result',
    'label' => __('version.result'),
    'disabled' => (isset($disabledResult) && $disabledResult) === true ? 'disabled' : ''
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
