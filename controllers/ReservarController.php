<?php 
namespace Controllers;

use Model\Cliente;
use MVC\Router;

class ReservarController{
  
  public static function index(Router $router){  
    session_start(); # Iniciando sesión
    // debuguear($_SESSION);

    isAuth(); # Protegiendo esta ruta

    //* Obtener todos los clientes registrados
    $clientes = Cliente::all('rut_empresa');
   
    $router->render('reservar/index',[
      'id' => $_SESSION['id'],
      'nombre' => $_SESSION['nombre'],
      'clientes' => $clientes,
    ]);
  }
}