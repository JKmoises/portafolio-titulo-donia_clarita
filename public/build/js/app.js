function iniciarApp(){mostrarConfirmacion(),colapsarMenu()}function mostrarConfirmacion(){document.querySelectorAll(".formulario-eliminar").forEach(t=>{t.addEventListener("submit",t=>{t.preventDefault(),modalConfirmacion(t.target,"¿Estas seguro que quieres eliminar un usuario?")})})}function colapsarMenu(){const t=document.querySelector(".panel-admin"),e=document.querySelector(".boton-menu"),n=document.querySelectorAll(".navegacion summary");let o=[];hoverBtnMenu(e,"&larr;","Menú de Administración"),e.addEventListener("click",a=>{t.style.gridTemplateColumns="10% 90%",n.forEach((n,a)=>{o=[...o,n.lastChild.textContent],n.parentElement.classList.contains("active")?(hoverBtnMenu(e,"&larr;","Menú de Administración"),t.style.gridTemplateColumns="20% 80%",n.lastChild.textContent=o[a],n.parentElement.classList.remove("active"),n.nextElementSibling.classList.remove("active")):(hoverBtnMenu(e,"&rarr;","&rarr;"),n.lastChild.textContent="",n.parentElement.classList.add("active"),n.nextElementSibling.classList.add("active"))})})}function hoverBtnMenu(t,e,n){t.style.transition="all 0.4s ease-in",t.addEventListener("mouseover",t=>{t.target.style.fontSize="1.6rem",t.target.style.fontWeight="700",t.target.innerHTML=e}),t.addEventListener("mouseout",t=>{t.target.style.fontSize="1.6rem",t.target.innerHTML=n})}function modalConfirmacion(t,e){Swal.fire({title:e,text:"¡No podrás revertir esto!",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"¡Si, Elimínalo!",cancelButtonText:"Cancelar",customClass:{popup:"modal",icon:"modal-icon",title:"modal-title",htmlContainer:"modal-warning",actions:"modal-btns",confirmButton:"modal-btn-confirm",cancelButton:"modal-btn-cancel"}}).then(e=>{e.isConfirmed&&t.submit()})}document.addEventListener("DOMContentLoaded",iniciarApp);
//# sourceMappingURL=app.js.map
