<?php
namespace Controllers;

use Model\OrdenCompra;
use Model\Usuario;
use MVC\Router;

class EstadisticasController{
  
  public static function mostrarEstadisticas(Router $router){
    session_start();

    isAuth(); # Protegiendo esta ruta

    $registrados = Usuario::count('registrados','*');
    $ganancias = OrdenCompra::sum('ganancias','total');
    $clientes = Usuario::count('total_clientes','rol', 'Cliente');
    // debuguear($registrados);
    // debuguear($ganancias);
    // debuguear($clientes);

    $ganancias = number_format($ganancias['ganancias'],0,',','.');
    
    $router->render('/estadisticas/reportes',[
      'nombre' => $_SESSION['nombre'],
      'rol' => $_SESSION['rol'],
      'registrados' => $registrados['registrados'],
      'ganancias' => $ganancias,
      'clientes' => $clientes['total_clientes'],
    ]);
  }
}