<?php 
namespace Controllers;

use Model\Cliente;
use MVC\Router;

class ClienteController{

  public static function listar(Router $router){
    session_start();

    isAuth(); # Protegiendo esta ruta

    $clientes = Cliente::all('rut_empresa'); # Guardando todos los registros de las clientes
    // debuguear($clientes);

    //* Esto quiere decir que devuelve el valor del name 'resultado' y si no existe devuelve null
    $resultado = $_GET["resultado"] ?? null;
    // debuguear($resultado);
    
    $router->render('/clientes/listar',[
      'nombre' => $_SESSION['nombre'],
      'rol' => $_SESSION['rol'],
      'clientes' => $clientes,
      'resultado' => $resultado,
    ]);
  }

  public static function actualizar(Router $router){
    
  }

  public static function eliminar(){
    
  }
  
}