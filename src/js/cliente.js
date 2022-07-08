let paso = 1;
const pasoInicial = 1;
const pasoFinal = 3;

//* Objeto de plantilla en donde se guardará la info seleccionada por el usuario
const reserva = {
  nombre: '',
  fechaLlegada: '',
  fechaSalida: '',
  subtotal: 0,
  total: 0,
  servicios: []
}

document.addEventListener('DOMContentLoaded',() => iniciarApp());



function iniciarApp(){
  mostrarSeccion(); //* Muestra y oculta las secciones
  tabs(); //* Cambia la sección cuando se presionen los tabs
  botonesPaginador(); //* Agrega o quita los botones del paginador
  paginaAnterior(); //* Boton que traslada a la sección anterior si es que la hay
  paginaSiguiente();  //* Boton que traslada a la sección siguiente si es que la hay

  consultaAPI(); //* Consulta la API para mostrar todos los servicios
  
  // idCliente(); //* Añade el id del cliente del input al objeto 'reserva'
  nombreCliente(); //* Añade el nombre del cliente del input al objeto 'reserva'
  seleccionarFechaLlegada(); //* Añade la fecha de Llegada de la reserva del input al objeto 'reserva'
  seleccionarFechaSalida(); //* Aña la  la fecha de salida de la reserva del input al objeto 'reserva'

  mostrarResumen(); //* Muestra el resumen de la reserva

} 

// TODO: Funcionalidades de Reservas de Cliente

function mostrarSeccion(){
  //* Ocultar las secciones que no corresponden a su respectivo tab
  const seccionAnterior = document.querySelector('.mostrar');
  
  if (seccionAnterior) { //* Si existe una seccion con la clase .mostrar ....
    seccionAnterior.classList.remove('mostrar');
  }
  
  //* Seleccionar la seccion con el paso
  const seccion = document.querySelector(`#paso-${paso}`);
  seccion.classList.add('mostrar');
  
   //* Ocultar los tabs que no corresponden a su respectiva seccion
   const tabAnterior = document.querySelector('.actual');
   tabAnterior.classList.remove('actual');
   
   //* Resalta el tab actual
   const tab = document.querySelector(`[data-paso="${paso}"]`);
   tab.classList.add('actual');
   
   
  }
  
  function tabs(){
  const botones = document.querySelectorAll('.tabs button'); //* todos los <button> de la navegacion

  botones.forEach(boton => {
    boton.addEventListener('click',e => {
      paso = parseInt(e.target.dataset.paso); //* Guarda data-attribute del boton clickeado

      mostrarSeccion();

      botonesPaginador(); 
    });

  });
}

function botonesPaginador(){
  const paginaAnterior = document.querySelector('#anterior');
  const paginaSiguiente = document.querySelector('#siguiente');

  if (paso === 1) {
    paginaAnterior.classList.add('ocultar');
    paginaSiguiente.classList.remove('ocultar');
  }else if(paso === 2) {
    paginaAnterior.classList.remove('ocultar');
    paginaSiguiente.classList.remove('ocultar');
  }else if(paso === 3) {
    paginaAnterior.classList.remove('ocultar');
    paginaSiguiente.classList.add('ocultar');
    mostrarResumen(); //* Mostrando sección de resumen
  }

  mostrarSeccion();
}

function paginaAnterior(){
  const paginaAnterior = document.querySelector('#anterior');

  paginaAnterior.addEventListener('click',() => {
    if (paso <= pasoInicial) return;
    
    // console.log(paso);
    paso--;

    botonesPaginador();
  });
}

function paginaSiguiente(){
  const paginaSiguiente = document.querySelector('#siguiente');

  paginaSiguiente.addEventListener('click',() => {
    if (paso >= pasoFinal) return;

    // console.log(paso);
    paso++;

    botonesPaginador();
  });
}

async function consultaAPI(){
  try {
    const url = 'http://127.0.0.1:3000/api/habitaciones';
    const resultado = await fetch(url); //* Esperando a que se devuelva la petición completa
    const servicios = await resultado.json();
    // console.log(servicios);

    mostrarServicios(servicios);

    // filtrarHabitacion(servicios);
  } catch (error) {
    console.log(error);
  }
}


