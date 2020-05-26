@extends('layouts.dashboard.dashboard', ['iconClass' => 'fas fa-users-cog', 'pageTitle' => 'Usuários'])

@section('dashboard-content')
  <div class="card">
    <div class="card-header d-flex justify-content-between">
      <h5 class="align-self-center m-0">
        @button(['type' => 'link', 'classes' => 'p-0', 'icon' => 'fas fa-arrow-left', 'route' => ['usuarios.index']])
        <span class="ml-2">Editar Usuário</span>
      </h5>

      <form action="{{ route("usuarios.destroy", [$user->id]) }}" id="form-delete" method="POST">
        @csrf
        @method('DELETE')
        @button(['type' => 'danger', 'classes' => 'float-right', 'icon' => 'far fa-trash-alt', 'text' => 'Deletar'])
      </form>
    </div>

    <form action="{{ route('usuarios.update', $user->id) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="card-body">
        @include('layouts.forms.alerts.form-alert')

        <div class="row">
          @input(['cols' => 'col-md-12 col-lg-6', 'name' => 'name', 'label' => 'Nome', 'value' => $user->name])
          @input(['cols' => 'col-md-12 col-lg-6', 'name' => 'email', 'label' => 'E-mail', 'value' => $user->email,
                  'readonly' => true])
        </div>

        <div class="row">
          @select(['cols' => 'col-md-12 col-lg-6', 'name' => 'role', 'label' => 'Função', 'options' => [
            ['value' => 'admin', 'content' => 'Administrador'],
            ['value' => 'user', 'content' => 'Usuário']
          ], 'value' => $user->roleName])
          @select(['cols' => 'col-md-12 col-lg-6', 'name' => 'active', 'label' => 'Status', 'options' => statusOptions(),
                   'value' => $user->active])
        </div>
      </div>

      <div class="card-footer">
        @button(['type' => 'primary', 'classes' => 'float-right', 'icon' => 'fa fa-floppy-o', 'text' => 'SALVAR'])
      </div>
    </form>
  </div>
@endsection

@push('scripts')
  <script>
    $(document).ready(function () {
      $('#role').select2({  minimumResultsForSearch: Infinity });
      deleteResource('Usuário');
    });
  </script>
@endpush