<div class="form-group">
    {{ $form->label($name, $labelValue ?? null, ['class' => $labelClasses]) }}
    <div class="{{ $divClasses }}">
        {{ $form->$type($name, $inputValue ?? null, ['class' => $inputClasses]) }}
    </div>
</div>