@extends('layouts.dashboard.parts.index-content', [
    'iconClass' => 'fas fa-users-cog',
    'pageTitle' => 'Usuários',
    'resourceRouteName' => 'usuarios',
    'newResourceName' => 'Usuário',
    'resourceName' => 'Usuário'
])

@section('index-content')
  <table class="table table-striped table-responsive-md">
    <thead>
      <tr>
        <th class="w-25">Nome</th>
        <th class="w-25">E-mail</th>
        <th class="w-10">Função</th>
        <th class="w-10">Status</th>
        <th class="w-30">Ações</th>
      </tr>
    </thead>

    <tbody>
      @forelse($users as $user)
        <tr>
          <td>{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <td>{{ $user->friendlyRoleName }}</td>
          <td>
            @include('layouts.dashboard.parts.status-column', ['resource' => $user])
          </td>
          <td>
            @include('layouts.dashboard.parts.action-buttons', ['resourceName' => 'usuarios', 'resource' => $user])
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="5">Nenhum usuário foi encontrado.</td>
        </tr>
      @endforelse
    </tbody>
  </table>
@endsection