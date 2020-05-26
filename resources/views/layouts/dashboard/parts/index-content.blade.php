@extends('layouts.dashboard.dashboard', ['iconClass' => $iconClass, 'pageTitle' => $pageTitle])

@section('dashboard-content')
  <div class="card">
    <div class="card-header">
      @isset($returnRoute)
        @button(['type' => 'link', 'classes' => 'float-left p-0 pt-2 mr-3', 'icon' => 'fas fa-arrow-left',
        'route' => $returnRoute])
      @endisset

      <form action="{{ isset($resourceRouteParam) ?
            route("{$resourceRouteName}.index", $resourceRouteParam) :
            route("{$resourceRouteName}.index") }}" class="float-left">
        <input name="search" hidden>
        <input name="paginate" hidden>
        @button(['type' => 'outline-info', 'icon' => 'fas fa-sync-alt', 'typeButton' => 'submit'])
      </form>

      @isset($newResourceName)
        <a class="btn btn-success float-right" href="{{ isset($resourceRouteParam) ?
            route("{$resourceRouteName}.create", $resourceRouteParam) :
            route("{$resourceRouteName}.create") }}">
          <i class="fas fa-plus-circle mr-1"></i> {{ $newResourceName }}
        </a>
      @endisset
    </div>

    <div class="card-body">
      @include('layouts.forms.alerts.form-alert')

      <div class="row mb-3">
        <div class="col-12">
          <form action="{{ isset($resourceRouteParam) ?
            route("{$resourceRouteName}.index", $resourceRouteParam) :
            route("{$resourceRouteName}.index") }}">
            <div class="d-flex flex-column flex-md-row justify-content-md-between">
              <div class="app-paginate float-right m-0 p-0">
                @input(['type' => 'number', 'min' => 1, 'name' => 'paginate', 'placeholder' => 'Por página',
                'value' => $params['paginate'] ?? null, 'step' => 1])
              </div>

              <div class="app-search float-right m-0 p-md-0">
                <input class="app-search__input" id="seach" name="search" placeholder="Buscar"
                       value="{{ $params['search'] ?? null }}">
                <button class="app-search__button">
                  <i class="fa fa-search"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>

      @yield('index-content')
    </div>

    @isset($resources)
      @if($resources->hasPages())
        <div class="card-footer pb-0 flex-column">
          <span class="pt-2 float-left">
            Mostrando de {{ $resources->firstItem() }} a {{ $resources->lastItem() }} de {{ $resources->total() }}
          </span>

          <span class="mt-2 mt-lg-0 float-right">
            {{ $resources->appends($params)->links() }}
          </span>
        </div>
      @endif
    @endisset
  </div>
@endsection