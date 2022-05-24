<?php 
namespace Controllers;

use Model\Habitacion;
use Model\OrdenCompra;
use MVC\Router;

class ApiController{
  
  public static function index(){
    $servicios = Habitacion::where('estado','Disponible'); # Guardando todos los servicios disponibles
    // debuguear($servicios);

    echo json_encode($servicios); # Transformando arreglo asociativo a JSON
  }

  public static function guardar(){
    //* Almacena la reserva y devuelve el id 
    $reserva = new OrdenCompra($_POST);
    $resultado = $reserva->registrarReserva();
    
    //* Retornamos una respuesta 
    $respuesta = [
      'resultado' => $resultado,
    ]; 

  
    echo json_encode($respuesta);


  }
}