<?php

function debuguear($variable) : string {
  echo "<pre>";
  var_dump($variable);
  echo "</pre>";
  exit;
}

//* Escapa / Sanitizar el HTML
function s($html) : string {
  $s = htmlspecialchars($html);
  return $s;
}

//* Revisa que el usuario esté autenticado
function isAuth(): void{
  if (!isset($_SESSION['login'])) { # Si el usuario no está autenticado...
    header('Location: /');
  }
}

function isAdmin(): void{
  if ($_SESSION['rol'] !== 'Admin') { # Si el usuario no es admin...
    header('Location: /');
  }
}

//* Validar que se pueda eliminar un registro de propiedad o de vendedor
function validarTipoContenido($tipo){
  $tipos = ['huesped','habitacion'];

  return in_array($tipo,$tipos); //* Buscando tipo en el arreglo, si existe devuelve true
}

//* Muestra los mensajes o alertas del CRUD
function mostrarNotificacion($codigo){
  $mensaje = '';

  switch ($codigo) {
    case 1:
      $mensaje = 'Creado correctamente';
      break;
    case 2:
      $mensaje = 'Actualizado correctamente';
      break;
    case 3:
      $mensaje = 'Eliminado correctamente';
      break;
    default:
      $mensaje = false;
      break;
  }

  return $mensaje;
}

//*  Validar la URL por id válido.
function validarORedireccionar(string $url){
  $id = $_GET["id"]; # Obteniendo id del registro a actualizar de la tabla.
  // debuguear($id);
  $id = filter_var($id, FILTER_VALIDATE_INT); # Validando si el id del registro es un entero.
  // debuguear($id);

  if (!$id) { # Si el id evaluado no es válido...
    header("Location: /{$url}"); # Redireccionando a la pagina que se indique como argumento en la función.
  }

  return $id;

}