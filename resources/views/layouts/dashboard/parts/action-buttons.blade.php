@button(['type' => 'primary', 'icon' => 'fas fa-edit', 'route' => ['usuarios.edit', $user->id], 'text' => 'Editar',
  'classes' => 'mb-2 mb-lg-0 mr-lg-2 float-left'])

<form action="{{ route("{$resourceName}.destroy", $resource->id) }}" id="form-delete" method="POST">
  @csrf
  @method('DELETE')

  @button(['type' => 'danger', 'classes' => 'btn-delete', 'icon' => 'far fa-trash-alt', 'text' => 'Deletar',
    'id' => $user->id])
</form>