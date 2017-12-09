@inject('form', 'Collective\Html\FormBuilder')

{{ $form->model($model, ['url' => $url, 'class' => 'form-horizontal', 'method' => $method ?? 'post']) }}
@include('form-components.text', [
    'name' => 'name',
    'label' => __('soap_server.name'),
])

@include('form-components.text', [
    'name' => 'host',
    'label' => __('soap_server.host'),
])

@include('form-components.text', [
    'name' => 'port',
    'label' => __('soap_server.port'),
])

@include('form-components.select', [
    'name' => 'type_id',
    'label' => __('soap_server.type'),
    'items' => $types
])

@include('form-components.select', [
    'name' => 'group_id',
    'label' => __('soap_server.group'),
    'items' => $groups
])

<div class="form-group">
    <div class="col-sm-offset-1 col-sm-11">
        {{ $form->submit(
            __('utility.create') . ' ' . __('utility.new', [
                'type' => trans_choice('soap_server.soap server', 1)
            ]),
            ['class' => 'btn btn-default'])
        }}
    </div>
</div>
{{ $form->close() }}
