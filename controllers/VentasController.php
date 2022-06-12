<?php 
namespace Controllers;

use Classes\Reporte;
use Model\OrdenCompra;
use MVC\Router;

class VentasController{

  public static function listar(Router $router){
    session_start();

    isAuth(); # Protegiendo esta ruta

    $ventas =OrdenCompra::all('fecha_llegada'); # Guardando todos los registros de las ventas
    // debuguear($ventas);


    $router->render('/ventas/listar', [
      'nombre' => $_SESSION['nombre'],
      'rol' => $_SESSION['rol'],
      'ventas' => $ventas,
      'titulo' => 'Ventas',
    ]);
  }

  public static function mostrarVentasPdf(Router $router){
    session_start();

    isAuth(); # Protegiendo esta ruta
    
    $ventas = OrdenCompra::all('id'); # Guardando todos los registros de las ventas
    // debuguear($ventas);

    //* Almacena en memoria del Buffer que es la vista a renderizar
    ob_start();
    include_once __DIR__ . "/../views/ventas/reportes.php"; # Importando vista

    $vistaPdf = ob_get_clean();
    // debuguear($vistaPdf);
    
    $reporte = new Reporte($vistaPdf,'Reporte ventas');
    // debuguear($reporte);
    
    $reporte->generarReporte();
    
  }
}