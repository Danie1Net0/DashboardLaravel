<div class="form-group {{ $cols ?? null }} {{ $groupClasses ?? null }}">
  <label for="{{ getId($name) }}" class="control-label {{ $labelClasses ?? null }}">
    {{ $label }}:
  </label>

  <textarea autofocus
            class="form-control @error(getName($name)) is-invalid @enderror {{ $controlClasses ?? null }}"
            id="{{ getId($name) }}"
            name="{{ $name }}"
            placeholder="{{ $placeholder ?? $label }}"
            {{ isset($readonly) ? 'readonly' : null }}>
            {{ old(getName($name)) ?? $value ?? null }}
  </textarea>

  @formError(['name' => getName($name), 'cols' => $validationCols ?? null])
</div>