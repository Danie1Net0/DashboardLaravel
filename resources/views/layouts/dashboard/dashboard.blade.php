@extends('layouts.app')

@section('content')
  @include('layouts.dashboard.nav')

  @include('layouts.dashboard.sidebar')

  <div class="app-content">
    <div class="app-title">
      <div>
        <h1>
          <i class="{{ $iconClass ?? 'fa fa-dashboard' }} mr-2"></i> {{ $pageTitle ?? 'Dashboard' }}
        </h1>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        @yield('dashboard-content')
      </div>
    </div>
  </div>
@endsection