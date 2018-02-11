<div class="form-group">
    {{ Form::label($name, $label ?? null, ['class' => 'col-sm-1']) }}
    <div class="col-sm-11">
        {{ Form::checkbox($name, null) }}
    </div>
</div>
