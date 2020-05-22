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
      <form method="POST" action="{{ route('login') }}" class="login-form">
        @csrf

        @include('auth.parts.header', ['title' => 'LOGIN', 'classeIcon' => 'fa fa-user'])

        @input(['name' => 'email', 'label' => 'E-mail'])
        @input(['name' => 'password', 'label' => 'Senha', 'type' => 'password'])

        <div class="form-group">
          <div class="utility d-flex justify-content-between">
            @checkbox(['name' => 'remember', 'label' => 'Lembrar-me'])

            @if (Route::has('password.request'))
              <a href="{{ route('password.request') }}">Esqueceu sua senha?</a>
            @endif
          </div>
        </div>

        <div class="form-group btn-container">
          @button(['type' => 'primary', 'classes' => 'btn-block', 'icon' => 'fa fa-sign-in',
          'iconClasses' => 'fa-lg fa-fw', 'text' => 'ENTRAR'])
        </div>

        <div class="form-group mt-4 text-center">
                    @button(['type' => 'link', 'icon' => 'fa fa-user-plus', 'text' => 'CADASTRAR', 'route' => ['register']])
        </div>
      </form>
    </div>
  </section>
@endsection
