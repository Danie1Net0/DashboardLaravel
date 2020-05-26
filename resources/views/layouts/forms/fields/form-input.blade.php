<div class="form-group {{ $cols ?? null }} {{ $groupClasses ?? null }}">
  @if (isset($label))
    <label for="{{ getId($name) }}" class="control-label {{ $labelClasses ?? null }}">
      {{ $label }}:
    </label>
  @endif

  <input autofocus
         class="form-control @error(getName($name)) is-invalid @enderror {{ $controlClasses ?? null }}"
         id="{{ getId($name) }}"
         max="{{ $max ?? null }}"
         min="{{ $min ?? null }}"
         name="{{ $name }}"
         placeholder="{{ $placeholder ?? $label ?? null }}"
         step="{{ $step ?? 0.01 }}"
         type="{{ $type ?? 'text' }}"
         value="{{ isPassword($type ?? 'text', $name, $notRemember ?? null) ? null : old(getName($name)) ?? $value ?? null }}"
         {{ isset($readonly) ? 'readonly' : null }}>

  @formError(['name' => getName($name), 'cols' => $validationCols ?? null])
</div>