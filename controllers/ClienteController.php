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
    session_start();
    // debuguear($_SESSION);

    isAuth(); # Protegiendo esta ruta para que sea accesible solo a los loagueados
    
    //*  Retornando id del registro a actualizar si no existe se redirecciona a /habitaciones
    $id = validarORedireccionar('habitaciones'); 
    // debuguear($id);

    //* Obtener los datos de la propiedad segun id
    $cliente = Cliente::where('rut_empresa',$id); # Objeto según id de la Clase Cliente
    // debuguear($cliente);

    //* Arreglo con mensajes de alertas
    $alertas = Cliente::getAlertas();

    //* Ejecuta el código después de que el usuario envía el formulario.
    if ($_SERVER["REQUEST_METHOD"] === 'POST') { #  Si el metodo usado para enviar el formulario es 'POST'
      // debuguear($_POST);  

      //* Asignando los atributos con sus valores al arreglo para sincronizar el objeto del id a actualizar
      $args = $_POST["cliente"];
      
      $cliente->sincronizar($args); # Sincronizando objeto segun id para actualizar datos del registro
      // debuguear($cliente);  

      //* Validando entradas del formulario
      $alertas = $cliente->validar();

      //* Revisar que el array de alertas esté vacío
      if (empty($alertas)) { # Si el arreglo $alertas está vacío...
    
        $cliente->guardar('rut_empresa'); # Actualizando registro de cliente 

        header('Location: /clientes?resultado=2');
      }
    }
    
    $router->render('/clientes/actualizar',[
      'nombre' => $_SESSION['nombre'],
      'rol' => $_SESSION['rol'],
      'cliente' => $cliente,
      'alertas' => $alertas,
      'rutaVista' => '/clientes',
    ]);
  }

  public static function eliminar(){
    //* Ejecuta el código después de que el usuario envía el formulario.
    if ($_SERVER["REQUEST_METHOD"] === 'POST') { #  Si el metodo usado para enviar el formulario es 'POST'
      // debuguear($_POST);

      $id = $_POST["id"]; # Guardando Id de una cliente en el name 'id'
      $id = filter_var($id, FILTER_VALIDATE_INT); # Validando que el id sea un entero

      if ($id) { # Si existe un id guardado en el name 'id'...
        //* Obtener los datos de la cliente segun id
        $cliente = Cliente::where('rut_empresa',$id); # Objeto según id de la Clase Cliente
        // debuguear($cliente);
        $resultado = $cliente->eliminar('rut_empresa'); # Eliminando registro de cliente

        if ($resultado) {
          header('Location: /clientes?resultado=3');
        }
        
      }
  
    }
  }
  
}