<?php 
namespace Controllers;

use Model\Huesped;
use MVC\Router;

class HuespedController{
  
  public static function listar(Router $router){
    session_start();

    isAuth(); # Protegiendo esta ruta

    $huespedes = Huesped::all('rut_huesped'); # Guardando todos los registros de las huespedes
    // debuguear($huespedes);

    //* Esto quiere decir que devuelve el valor del name 'resultado' y si no existe devuelve null
    $resultado = $_GET["resultado"] ?? null;
    // debuguear($resultado);
    
    $router->render('/huespedes/listar',[
      'nombre' => $_SESSION['nombre'],
      'rol' => $_SESSION['rol'],
      'huespedes' => $huespedes,
      'resultado' => $resultado,
    ]);
  }

  public static function crear(Router $router){
    session_start();
    // debuguear($_SESSION);

    isAuth(); # Protegiendo esta ruta para que sea accesible solo a los loagueados

     //* Instanciando objeto de la clase Propiedades para tener sus atributos con valores por defecto
     $huesped = new Huesped; # Ahora el objeto existe antes de que se envíe el formulario

     //* Arreglo con mensajes de alertas
     $alertas = Huesped::getAlertas();  

     //*  Ejecuta el código después de que el usuario envía el formulario.
     if ($_SERVER["REQUEST_METHOD"] === 'POST') { # Si el metodo usado para enviar el formulario es 'POST'
      //  debuguear($_POST);

       //? Creación de nueva instancia 
       $huesped = new Huesped($_POST["huesped"]);#Como argumento recibe el arreglo con los datos enviados 
      //  debuguear($huesped);
 
       //? Validacion de datos insertados
       $alertas = $huesped->validar(); # Validando los datos que se pueden insertar en la BD
        // debuguear($alertas);
 
       //? Si no hay errores de validación...
       if (empty($alertas)) { # Si el arreglo $alertas está vacío...
         
        $huesped->guardar(); # Insertando registro en la BD

        header('Location: /huespedes?resultado=1');
      
       }
     }
     
    $router->render('/huespedes/crear',[
      'nombre' => $_SESSION['nombre'],
      'rol' => $_SESSION['rol'],
      'huesped' => $huesped,
      'alertas' => $alertas,
      'rutaVista' => '/huespedes',
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
    $huesped = Huesped::where('rut_empresa',$id); # Objeto según id de la Clase Huesped
    // debuguear($huesped);

    //* Arreglo con mensajes de alertas
    $alertas = Huesped::getAlertas();

    //* Ejecuta el código después de que el usuario envía el formulario.
    if ($_SERVER["REQUEST_METHOD"] === 'POST') { #  Si el metodo usado para enviar el formulario es 'POST'
      // debuguear($_POST);  

      //* Asignando los atributos con sus valores al arreglo para sincronizar el objeto del id a actualizar
      $args = $_POST["huesped"];
      
      $huesped->sincronizar($args); # Sincronizando objeto segun id para actualizar datos del registro
      // debuguear($huesped);  

      //* Validando entradas del formulario
      $alertas = $huesped->validar();

      //* Revisar que el array de alertas esté vacío
      if (empty($alertas)) { # Si el arreglo $alertas está vacío...
    
        $huesped->guardar('rut_empresa'); # Actualizando registro de huesped 

        header('Location: /huespedes?resultado=2');
      }
    }
    
    $router->render('/huespedes/actualizar',[
      'nombre' => $_SESSION['nombre'],
      'rol' => $_SESSION['rol'],
      'huesped' => $huesped,
      'alertas' => $alertas,
      'rutaVista' => '/huespedes',
    ]);
  }

  public static function eliminar(){
    //* Ejecuta el código después de que el usuario envía el formulario.
    if ($_SERVER["REQUEST_METHOD"] === 'POST') { #  Si el metodo usado para enviar el formulario es 'POST'
      // debuguear($_POST);

      $id = $_POST["id"]; # Guardando Id de una huesped en el name 'id'
      $id = filter_var($id, FILTER_VALIDATE_INT); # Validando que el id sea un entero

      if ($id) { # Si existe un id guardado en el name 'id'...
        //* Obtener los datos de la huesped segun id
        $huesped = Huesped::where('rut_empresa',$id); # Objeto según id de la Clase huesped
        // debuguear($huesped);
        $resultado = $huesped->eliminar('rut_empresa'); # Eliminando registro de huesped

        if ($resultado) {
          header('Location: /huespedes?resultado=3');
        }
        
      }
  
    }
  }
}