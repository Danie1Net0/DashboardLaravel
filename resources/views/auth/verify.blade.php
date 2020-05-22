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
      <form method="POST" action="{{ route('verification.resend') }}" class="login-form">
        @csrf

        @include('auth.parts.header', ['title' => 'VERIFIQUE SEU E-MAIL', 'classeIcon' => 'fa fa-envelope-open'])

        @if (session('resent'))
          <div class="alert alert-success" role="alert">
            Um novo link de verificação foi enviado para o seu endereço de e-mail.
          </div>
        @endif

        <div class="form-group mt-4">
          <div class="utility">
            <p class="semibold-text text-justify">
              Um link de verificação foi enviado para seu endereço de e-mail. Confirme-o para ter acesso ao sistema.
              <br><br>
              Se você não recebeu o e-mail, clique no botão abaixo para receber outro.
            </p>
          </div>
        </div>

        <div class="form-group btn-container">
          @button(['type' => 'primary', 'classes' => 'btn-block', 'icon' => 'fa fa-paper-plane', 'text' => 'REENVIAR CONFIRMAÇÃO'])
        </div>
      </form>
    </div>
  </section>
@endsection