function filtrarHabitacion(habitaciones) {
  console.log(habitaciones);
  let filtro = [];

  const $filtrosHabitaciones = document.querySelector('.habitacion-filtros');

  $filtrosHabitaciones.addEventListener('click', e => {

    if (e.target.matches('#filtro-todos')) {
      mostrarServicios(habitaciones);
    }

    if (e.target.matches('#filtro-king')) {
      filtro = habitaciones.filter(habitacion =>habitacion.tipo === 'King');
    }

    if (e.target.matches('#filtro-triple')) {
      filtro = habitaciones.filter(habitacion => habitacion.tipo === 'Triple');
      mostrarServicios(filtro);
    }

    if (e.target.matches('#filtro-duplex')) {
      filtro = habitaciones.filter(habitacion => habitacion.tipo === 'Duplex');
      mostrarServicios(filtro);
      
    }

    if (e.target.matches('#filtro-individual')) {
      filtro = habitaciones.filter(habitacion => habitacion.tipo === 'Individual');
      mostrarServicios(filtro);
    }

    if (e.target.matches('#filtro-doble')) {
      filtro = habitaciones.filter(habitacion => habitacion.tipo === 'Doble');
      mostrarServicios(filtro);
    }

    if (e.target.matches('#filtro-moderna')) {
      filtro = habitaciones.filter(habitacion => habitacion.tipo === 'Moderna');
      mostrarServicios(filtro);
    }

    if (e.target.matches('#filtro-clasica')) {
      filtro = habitaciones.filter(habitacion => habitacion.tipo === 'Clasica');
      mostrarServicios(filtro);
    }

    if (e.target.matches('#filtro-estudio')) {
      filtro = habitaciones.filter(habitacion => habitacion.tipo === 'Estudio');
      mostrarServicios(filtro);
    }

  });
}

function mostrarServicios(servicios) {
  const $habitaciones = document.querySelector('#servicios');
  limpiarHTML($habitaciones);

  servicios.forEach(servicio => {
    const {id, tipo, precio, descripcion, tipo_cama } = servicio;

    //* Formatea un número a peso dependiendo del pais 
    const precioFormat = new Intl.NumberFormat().format(precio);

    const nombreServicio = document.createElement('p');
    nombreServicio.classList.add('nombre-servicio','third-text-color');
    nombreServicio.textContent = `Habitación ${tipo}`;

    const precioServicio = document.createElement('p');
    precioServicio.classList.add('precio-servicio','text-left');
    precioServicio.textContent = `$${precioFormat}`;

    const descripcionServicio = document.createElement('p');
    descripcionServicio.classList.add('descripcion-servicio','text-left');
    descripcionServicio.textContent = descripcion;
    
    const camaServicio = document.createElement('p');
    camaServicio.classList.add('cama-servicio','text-left');
    camaServicio.textContent = `Cama ${tipo_cama}`;

    const servicioDiv = document.createElement('div');
    servicioDiv.classList.add('servicio');
    servicioDiv.dataset.idServicio = id;
    servicioDiv.onclick = () => seleccionarServicio(servicio);

    servicioDiv.appendChild(nombreServicio);
    servicioDiv.appendChild(descripcionServicio);
    servicioDiv.appendChild(camaServicio);
    servicioDiv.appendChild(precioServicio);

    document.querySelector('#servicios').appendChild(servicioDiv);
    
  });
}

function seleccionarServicio(servicio){
  const { id,precio } = servicio; //* Id de servicio seleccionado
  const { servicios } = reserva; //* Arreglo de servicios a llenar

  //* Identificando al elemento que se le da click 
  const divServicio = document.querySelector(`[data-id-servicio="${id}"]`);
  // console.log(divServicio);

  //? Comprobar si un servicio ya fue agregado
  if (servicios.some(agregado => agregado.id === id)) { //*Si el id que existe en memoria es igual al agregar
    //* Eliminar servicio
    reserva.servicios = servicios.filter(agregado => agregado.id !== id);
    divServicio.classList.remove('seleccionado');
    reserva.total -= parseInt(precio);
    reserva.subtotal -= parseInt(precio);
  }else{ //* Si no son iguales los Ids
    //* Agregar servicio 
    reserva.servicios = [...servicios, servicio]; //* Agregando nuevo servicio y servicios que existian ya
    divServicio.classList.add('seleccionado');
    reserva.total += parseInt(precio);
    reserva.subtotal += parseInt(precio);
  }
  



  // console.log(servicio);
  console.log(reserva);

}



function nombreCliente(){
  const nombre = document.querySelector('#nombre').value;
  reserva.nombre = nombre;
  // console.log(reserva);
}

