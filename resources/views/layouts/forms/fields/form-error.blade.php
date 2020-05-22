@error($name)
  <span class="invalid-feedback {{ $cols ?? null }}" role="alert">
    {{ $message }}
  </span>
@enderror
