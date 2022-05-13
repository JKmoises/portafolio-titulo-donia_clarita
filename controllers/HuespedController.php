<?php 
namespace Controllers;

use MVC\Router;

class HuespedController{
  
  public static function listar(Router $router){
    
    $router->render('/huespedes/listar',[

    ]);
  }

  public static function actualizar(Router $router){
    
  }

  public static function eliminar(){
    
  }
}