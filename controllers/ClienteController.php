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

  public static function crear(Router $router){
    session_start();
    // debuguear($_SESSION);

    isAuth(); # Protegiendo esta ruta para que sea accesible solo a los loagueados

     //* Instanciando objeto de la clase Propiedades para tener sus atributos con valores por defecto
     $cliente = new Cliente; # Ahora el objeto existe antes de que se envíe el formulario

     //* Arreglo con mensajes de alertas
     $alertas = Cliente::getAlertas();  

     //*  Ejecuta el código después de que el usuario envía el formulario.
     if ($_SERVER["REQUEST_METHOD"] === 'POST') { # Si el metodo usado para enviar el formulario es 'POST'
      //  debuguear($_POST);

       //? Creación de nueva instancia 
       $cliente = new Cliente($_POST["cliente"]);#Como argumento recibe el arreglo con los datos enviados 
      //  debuguear($cliente);
 
       //? Validacion de datos insertados
       $alertas = $cliente->validar(); # Validando los datos que se pueden insertar en la BD
        // debuguear($alertas);
 
       //? Si no hay errores de validación...
       if (empty($alertas)) { # Si el arreglo $alertas está vacío...
         
        $cliente->guardar(); # Insertando registro en la BD

        header('Location: /clientes?resultado=1');
      
       }
     }
     
    $router->render('/clientes/crear',[
      'nombre' => $_SESSION['nombre'],
      'rol' => $_SESSION['rol'],
      'cliente' => $cliente,
      'alertas' => $alertas,
      'rutaVista' => '/clientes',
    ]);
  }

  public static function actualizar(Router $router){
    
  }

  public static function eliminar(){
    
  }
  
}