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
  
  hoverBtnMenu($btnMenu,'&larr;','Menú de Administración'); 
  
  $btnMenu.addEventListener('click',e => {
    $panelAdmin.style.gridTemplateColumns = '10% 90%';
    
    $opcionesMenu.forEach(($opcionMenu,i) => {
      textoOpciones = [...textoOpciones,$opcionMenu.lastChild.textContent];
      
      if ($opcionMenu.parentElement.classList.contains('active')) {
        hoverBtnMenu($btnMenu,'&larr;','Menú de Administración'); 
        $panelAdmin.style.gridTemplateColumns = '20% 80%';
        $opcionMenu.lastChild.textContent = textoOpciones[i];
        $opcionMenu.parentElement.classList.remove('active');
        $opcionMenu.nextElementSibling.classList.remove('active');
        
      } else {
        hoverBtnMenu($btnMenu,'&rarr;','&rarr;'); 
        $opcionMenu.lastChild.textContent = '';
        $opcionMenu.parentElement.classList.add('active')
        $opcionMenu.nextElementSibling.classList.add('active');
        
      }
    });
  });


}

function hoverBtnMenu($elemento,textButtonHover,textButton){
  $elemento.style.transition = 'all 0.4s ease-in';

  //* Evento que se emite al entrar el cursor al elemento
  $elemento.addEventListener('mouseover',e => {
    e.target.style.fontSize = '1.6rem';
    e.target.style.fontWeight = '700';
    e.target.innerHTML = textButtonHover;
      
    
    
  });
  
  //* Evento que se emite al sacar el cursor del elemento
  $elemento.addEventListener('mouseout',e => {
    e.target.style.fontSize = '1.6rem';
    e.target.innerHTML = textButton;
      
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