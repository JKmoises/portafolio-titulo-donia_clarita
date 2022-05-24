<?php 
namespace Controllers;

use Model\Cliente;
use Model\Habitacion;
use MVC\Router;

class ReservasController{
  
  public static function listar(Router $router){
    session_start();

    isAuth(); # Protegiendo esta ruta

    $habitaciones = Habitacion::all('id'); # Guardando todos los registros de las habitaciones
    // debuguear($habitaciones);


    $router->render('/reservas/listar',[
      'nombre' => $_SESSION['nombre'],
      'rol' => $_SESSION['rol'],
      'habitaciones' => $habitaciones,
    ]);
  }

  public static function crear(Router $router){
    session_start();

    isAuth(); # Protegiendo esta ruta

    //* Obtener todos los clientes registrados
    $clientes = Cliente::all('rut_empresa'); 

    //*  Retornando id del registro a actualizar si no existe se redirecciona a /reservas
    $id = validarORedireccionar('reservas'); 
    // debuguear($id);

    //* Obtener los datos de la propiedad segun id
    $habitacion = Habitacion::find($id); # Objeto según id de la Clase Habitacion
    // debuguear($habitacion);

    //* Obtener clase de un color en especifico segun el estado de la habitacion 
    if ($habitacion->estado === 'Disponible') {
      $estadoClass = 'disponible';
    }else if($habitacion->estado === 'Ocupada'){
      $estadoClass = 'ocupada';
    }else if($habitacion->estado === 'Reservada'){
      $estadoClass = 'reservada';
    }else{
      $estadoClass = 'mantenimiento';
    }
    // debuguear($estadoClass);

    //* Instanciando objeto de la clase Propiedades para tener sus atributos con valores por defecto
     $cliente = new Cliente(); # Ahora el objeto existe antes de que se envíe el formulario

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

        header('Location: /reservas?resultado=1');
      
       }
     }

    $router->render('/reservas/disponible',[
      'nombre' => $_SESSION['nombre'],
      'rol' => $_SESSION['rol'],
      'habitacion' => $habitacion,
      'cliente' => $cliente,
      'alertas' => $alertas,
      'rutaVista' => '/reservas',
      'estadoClass' => $estadoClass,
      'clientes' => $clientes,
    ]);
  }
}