<?php 
namespace Controllers;

use Model\Habitacion;
use Model\Huesped;
use MVC\Router;

class HabitacionController{
  public static function listar(Router $router){
    session_start();

    isAuth(); # Protegiendo esta ruta

    $habitaciones = Habitacion::all('id'); # Guardando todos los registros de las habitaciones
    // debuguear($habitaciones);

    //* Esto quiere decir que devuelve el valor del name 'resultado' y si no existe devuelve null
    $resultado = $_GET["resultado"] ?? null;
    // debuguear($resultado);


    $router->render('/habitaciones/listar',[
      'nombre' => $_SESSION['nombre'],
      'rol' => $_SESSION['rol'],
      'habitaciones' => $habitaciones,
      'resultado' => $resultado,
    ]);
  }
  


  public static function crear(Router $router){
    session_start();
    // debuguear($_SESSION);

    isAuth(); # Protegiendo esta ruta para que sea accesible solo a los loagueados

    $estados = ['Disponible','Ocupada','Reservada','Mantenimiento'];
    $camas = ['Individual','Doble','KingSize','QueenSize'];

     //* Instanciando objeto de la clase Propiedades para tener sus atributos con valores por defecto
     $habitacion = new Habitacion; # Ahora el objeto existe antes de que se envíe el formulario

     //* Arreglo con mensajes de alertas
     $alertas = Habitacion::getAlertas();  

     //*  Ejecuta el código después de que el usuario envía el formulario.
     if ($_SERVER["REQUEST_METHOD"] === 'POST') { # Si el metodo usado para enviar el formulario es 'POST'
      //  debuguear($_POST);

       //? Creación de nueva instancia 
       $habitacion = new Habitacion($_POST["habitacion"]);#Como argumento recibe el arreglo con los datos enviados 
      //  debuguear($habitacion);
 
       //? Validacion de datos insertados
       $alertas = $habitacion->validar(); # Validando los datos que se pueden insertar en la BD
        // debuguear($alertas);
 
       //? Si no hay errores de validación...
       if (empty($alertas)) { # Si el arreglo $alertas está vacío...
         
        $habitacion->guardar(); # Insertando registro en la BD

        header('Location: /habitaciones?resultado=1');
      
       }
     }

    $router->render('/habitaciones/crear',[
      'nombre' => $_SESSION['nombre'],
      'rol' => $_SESSION['rol'],
      'habitacion' => $habitacion,
      'alertas' => $alertas,
      'rutaVista' => '/habitaciones',
      'estados' => $estados,
      'camas' => $camas,
    ]);
  }

  public static function actualizar(Router $router){
    session_start();
    // debuguear($_SESSION);

    isAuth(); # Protegiendo esta ruta para que sea accesible solo a los loagueados

    $estados = ['Disponible','Ocupada','Reservada','Mantenimiento'];
    $camas = ['Individual','Doble','KingSize','QueenSize'];
    
    //*  Retornando id del registro a actualizar si no existe se redirecciona a /habitaciones
    $id = validarORedireccionar('habitaciones'); 
    // debuguear($id);

    //* Obtener los datos de la propiedad segun id
    $habitacion = Habitacion::find($id); # Objeto según id de la Clase Habitacion
    // debuguear($habitacion);

    //* Arreglo con mensajes de alertas
    $alertas = Habitacion::getAlertas();

    //* Ejecuta el código después de que el usuario envía el formulario.
    if ($_SERVER["REQUEST_METHOD"] === 'POST') { #  Si el metodo usado para enviar el formulario es 'POST'
      // debuguear($_POST);

      //* Asignando los atributos con sus valores al arreglo para sincronizar el objeto del id a actualizar
      $args = $_POST["habitacion"];
      
      $habitacion->sincronizar($args); # Sincronizando objeto segun id para actualizar datos del registro
      // debuguear($habitacion);  

      //* Validando entradas del formulario
      $alertas = $habitacion->validar();

      //* Revisar que el array de alertas esté vacío
      if (empty($alertas)) { # Si el arreglo $alertas está vacío...
    
        $habitacion->guardar('id'); # Actualizando registro de habitacion 

        header('Location: /habitaciones?resultado=2');
      }
    }
    
    $router->render('/habitaciones/actualizar',[
      'nombre' => $_SESSION['nombre'],
      'rol' => $_SESSION['rol'],
      'habitacion' => $habitacion,
      'alertas' => $alertas,
      'rutaVista' => '/habitaciones',
      'estados' => $estados,
      'camas' => $camas,
    ]);
  }

  public static function eliminar(){

    //* Ejecuta el código después de que el usuario envía el formulario.
    if ($_SERVER["REQUEST_METHOD"] === 'POST') { #  Si el metodo usado para enviar el formulario es 'POST'
      // debuguear($_POST);

      $id = $_POST["id"]; # Guardando Id de una habitacion en el name 'id'
      $id = filter_var($id, FILTER_VALIDATE_INT); # Validando que el id sea un entero
      
      
      if ($id) { # Si existe un id guardado en el name 'id'...
        $tipo = $_POST["tipo"]; # Guardando tipo(que se eliminará, la habitacion o el vendedor)
        // debuguear($tipo);

        if (validarTipoContenido($tipo)) { # Si el tipo es habitacion o huesped...
          //* Obtener los datos de la habitacion segun id
          $habitacion = Habitacion::find($id); # Objeto según id de la Clase Habitacion
          // debuguear($habitacion);
          $resultado = $habitacion->eliminar(); # Eliminando registro de habitacion

          if ($resultado) {
            header('Location: /habitaciones?resultado=3');
          }
        }
      }
  
    }
  }
}