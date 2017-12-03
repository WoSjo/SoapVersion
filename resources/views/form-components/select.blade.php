<div class="form-group">
    {{ $form->label($name, $label ?? null, ['class' => 'col-sm-1 control-label']) }}
    <div class="col-sm-11">
        {{ $form->select($name, $items, null, ['class' => 'form-control']) }}
    </div>
</div>
