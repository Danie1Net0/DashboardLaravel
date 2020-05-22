@if(isset($route))
  <a class="btn btn-{{ $type }} {{ $classes ?? '' }}" href="{{ route($route[0], $route[1] ?? null) }}"
     id="{{ $id ?? null }}">
    <i class="{{ $icon }} {{ $iconClasses ?? '' }}"></i> {{ $text ?? '' }}
  </a>
@else
  <button class="btn btn-{{ $type }} {{ $classes ?? null }}" id="{{ $id ?? null }}" type="{{ $buttonType ?? 'submit' }}">
    <i class="{{ $icon ?? null }} {{ $iconClasses ?? null }}"></i> {{ $text ?? null }}
  </button>
@endif