{{ Form::model($model, ['url' => $url, 'class' => 'form-horizontal', 'method' => $method ?? 'post']) }}
@include('form-components.text', [
    'name' => 'function',
    'label' => __('endpoint.function'),
])

@include('form-components.text', [
    'name' => 'name',
    'label' => __('general.name'),
])

@include('form-components.textarea', [
    'name' => 'data',
    'label' => __('general.data'),
])

<div class="form-group">
    <div class="col-sm-offset-1 col-sm-11">
        {{ Form::submit(
            __("utility.$action") . ' ' . __("utility.$type", [
                'type' => trans_choice('endpoint.choice', 1)
            ]),
            ['class' => 'btn btn-default'])
        }}
    </div>
</div>
{{ Form::close() }}
