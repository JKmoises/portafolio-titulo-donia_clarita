let paso=1;const pasoInicial=1,pasoFinal=3,reserva={id:"",nombre:"",fechaLlegada:"",fechaSalida:"",subtotal:0,total:0,servicios:[]};function iniciarApp(){mostrarSeccion(),tabs(),botonesPaginador(),paginaAnterior(),paginaSiguiente(),consultaAPI(),idCliente(),nombreCliente(),seleccionarFechaLlegada(),seleccionarFechaSalida(),mostrarResumen()}function mostrarSeccion(){const e=document.querySelector(".mostrar");e&&e.classList.remove("mostrar");document.querySelector("#paso-"+paso).classList.add("mostrar");document.querySelector(".actual").classList.remove("actual");document.querySelector(`[data-paso="${paso}"]`).classList.add("actual")}function tabs(){document.querySelectorAll(".tabs button").forEach(e=>{e.addEventListener("click",e=>{paso=parseInt(e.target.dataset.paso),mostrarSeccion(),botonesPaginador()})})}function botonesPaginador(){const e=document.querySelector("#anterior"),t=document.querySelector("#siguiente");1===paso?(e.classList.add("ocultar"),t.classList.remove("ocultar")):2===paso?(e.classList.remove("ocultar"),t.classList.remove("ocultar")):3===paso&&(e.classList.remove("ocultar"),t.classList.add("ocultar"),mostrarResumen()),mostrarSeccion()}function paginaAnterior(){document.querySelector("#anterior").addEventListener("click",()=>{paso<=1||(paso--,botonesPaginador())})}function paginaSiguiente(){document.querySelector("#siguiente").addEventListener("click",()=>{paso>=3||(paso++,botonesPaginador())})}async function consultaAPI(){try{const e="http://127.0.0.1:3000/api/habitaciones",t=await fetch(e);mostrarServicios(await t.json())}catch(e){console.log(e)}}function mostrarServicios(e){e.forEach(e=>{const{id:t,tipo:a,precio:o,descripcion:n,tipo_cama:r}=e,i=document.createElement("p");i.classList.add("nombre-servicio","third-text-color"),i.textContent="Habitación "+a;const c=document.createElement("p");c.classList.add("precio-servicio","text-left"),c.textContent="$"+o;const s=document.createElement("p");s.classList.add("descripcion-servicio","text-left"),s.textContent=n;const l=document.createElement("p");l.classList.add("cama-servicio","text-left"),l.textContent="Cama "+r;const d=document.createElement("div");d.classList.add("servicio"),d.dataset.idServicio=t,d.onclick=()=>seleccionarServicio(e),d.appendChild(i),d.appendChild(s),d.appendChild(l),d.appendChild(c),document.querySelector("#servicios").appendChild(d)})}function seleccionarServicio(e){const{id:t,precio:a}=e,{servicios:o}=reserva,n=document.querySelector(`[data-id-servicio="${t}"]`);o.some(e=>e.id===t)?(reserva.servicios=o.filter(e=>e.id!==t),n.classList.remove("seleccionado"),reserva.total-=parseInt(a),reserva.subtotal-=parseInt(a)):(reserva.servicios=[...o,e],n.classList.add("seleccionado"),reserva.total+=parseInt(a),reserva.subtotal+=parseInt(a)),console.log(reserva)}function idCliente(){document.querySelector("#empresa").addEventListener("input",e=>{const t=parseInt(e.target.value);t?reserva.id=t:mostrarAlerta("La empresa es obligatoria","error",".formulario")})}function nombreCliente(){const e=document.querySelector("#nombre").value;reserva.nombre=e}function seleccionarFechaLlegada(){document.querySelector("#fecha_llegada").addEventListener("input",e=>{new Date(e.target.value).getUTCDay();const t=new Date(e.target.value).toLocaleTimeString([],{hour:"2-digit",minute:"2-digit"}),[a]=t.split(":"),o=e.target.value.split("T").join(" ");a<10||a>22?(mostrarAlerta("Hora no válida","error",".formulario"),e.target.value=""):reserva.fechaLlegada=o})}function seleccionarFechaSalida(){document.querySelector("#fecha_salida").addEventListener("input",e=>{new Date(e.target.value).getUTCDay();const t=new Date(e.target.value).toLocaleTimeString([],{hour:"2-digit",minute:"2-digit"}),[a]=t.split(":"),o=e.target.value.split("T").join(" ");a<10||a>22?(mostrarAlerta("Hora no válida","error",".formulario"),e.target.value=""):reserva.fechaSalida=o})}function mostrarResumen(){const e=document.querySelector(".contenido-resumen");for(;e.firstElementChild;)e.removeChild(e.firstElementChild);if(Object.values(reserva).includes("")||0===reserva.servicios.length)return void mostrarAlerta("Faltan datos de Servicios, Fecha u Hora","error",".contenido-resumen",!1);const{nombre:t,fechaLlegada:a,fechaSalida:o,subtotal:n,total:r,servicios:i}=reserva,c=document.createElement("h3");c.textContent="Resumen de Servicios",e.appendChild(c),i.forEach(t=>{const{precio:a,tipo:o,tipo_cama:n}=t,r=document.createElement("div");r.classList.add("contenedor-servicio");const i=document.createElement("p");i.innerHTML="<span>Tipo Habitación:</span> "+o;const c=document.createElement("p");c.innerHTML="<span>Precio:</span> $"+a;const s=document.createElement("p");s.innerHTML="<span>Tipo Cama:</span> "+n,r.appendChild(i),r.appendChild(c),r.appendChild(s),e.appendChild(r)});const s=document.createElement("h3");s.textContent="Resumen de reserva",e.appendChild(s);const l=new Date(a),d=new Date(o),u=formatearFecha(l),m=formatearFecha(d),p=document.createElement("p");p.innerHTML="<span>Cliente:</span> "+t;const v=document.createElement("p");v.innerHTML="<span>Fecha Llegada:</span> "+u;const h=document.createElement("p");h.innerHTML="<span>Fecha Salida:</span> "+m;const f=document.createElement("p");f.innerHTML="<span>Costo Total:</span> $"+r;const g=document.createElement("button");g.classList.add("boton"),g.textContent="Reservar",g.onclick=reservarHabitacion,e.appendChild(p),e.appendChild(v),e.appendChild(h),e.appendChild(f),e.appendChild(g)}function formatearFecha(e){return e.toLocaleString([],{weekday:"long",year:"numeric",month:"long",day:"numeric",hour:"2-digit",minute:"2-digit"})}async function reservarHabitacion(){const{id:e,fechaLlegada:t,fechaSalida:a,servicios:o,subtotal:n,total:r}=reserva,i=o.map(e=>"Habitación "+e.tipo).join(", "),c=new FormData;c.append("servicios",i),c.append("fecha_llegada",t),c.append("fecha_salida",a),c.append("subtotal",n),c.append("total",r),c.append("cliente_id",e);const s=await fetch("http://127.0.0.1:3000/api/reservas",{method:"POST",body:c}),l=await s.json();console.log(l);try{l.resultado&&Swal.fire({icon:"success",title:"reserva Creada",text:"Tu reserva fue creada correctamente",button:"OK",customClass:{popup:"modal",title:"modal-title",htmlContainer:"modal-warning",actions:"modal-btns",confirmButton:"modal-btn-confirm"}}).then(()=>{setTimeout(()=>{location.reload()},2e3)})}catch(e){Swal.fire({icon:"error",title:"Error",text:"Hubo un error al guardar la reserva"})}}function mostrarAlerta(e,t,a,o=!0){const n=document.querySelector(".alerta");n&&n.remove();const r=document.createElement("div");r.textContent=e,r.classList.add("alerta",t);const i=document.querySelector(a);i.appendChild(r),o&&setTimeout(()=>{i.removeChild(r)},3e3)}document.addEventListener("DOMContentLoaded",()=>iniciarApp());
//# sourceMappingURL=cliente.js.map
