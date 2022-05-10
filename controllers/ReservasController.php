<?php 
namespace Controllers;

use Model\Habitacion;
use MVC\Router;

class ReservasController{
  
  public static function listar(Router $router){
    session_start();

    isAuth(); # Protegiendo esta ruta

    $habitaciones = Habitacion::all('id'); # Guardando todos los registros de las habitaciones
    // debuguear($habitaciones);


    $router->render('/habitaciones/reservar',[
      'nombre' => $_SESSION['nombre'],
      'rol' => $_SESSION['rol'],
      'habitaciones' => $habitaciones,
    ]);
  }
}