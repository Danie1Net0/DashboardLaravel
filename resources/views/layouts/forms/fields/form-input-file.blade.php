<div class="form-group {{ $cols ?? null }} {{ $groupClasses ?? null }}">
  <label class="control-label {{ $labelClasses ?? null }}">
    {{ $label }}:
  </label>

  <div class="input-group">
    <div class="custom-file">
      <input accept="{{ $accept ?? 'image/*' }}"
             autofocus
             class="custom-file-input @error(getName($name)) is-invalid @enderror {{ $controlClasses ?? null }}"
             id="{{ getId($name) }}"
             name="{{ $name }}"
             type="file">

      <label class="custom-file-label" for="{{ getId($name) }}">
        Selecione a Imagem
      </label>
    </div>
  </div>

  @formError(['name' => getName($name), 'cols' => $validationCols ?? null])
</div>