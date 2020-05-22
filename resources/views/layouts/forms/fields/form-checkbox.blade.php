<div class="animated-checkbox">
  <label for="{{ getId($name) }}" class="form-check-label {{ $cols ?? null }} {{ $labelClasses ?? null }}">
    <input class="form-check-input @error(getName($name)) is-invalid @enderror {{ $controlClasses ?? null }}"
           id="{{ getId($name) }}"
           name="{{ $name }}"
           type="checkbox"
           {{ old('remember') ? 'checked' : '' }}>

    <span class="label-text">
      {{ $label }}
    </span>

    @formError(['name' => getName($name), 'cols' => $validationCols ?? null])
  </label>
</div>