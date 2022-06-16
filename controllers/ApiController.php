<?php 
namespace Controllers;

use Model\Habitacion;
use Model\OrdenCompra;

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

  public static function datosVentaPorMes(){
    $ventasMes = OrdenCompra::group(
      "TO_CHAR(FECHA_SALIDA,'MM') MES, SUM(TOTAL) VENTA_MES",
      "TO_CHAR(FECHA_SALIDA,'MM')",
      "MES"
    );
    // debuguear($ventasMes);

    //* Retornamos una respuesta
    echo json_encode($ventasMes);
  }

  public static function nroHabitacionesEstado(){
    $habitacionesEstado = Habitacion::group(
      "ESTADO, COUNT(ESTADO) NRO_HABITACIONES",
      "ESTADO",
      "ESTADO",
    );
    // debuguear($habitacionesEstado);

    // * Retornamos una respuesta
    echo json_encode($habitacionesEstado);
  }
}