function  seleccionarFechaLlegada(){
  const inputFechaLlegada = document.querySelector('#fecha_llegada');
  // console.log(inputFecha);
  inputFechaLlegada.addEventListener('input',(e) => {
    //* Guardando dia de la semana de la fecha seleccionada
    const dia = new Date(e.target.value).getUTCDay(); 

    //* Guardando hora del input
    const horaReserva = new Date(e.target.value)
          .toLocaleTimeString([],{hour: '2-digit', minute: '2-digit'});
    const [hora ,] = horaReserva.split(':');

    //* Guardando hora y fecha 
    const horaFecha = e.target.value.split('T').join(' ');

    // console.log(dia);
    // console.log(horaReserva);
    // console.log(hora);
    // console.log(e.target.value);

    //* Si la hora está en el rango de 10:00 a 22:00 ...
    if(hora < 10 || hora > 22){
      mostrarAlerta('Hora no válida','error','.formulario');
      e.target.value = ''; //* Dejando el input fecha vacío
    }else{ //* Si no...
      reserva.fechaLlegada = horaFecha; //* Guardando fecha y hora seleccionada en objeto 'reserva'
    }
  
  });
}

function seleccionarFechaSalida(){
  const inputFechaSalida = document.querySelector('#fecha_salida');
  // console.log(inputFecha);
  inputFechaSalida.addEventListener('input',(e) => {
    //* Guardando dia de la semana de la fecha seleccionada
    const dia = new Date(e.target.value).getUTCDay(); 

    //* Guardando hora del input
    const horaReserva = new Date(e.target.value)
          .toLocaleTimeString([],{hour: '2-digit', minute: '2-digit'});
    const [hora ,] = horaReserva.split(':');

    //* Guardando hora y fecha 
    const horaFecha = e.target.value.split('T').join(' ');

    // console.log(dia);
    // console.log(horaReserva);
    // console.log(hora);
    // console.log(e.target.value);

    //* Si la hora está en el rango de 10:00 a 22:00 ...
    if(hora < 10 || hora > 22){
      mostrarAlerta('Hora no válida','error','.formulario');
      e.target.value = ''; //* Dejando el input fecha vacío

    }else{ //* Si no es sábado ni domingo...
      reserva.fechaSalida = horaFecha; //* Guardando fecha y hora seleccionada en objeto 'reserva'
    }
    
  });
}


function mostrarResumen(){
  const resumen = document.querySelector('.contenido-resumen');

  //* Limpiar el contenido resumen
  while (resumen.firstElementChild) {
    resumen.removeChild(resumen.firstElementChild);
  } 

  // console.log(Object.values(reserva));
  //* Si al menos una propiedad del objeto 'reserva' está vacío o el arreglo de servicios está vacío...
  if (Object.values(reserva).includes('') || reserva.servicios.length === 0) { 
    mostrarAlerta('Faltan datos de Servicios, Fecha u Hora','error','.contenido-resumen',false);

    return;
  }

  //? Formatear el div de resumen
  const { nombre, fechaLlegada, fechaSalida, subtotal, total, servicios} = reserva; //* Guardando datos de la reserva

  //? Formatea un número a peso dependiendo del pais 
  const totalFormat = new Intl.NumberFormat().format(total);

  //? Heading para servicios en resumen
  const headingServicios = document.createElement('h3');
  headingServicios.textContent = 'Resumen de Servicios';
  resumen.appendChild(headingServicios);

  
  //? Iterando y mostrando los servicios 
  servicios.forEach(servicio => {
    const {precio, tipo, tipo_cama} = servicio;
    
    //? Formatea un número a peso dependiendo del pais 
    const precioFormat = new Intl.NumberFormat().format(precio);

    const contenedorServicio = document.createElement('div');
    contenedorServicio.classList.add('contenedor-servicio');

    const tipoServicio = document.createElement('p');
    tipoServicio.innerHTML = /*html*/`<span>Tipo Habitación:</span> ${tipo}`;
    
    const precioServicio = document.createElement('p');
    precioServicio.innerHTML = /*html*/`<span>Precio:</span> $${precioFormat}`;

    const camaServicio = document.createElement('p');
    camaServicio.innerHTML = /*html*/`<span>Tipo Cama:</span> ${tipo_cama}`;

    contenedorServicio.appendChild(tipoServicio);
    contenedorServicio.appendChild(precioServicio);
    contenedorServicio.appendChild(camaServicio);

    resumen.appendChild(contenedorServicio);
  });

  //? Heading para reserva en resumen
  const headingReserva = document.createElement('h3');
  headingReserva.textContent = 'Resumen de reserva';
  resumen.appendChild(headingReserva);

  //? Formatear la fechas en español
  const fechaLlegadaObj = new Date(fechaLlegada); //* Fecha Llegada seleccionada de la reserva
  const fechaSalidaObj = new Date(fechaSalida); //* Fecha Salida seleccionada de la reserva
  const fechaLlegadaFormateada = formatearFecha(fechaLlegadaObj);
  const fechaSalidaFormateada = formatearFecha(fechaSalidaObj);

  //? Agregando datos de la reserva
  const nombreCliente = document.createElement('p');
  nombreCliente.innerHTML = /*html*/`<span>Cliente:</span> ${nombre}`;

  const entradaReserva = document.createElement('p');
  entradaReserva.innerHTML = /*html*/`<span>Fecha Llegada:</span> ${fechaLlegadaFormateada}`;

  const salidaReserva = document.createElement('p');
  salidaReserva.innerHTML = /*html*/`<span>Fecha Salida:</span> ${fechaSalidaFormateada}`;

  const costoReserva = document.createElement('p');
  costoReserva.innerHTML = /*html*/`<span>Costo Total:</span> $${totalFormat}`;


  //? Boton para crear una reserva
  const botonReservar = document.createElement('button');
  botonReservar.classList.add('boton');
  botonReservar.textContent = 'Reservar';
  botonReservar.onclick = reservarHabitacion; 

  resumen.appendChild(nombreCliente);
  resumen.appendChild(entradaReserva);
  resumen.appendChild(salidaReserva);
  resumen.appendChild(costoReserva);

  resumen.appendChild(botonReservar);

}

