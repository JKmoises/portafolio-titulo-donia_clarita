<?php
namespace Controllers;

use MVC\Router;

class EstadisticasController{
  
  public static function mostrarEstadisticas(Router $router){
    session_start();

    isAuth(); # Protegiendo esta ruta
    
    $router->render('/estadisticas/reportes',[
      'nombre' => $_SESSION['nombre'],
      'rol' => $_SESSION['rol'],
    ]);
  }
}