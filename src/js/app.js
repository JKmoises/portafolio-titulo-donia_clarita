document.addEventListener('DOMContentLoaded',iniciarApp);

function iniciarApp(){
  mostrarConfirmacion(); //? Muestra Modal de confirmacion 
  colapsarMenu(); //? Colapsa el menu de navegación
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

function colapsarMenu(){
  const $panelAdmin = document.querySelector('.panel-admin');
  const $btnMenu = document.querySelector('.boton-menu');
  const $opcionesMenu = document.querySelectorAll('.navegacion summary');
  let textoOpciones = [];
  

  hoverBtnMenu($btnMenu); //? Evento hover del boton menu
  
  $btnMenu.addEventListener('click',e => {
    hoverBtnMenu($btnMenu); //? Evento hover del boton menu
    $panelAdmin.style.gridTemplateColumns = '8% 92%';
    $panelAdmin.style.transition = 'all .7s ease-in-out';
    // transition: all .7s ease-in-out;
    
    $opcionesMenu.forEach(($opcion,i) => {
      textoOpciones = [...textoOpciones,$opcion.lastChild.textContent];

      if ($opcion.parentElement.classList.contains('active')) {
        $panelAdmin.style.gridTemplateColumns = '20% 80%';
        $opcion.lastChild.textContent = textoOpciones[i];
        $opcion.parentElement.classList.remove('active');
      } else {
        $opcion.lastChild.textContent = '';
        $opcion.parentElement.classList.add('active');

      }
    });
    console.log(textoOpciones);
  });


}

function hoverBtnMenu($elemento,textButton,textButtonHover){
  $elemento.style.transition = 'all 0.4s ease-in';

  //* Evento que se emite al entrar el cursor al elemento
  $elemento.addEventListener('mouseover',e => {
    e.target.style.fontSize = '1.6rem';
    e.target.style.fontWeight = '700';

    if (e.target.textContent === 'Menú de Administración') {
      e.target.innerHTML = '&larr;';
    }else{
      e.target.innerHTML = '&rarr;';
      
    }
    
  });
  
  //* Evento que se emite al sacar el cursor del elemento
  $elemento.addEventListener('mouseout',e => {
    e.target.style.fontSize = '1.6rem';
    if (e.target.textContent === 'Menú de Administración') {
      e.target.innerHTML = '&rarr;';
    }else{
      e.target.textContent = 'Menú de Administración';
      
    }
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