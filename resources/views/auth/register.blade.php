@extends('layouts.app')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/views/auth/auth.css') }}">
@endpush

@section('content')
  <section class="material-half-bg">
    <div class="cover"></div>
  </section>

  <section class="login-content">
    <div class="div-center">
      <form method="POST" action="{{ route('register') }}" class="login-form">
        @csrf

        @include('auth.parts.header', ['title' => 'CADASTRO DE USUÁRIO', 'classeIcon' => 'fa fa-user-plus'])

        @input(['cols' => 'col-md-12', 'name' => 'name', 'label' => 'Nome'])
        @input(['cols' => 'col-md-12', 'name' => 'email', 'label' => 'E-mail'])
        @input(['cols' => 'col-md-12', 'name' => 'password', 'label' => 'Senha', 'type' => 'password'])
        @input(['cols' => 'col-md-12', 'name' => 'password_confirmation', 'label' => 'Confirmação da senha',
                'type' => 'password'])

        <div class="form-group row btn-container mt-4 d-flex justify-content-between">
          @button(['type' => 'primary', 'icon' => 'fa fa-arrow-left', 'text' => 'VOLTAR', 'route' => ['login']])
          @button(['type' => 'success', 'icon' => 'fa fa-floppy-o', 'text' => 'CADASTRAR'])
        </div>
      </form>
    </div>
  </section>
@endsection
