@extends('layouts.dashboard.dashboard', ['iconClass' => 'fas fa-users-cog', 'pageTitle' => 'Usuários'])

@section('dashboard-content')
  <form action="{{ route('usuarios.store') }}" method="POST">
    @csrf

    <div class="card">
      <div class="card-header">
        <h5 class="m-0">
          @button(['type' => 'link', 'classes' => 'p-0', 'icon' => 'fas fa-arrow-left', 'route' => ['usuarios.index']])
          <span class="ml-2">Novo Usuário</span>
        </h5>
      </div>

      <div class="card-body">
        @include('layouts.forms.alerts.form-alert')

        <div class="row">
          @input(['cols' => 'col-md-12 col-lg-4', 'name' => 'name', 'label' => 'Nome'])
          @input(['cols' => 'col-md-12 col-lg-4', 'name' => 'email', 'label' => 'E-mail'])
          @select(['cols' => 'col-md-12 col-lg-4', 'name' => 'role', 'label' => 'Função', 'options' => [
            ['value' => 'admin', 'content' => 'Administrador'],
            ['value' => 'user', 'content' => 'Usuário']
          ]])
        </div>

        <div class="row">
          @input(['cols' => 'col-md-12 col-lg-6', 'name' => 'password', 'label' => 'Senha', 'type' => 'password'])
          @input(['cols' => 'col-md-12 col-lg-6', 'name' => 'password_confirmation', 'label' => 'Confirmação da senha',
            'type' => 'password'])
        </div>
      </div>

      <div class="card-footer">
        @button(['type' => 'primary', 'classes' => 'float-right', 'icon' => 'fa fa-floppy-o', 'text' => 'SALVAR'])
      </div>
    </div>
  </form>
@endsection

@push('scripts')
  <script>
    $(document).ready(function () {
      $('#role').select2({  minimumResultsForSearch: Infinity })
    });
  </script>
@endpush