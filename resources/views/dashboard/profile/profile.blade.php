@extends('layouts.dashboard.dashboard', ['iconClass' => 'fas fa-user-edit', 'pageTitle' => 'Perfil'])

@push('styles')
  <style>
    #avatar:hover {
      cursor: pointer;
    }
  </style>
@endpush

@section('dashboard-content')
  <form action="{{ route('profile.update', auth()->user()->getAuthIdentifier()) }}" method="POST"
        enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="card">
      <div class="card-header">
        <h5 class="m-0">Atualizar Perfil</h5>
      </div>

      <div class="card-body">
        @include('layouts.forms.alerts.form-alert')

        <div class="row">
          @inputFile(['cols' => 'col-12', 'name' => 'avatar', 'label' => 'Avatar'])
        </div>

        <div class="row">
          @input(['cols' => 'col-md-12 col-lg-6', 'name' => 'name', 'label' => 'Nome',
               'value' => old('name') ?? auth()->user()->name])
          @input(['cols' => 'col-md-12 col-lg-6', 'name' => 'email', 'label' => 'E-mail', 'readonly' => true,
               'value' =>old('email') ?? auth()->user()->email])
        </div>
      </div>

      <div class="card-footer">
        @button(['type' => 'primary', 'classes' => 'float-right', 'icon' => 'fas fa-floppy-o', 'text' => 'SALVAR'])
      </div>
    </div>
  </form>
@endsection

@push('scripts')
  <script>
    const inputAvatar = $('#avatar');
    inputAvatar.change(() => inputAvatar[0].labels[0].innerText = inputAvatar[0].files[0].name)
  </script>
@endpush