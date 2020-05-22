@extends('layouts.dashboard.dashboard', ['iconClass' => 'fas fa-user-lock', 'pageTitle' => 'Atualizar Senha'])

@section('dashboard-content')
  <form action="{{ route('password.update', auth()->user()->getAuthIdentifier()) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="card">
      <div class="card-header">
        <h5 class="m-0">Atualizar Senha</h5>
      </div>

      <div class="card-body">
        @include('layouts.forms.alerts.form-alert')

        <div class="row">
          @input(['cols' => 'col-md-12 col-lg-4', 'name' => 'old_password', 'label' => 'Senha atual',
                  'type' => 'password'])
          @input(['cols' => 'col-md-12 col-lg-4', 'name' => 'password', 'label' => 'Senha', 'type' => 'password'])
          @input(['cols' => 'col-md-12 col-lg-4', 'name' => 'password_confirmation', 'label' => 'Confirmação da senha',
                  'type' => 'password'])
        </div>
      </div>

      <div class="card-footer">
        @button(['type' => 'primary', 'classes' => 'float-right', 'icon' => 'fa fa-floppy-o', 'text' => 'SALVAR'])
      </div>
    </div>
  </form>
@endsection