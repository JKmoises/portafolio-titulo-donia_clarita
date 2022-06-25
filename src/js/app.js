const ls = localStorage;
const $panelAdmin = document.querySelector('.panel-admin');
const $btnMenu = document.querySelector('.boton-menu');
const $opcionesMenu = document.querySelectorAll('.navegacion summary');
let textoOpciones = [];

document.addEventListener('DOMContentLoaded',() => iniciarApp());



function iniciarApp(){
  quitarAlerta(); //? Quita una alerta despues de unos segundos
  mostrarConfirmacionEliminar(); //? Muestra Modal de confirmacion 
  colapsarMenu(); //? Colapsa el menu de navegación
  storageMenu(); //? Cargando Storage del colapso del menu
  mostrarEstadisticas(); //? Muestra los graficos estadisticos
} 

// TODO: Funcionalidades de Reportes estadisticos
function mostrarEstadisticas() {
  if (location.pathname === '/estadisticas') {
    mostrarGraficaVentas();
    mostrarGraficaUsuarios();
    mostrarGraficaEstados();
  }
}

async function mostrarGraficaEstados() {
  try {
     const url = 'http://127.0.0.1:3000/api/estados';
     const res = await fetch(url);
     const json = await res.json();
    // console.log(json);
    
    const estados = json.map(({ ESTADO }) => ESTADO);
    // console.log(estados);

    const nroHabitaciones = json.map(({ NRO_HABITACIONES }) => parseInt(NRO_HABITACIONES));
    // console.log(nroHabitaciones);



    let datosEstados = [
      'graficoEstados',
      'doughnut',
      estados,
      'N° habitaciones por Estado',
      nroHabitaciones,
      [
        '#329f00',
        '#b8a11e',
        '#cb0000',
        '#2020d9'
      ],
      '#fff'
    ];

    mostrarGrafica(...datosEstados);
  } catch (error) {
    console.log(error);
  }
}

async function mostrarGraficaUsuarios() {
  try {
   /*  const url = 'http://127.0.0.1:3000/api/usuarios';
    const res = await fetch(url);
    const json = await res.json(); */
    // console.log(json);



    let datosUsuarios = [
      'graficoUsuarios',
      'bar',
      ['Admin','Cliente','Empleado','Proveedor'],
      'N° de Usuarios según su Rol',
      [1,5,3,2],
      [
        '#14192D80',
        '#00808080',
        '#CD5C5C80',
        '#222'
      ],
      [
        '#14192D',
        '#008080',
        '#CD5C5C',
        '#222'
      ]
    ];

    mostrarGrafica(...datosUsuarios);
  } catch (error) {
    console.log(error);
  }
}
  

async function mostrarGraficaVentas() {
  try {
    const url = 'http://127.0.0.1:3000/api/ventas';
    const res = await fetch(url);
    const json = await res.json();
    // console.log(json);

    const meses = json.map(({ MES }) => {
      let mes = parseInt(MES);

      switch (mes) {
        case 1:
          return 'Enero';
        case 2:
          return 'Febrero';
        case 3:
          return 'Marzo';
        case 4:
          return 'Abril';
        case 5:
          return 'Mayo';
        case 6:
          return 'Junio';
        case 7:
          return 'Julio';
        case 8:
          return 'Agosto';
        case 9:
          return 'Septiembre';
        case 10:
          return 'Octubre';
        case 11:
          return 'Noviembre';
        case 12:
          return 'Diciembre';
        default:
          break;
      }

    });
    // console.log(meses);

    const ventasMes = json.map(({ VENTA_MES }) => parseInt(VENTA_MES));
    // console.log(ventasMes);



    let datosVenta = [
      'graficoVentas',
      'line',
      meses,
      'Ventas por mes',
      ventasMes,
      '#b8a11e',
      '#b8a11e80',
      {
        scales: {
          y: {
            beginAtZero: true
          }
        },
      }
    ];

    mostrarGrafica(...datosVenta);
  } catch (error) {
    console.log(error);
  }
}

function mostrarGrafica(chart,type,labels,label,data,backgroundColor,borderColor,options) {
  const ctx = document.getElementById(chart).getContext('2d');
  // console.log(ctx);
  const myChart = new Chart(ctx, {
    type,
    data: {
      labels,
      datasets: [{
        label,
        data,
        backgroundColor,
        borderColor,
        borderWidth: 1
      }]
    },
    options,
  });

  // return myChart;
  
}


