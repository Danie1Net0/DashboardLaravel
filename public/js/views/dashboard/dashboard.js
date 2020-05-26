$(document).ready(function () {
  $('#active').select2({  minimumResultsForSearch: Infinity });
});

function deleteResource(resourceName = 'Recurso') {
  const onSubmit = function (event) {
    event.preventDefault();

    confirmation(resourceName).then(response => {
      if (response.value) {
        $(this).off('submit', onSubmit);
        $(this).submit();
      }
    });
  };

  $('#form-delete').on('submit', onSubmit)
}

function confirmation(resourceName) {
  return Swal.fire({
    icon: 'question',
    title: `Deletar ${ resourceName }`,
    text: 'Essa ação será irreversível. Você tem certeza que deseja deletar esse recurso?',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#1D5080',
    confirmButtonText: 'Sim, deletar!',
    cancelButtonText: 'Cancelar'
  });
}