function formatearFecha(fecha){
  //* 'long' formatea la fecha a palabra y 'numeric' a número. '2-digit' establece a dos digitos la hora
  const opciones = { 
    weekday: 'long', 
    year: 'numeric', 
    month: 'long', 
    day: 'numeric', 
    hour: '2-digit', 
    minute: '2-digit', 
  }


  //* UTC() devuelve la fecha con el estándar de tiempo del meridiano de greenwich
  // const fechaUTC = new Date(Date.UTC(anio,mes,dia,horas,minutos));
  const fechaFormateada = fecha.toLocaleString([],opciones);
  // console.log(fechaFormateada);

  return fechaFormateada;
}

async function reservarHabitacion(){
  const {id, fechaLlegada, fechaSalida, servicios, subtotal, total} = reserva; 

  const tipoServicios = servicios.map(servicio => `Habitación ${servicio.tipo}`).join(', ');
  console.log(tipoServicios);

  const datos = new FormData(); 
  datos.append('servicios',tipoServicios);
  datos.append('fecha_llegada',fechaLlegada);
  datos.append('fecha_salida',fechaSalida);
  datos.append('subtotal',subtotal);
  datos.append('total',total);
  // datos.append('cliente_id',id);
  // console.log([...datos]);

  //* Petición hacia la API
  const url = 'http://127.0.0.1:3000/api/reservas';
  const respuesta = await fetch(url,{
    method: 'POST',
    body: datos,
  }); 
  const resultado = await respuesta.json();
  console.log(resultado);

  try {
    if (resultado.resultado) { //* Si se reserva una reserva correctamente...
      Swal.fire({
        icon: 'success',
        title: 'reserva Creada',
        text: 'Tu reserva fue creada correctamente',
        button: 'OK',
        customClass: {
          popup: 'modal',
          title: 'modal-title',
          htmlContainer: 'modal-warning',
          actions: 'modal-btns',
          confirmButton: 'modal-btn-confirm',
        }
      })
      .then(() => {
        setTimeout(() => {
          location.reload(); //* Recargando página
        }, 2000);
      });
    }
  } catch (error) {
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: 'Hubo un error al guardar la reserva',
    })
  }

}

function  mostrarAlerta(mensaje,tipo, elemento,desaparece = true){
  //? Previniendo que se genera más de una alerta de error 
  const alertaPrevia = document.querySelector('.alerta');
  if (alertaPrevia) alertaPrevia.remove(); //* Si ya existe una alerta para el input se elimina
  
  //? Scripting para crear la alerta 
  const alerta = document.createElement('div');
  alerta.textContent = mensaje;
  alerta.classList.add('alerta',tipo);

  const referencia = document.querySelector(elemento);
  referencia.appendChild(alerta);

  if (desaparece) {
    setTimeout(() => {
      referencia.removeChild(alerta);
    }, 3000);
  }
}

function limpiarHTML($elemento) {
  while ($elemento.firstElementChild) {
    $elemento.firstElementChild.remove();
  }
}