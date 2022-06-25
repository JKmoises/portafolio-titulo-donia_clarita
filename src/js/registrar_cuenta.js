
const $container = document.querySelector('#container-campo-empresa');

let esCliente = null;

document.addEventListener('DOMContentLoaded', () => iniciarApp());

function iniciarApp(){
  mostrarCampoEmpresa();

}

// TODO: Funcionalidades de la creacion de una cuenta

function crearCampoEmpresa() {
  limpiarHTML($container);

  const $containerCampo = document.createElement('div'); 
  $containerCampo.classList.add('campo');
  $containerCampo.style.marginLeft = '2.5rem';

  const $labelEmpresa = document.createElement('label');
  $labelEmpresa.textContent = 'Empresa';
  $labelEmpresa.for = 'empresa';

  const $inputEmpresa = document.createElement('input');
  $inputEmpresa.type = 'text';
  $inputEmpresa.id = 'empresa';
  $inputEmpresa.name = 'empresa';
  $inputEmpresa.placeholder = 'Tu Empresa';

  $containerCampo.appendChild($labelEmpresa);
  $containerCampo.appendChild($inputEmpresa);

  $container.appendChild($containerCampo);
}

function mostrarCampoEmpresa() {

  const $radioSi = document.querySelector('#si');
  const $radioNo = document.querySelector('#no');

  $radioSi.addEventListener('click', e => {
    esCliente = e.target.checked;

    if (esCliente) {
      crearCampoEmpresa();
    } 
  }); 

  $radioNo.addEventListener('click', e => {
    esCliente = e.target.checked;

    if (esCliente) {
      limpiarHTML($container);
    }
  }); 


}

function limpiarHTML($elemento){
  while ($elemento.firstElementChild) {
    $elemento.firstElementChild.remove();
  }
}