// TODO: Funcionalidades de Reservas de Admin 
function quitarAlerta(){
  const $alerta = document.querySelector('.alerta');
  
  if (document.body.contains($alerta) && !location.pathname.includes('/crear') &&
  !location.pathname.includes('/actualizar')) {
    setTimeout(() => {
      $alerta.classList.add('active');
    }, 3000);

    setTimeout(() => {
      $alerta.remove();
    }, 4000);
  }
}


function mostrarConfirmacionEliminar(){
  const $formularioEliminar = document.querySelectorAll('.formulario-eliminar');
  
  if (location.pathname === '/usuarios') {
    mostrarConfirmacion($formularioEliminar,'¿Estas seguro que quieres eliminar un usuario?');
  }else if (location.pathname === '/habitaciones') {
    mostrarConfirmacion($formularioEliminar,'¿Estas seguro que quieres eliminar una habitación?');
  }else if(location.pathname === '/clientes'){
    mostrarConfirmacion($formularioEliminar,'¿Estas seguro que quieres eliminar un cliente?');
  }else if(location.pathname === '/huespedes'){
    mostrarConfirmacion($formularioEliminar,'¿Estas seguro que quieres eliminar un huésped?');
  }else{
    return;
  }

  

}

function colapsarMenu(){
  
  hoverBtnMenu($btnMenu,'&larr;','Menú de Administración'); 

  $btnMenu.addEventListener('click', e => {
    
    $opcionesMenu.forEach(($opcionMenu,i) => {
      textoOpciones = [...textoOpciones,$opcionMenu.lastChild.textContent];
      
      if ($opcionMenu.parentElement.classList.contains('active')) {
        hoverBtnMenu($btnMenu, '&larr;', 'Menú de Administración'); 
        $panelAdmin.style.gridTemplateColumns = '20% 80%';  
        ls.setItem('menuColapsado','20% 80%');
        $opcionMenu.lastChild.textContent = textoOpciones[i];
        $opcionMenu.parentElement.classList.remove('active');
        $opcionMenu.nextElementSibling.classList.remove('active');
        
      } else {
        hoverBtnMenu($btnMenu, '&rarr;', '&rarr;'); 
        $panelAdmin.style.gridTemplateColumns = '8% 92%';
        ls.setItem('menuColapsado', '8% 92%');
        $opcionMenu.lastChild.textContent = '';
        $opcionMenu.parentElement.classList.add('active')
        $opcionMenu.nextElementSibling.classList.add('active');
        
      }
    });
  });

}

function storageMenu() {

  if (ls.getItem("menuColapsado") === null) { //si no existe la variable 'menuColapsado' en el localStorage
    ls.setItem('menuColapsado', '20% 80%');
  }


  if (ls.getItem("menuColapsado") === "20% 80%") { 
    $opcionesMenu.forEach(($opcionMenu, i) => {
      textoOpciones = [...textoOpciones, $opcionMenu.lastChild.textContent];
      
      hoverBtnMenu($btnMenu, '&larr;', 'Menú de Administración');
      $panelAdmin.style.gridTemplateColumns = '20% 80%';
      ls.setItem('menuColapsado', '20% 80%');
      $opcionMenu.lastChild.textContent = textoOpciones[i];
      $opcionMenu.parentElement.classList.remove('active');
      $opcionMenu.nextElementSibling.classList.remove('active');
    });
    
  }
  
  if (ls.getItem("menuColapsado") === "8% 92%") {
    $btnMenu.innerHTML = '&rarr;';
    
    $opcionesMenu.forEach(($opcionMenu, i) => {
      textoOpciones = [...textoOpciones, $opcionMenu.lastChild.textContent];

      hoverBtnMenu($btnMenu, '&rarr;', '&rarr;');
      $panelAdmin.style.gridTemplateColumns = '8% 92%';
      ls.setItem('menuColapsado', '8% 92%');
      $opcionMenu.lastChild.textContent = '';
      $opcionMenu.parentElement.classList.add('active')
      $opcionMenu.nextElementSibling.classList.add('active');
    });
  
  }
  // console.log(textoOpciones);
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

function mostrarConfirmacion($formDelete,textConfirm){
  $formDelete.forEach(formulario => {
    formulario.addEventListener('submit',e => {
      e.preventDefault();
      modalConfirmacion(e.target,textConfirm);
    });
  });
}


function modalConfirmacion(formDelete,title){
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
      formDelete.submit();
    }
  });
}

