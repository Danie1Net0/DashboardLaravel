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
      <form method="POST" action="{{ route('password.update') }}" class="login-form">
        @csrf

        @include('auth.parts.header', ['title' => 'NOVA SENHA', 'classeIcon' => 'fa fa-key'])

        @input(['name' => 'token', 'type' => 'hidden', 'value' => $token])
        @input(['name' => 'email', 'label' => 'E-mail'])
        @input(['name' => 'password', 'label' => 'Senha', 'type' => 'password'])
        @input(['name' => 'password_confirmation', 'label' => 'Confirmação da senha', 'type' => 'password'])

        <div class="form-group btn-container">
          @button(['type' => 'primary', 'classes' => 'btn-block', 'icon' => 'fa fa-floppy-o', 'text' => 'REDEFINIR SENHA'])
        </div>

        <div class="form-group mt-4">
          @include('auth.parts.button-back')
        </div>
      </form>
    </div>
  </section>
@endsection
