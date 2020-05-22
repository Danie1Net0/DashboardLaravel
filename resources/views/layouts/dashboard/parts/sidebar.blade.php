@push('styles')
  <style>
    .avatar {
      width: 50px;
      height: 50px;
    }
  </style>
@endpush

<aside class="app-sidebar">
  <div class="app-sidebar__user">
    <img class="app-sidebar__user-avatar avatar" src="{{ $avatar }}" alt="Avatar">
    <div>
      <p class="app-sidebar__user-name">{{ $userName }}</p>
    </div>
  </div>

  @if (isset($sidebarItems['sidebar_items']))
    <ul class="app-menu">
      @foreach ($sidebarItems['sidebar_items'] as $sidebarItem)
        @if ((isset($sidebarItem['role']) && auth()->user()->hasRole($sidebarItem['role'])) ||
                (isset($sidebarItem['permission']) && auth()->user()->hasPermissionTo($sidebarItem['permission'])) ||
                (isset($sidebarItem['role']) && isset($sidebarItem['permission']) &&
                 auth()->user()->hasRole($sidebarItem['role']) &&
                 auth()->user()->hasPermissionTo($sidebarItem['permission'])))
          <li class="treeview">
            <a class="app-menu__item" href="{{ isset($sidebarItem['route']) ? route($sidebarItem['route']) : '' }}"
                @if (isset($sidebarItem['subitems'])) data-toggle="treeview" @endif>
              <i class="app-menu__icon {{ $sidebarItem['icon'] }}"></i>
              <span class="app-menu__label">{{ $sidebarItem['title'] }}</span>
              @if (isset($sidebarItem['subitems']))
                <i class="treeview-indicator fa fa-angle-right"></i>
              @endif
            </a>

            @if (isset($sidebarItem['subitems']))
              <ul class="treeview-menu">
                @foreach ($sidebarItem['subitems'] as $sidebarSubitem)
                  @if ((isset($sidebarSubitem['role']) && auth()->user()->hasRole($sidebarSubitem['role'])) || !isset($sidebarSubitem['role']))
                    <li>
                      <a class="treeview-item" href="{{ route($sidebarSubitem['route']) }}">
                        <i class="icon {{ $sidebarSubitem['icon'] }}"></i> {{ $sidebarSubitem['title'] }}
                      </a>
                    </li>
                  @endif
                @endforeach
              </ul>
            @endif
          </li>
        @endif
      @endforeach

      <li class="treeview">
        <form action="{{ route('logout') }}" method="POST">
          @csrf

          <button class="btn btn-block app-menu__item">
            <i class="app-menu__icon fa fa-sign-out"></i> Sair
          </button>
        </form>
      </li>
    </ul>
  @endif
</aside>