@if(isset($route))
  <a class="btn btn-{{ $type }} {{ $classes ?? '' }}" href="{{ route($route[0], $route[1] ?? null) }}">
    <i class="{{ $icon }} {{ $iconClasses ?? '' }}"></i> {{ $text ?? '' }}
  </a>
@else
  <button class="btn btn-{{ $type }} {{ $classes ?? null }}">
    <i class="{{ $icon ?? null }} {{ $iconClasses ?? null }}"></i> {{ $text ?? null }}
  </button>
@endif