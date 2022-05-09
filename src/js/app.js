document.addEventListener('DOMContentLoaded',iniciarApp);

function iniciarApp(){
  mostrarConfirmacion(); //? Muestra Modal de confirmacion 
} 


function mostrarConfirmacion(){
  const $formularioEliminar = document.querySelectorAll('.formulario-eliminar');

  $formularioEliminar.forEach(formulario => {
    formulario.addEventListener('submit',e => {
      e.preventDefault();
      modalConfirmacion(e.target,'¿Estas seguro que quieres eliminar un usuario?');
    });
  });
}


function modalConfirmacion(elemento,title){
  Swal.fire({
    title,
    text: "¡No podrás revertir esto!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: '¡Si, Elimínalo!',
    cancelButtonText: 'Cancelar',
    customClass: {
      popup: 'modal',
      icon: 'modal-icon',
      title: 'modal-title',
      htmlContainer: 'modal-warning',
      actions: 'modal-btns',
      confirmButton: 'modal-btn-confirm',
      cancelButton: 'modal-btn-cancel',
    },
  }).then((result) => {
    if (result.isConfirmed) {
      elemento.submit();
    }
  });
}