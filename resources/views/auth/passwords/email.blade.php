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
      <form method="POST" action="{{ route('password.email') }}" class="login-form">
        @csrf

        @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
        @endif

        @include('auth.parts.header', ['title' => 'RECUPERAR SENHA', 'classeIcon' => 'fa fa-key'])

        @input(['name' => 'email', 'label' => 'E-mail', 'value' => $email ?? old('email')])

        <div class="form-group btn-container">
          @button(['type' => 'primary', 'classes' => 'btn-block', 'icon' => 'fa fa-paper-plane', 'text' => 'ENVIAR'])
        </div>

        <div class="form-group mt-4">
          @include('auth.parts.button-back')
        </div>
      </form>
    </div>
  </section>
@endsection
