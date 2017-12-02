@inject('form', 'Collective\Html\FormBuilder')

{{ $form->model($model, ['url' => $url, 'class' => 'form-horizontal', 'method' => $method ?? 'post']) }}
@include('form-components.text', [
    'type' => 'text',
    'name' => 'name',
    'labelValue' => __('soap_server.name'),
    'labelClasses' => 'col-sm-1 control-label',
    'divClasses' => 'col-sm-11',
    'inputClasses' => 'form-control'
])

@include('form-components.text', [
    'type' => 'text',
    'name' => 'slug',
    'labelValue' => __('soap_server.slug'),
    'labelClasses' => 'col-sm-1 control-label',
    'divClasses' => 'col-sm-11',
    'inputClasses' => 'form-control'
])

@include('form-components.text', [
    'type' => 'text',
    'name' => 'host',
    'labelValue' => __('soap_server.host'),
    'labelClasses' => 'col-sm-1 control-label',
    'divClasses' => 'col-sm-11',
    'inputClasses' => 'form-control'
])

@include('form-components.text', [
    'type' => 'text',
    'name' => 'port',
    'labelValue' => __('soap_server.port'),
    'labelClasses' => 'col-sm-1 control-label',
    'divClasses' => 'col-sm-11',
    'inputClasses' => 'form-control'
])

<div class="form-group">
    <div class="col-sm-offset-1 col-sm-11">
        {{ $form->submit(
            __('utility.create') . ' ' . __('utility.new', [
                'type' => trans_choice('soap_server.soap server', $translationChoice)
            ]),
            ['class' => 'btn btn-default'])
        }}
    </div>
</div>

{{ $form->close() }}