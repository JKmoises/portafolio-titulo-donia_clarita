<?php 
namespace Controllers;

use Model\Usuario;
use MVC\Router;

class UsuarioController{
  
  public static function listar(Router $router){
    session_start();

    isAdmin(); # Protegiendo esta ruta para que solo sea accesible para el admin

    $usuarios = Usuario::all('id'); # Guardando todos los registros de las usuarios
    // debuguear($usuarios);

    //* Esto quiere decir que devuelve el valor del name 'resultado' y si no existe devuelve null
    $resultado = $_GET["resultado"] ?? null;
    // debuguear($resultado);
    
    $router->render('usuarios/listar',[
      'nombre' => $_SESSION['nombre'],
      'rol' => $_SESSION['rol'],
      'usuarios' => $usuarios,
      'resultado' => $resultado,
    ]);
  }

  public static function actualizar(Router $router){
    session_start();
    // debuguear($_SESSION);

    isAdmin(); # Protegiendo esta ruta para que solo sea accesible para el admin

    $roles = ['Cliente','Empleado','Proveedor'];


    //*  Retornando id del registro a actualizar si no existe se redirecciona a /habitaciones
    $id = validarORedireccionar('usuarios'); 
    // debuguear($id);

    //* Obtener los datos de la propiedad segun id
    $usuario = Usuario::find($id); # Objeto según id de la Clase Usuario
    // debuguear($usuario);


    //* Arreglo con mensajes de alertas
    $alertas = Usuario::getAlertas();

    //* Ejecuta el código después de que el usuario envía el formulario.
    if ($_SERVER["REQUEST_METHOD"] === 'POST') { #  Si el metodo usado para enviar el formulario es 'POST'
      // debuguear($_POST);
      //* Asignando los atributos con sus valores al arreglo para sincronizar el objeto del id a actualizar
      $args = $_POST["usuario"];
      
      $usuario->sincronizar($args); # Sincronizando objeto segun id para actualizar datos del registro
      // debuguear($usuario);  

      //* Validando entradas del formulario
      $alertas = $usuario->validar();

      //* Revisar que el array de alertas esté vacío
      if (empty($alertas)) { # Si el arreglo $alertas está vacío...
    
        $usuario->guardar(); # Actualizando registro de usuario 

        header('Location: /usuarios?resultado=2');
      }
    }
    
    $router->render('usuarios/actualizar',[
      'nombre' => $_SESSION['nombre'],
      'rol' => $_SESSION['rol'],
      'usuario' => $usuario,
      'alertas' => $alertas,
      'rutaVista' => '/usuarios',
      'roles' => $roles,
    ]);
  }

  public static function eliminar(){
     //* Ejecuta el código después de que el usuario envía el formulario.
     if ($_SERVER["REQUEST_METHOD"] === 'POST') { #  Si el metodo usado para enviar el formulario es 'POST'
      // debuguear($_POST);

      $id = $_POST["id"]; # Guardando Id de una usuario en el name 'id'
      $id = filter_var($id, FILTER_VALIDATE_INT); # Validando que el id sea un entero
      
      if ($id) { # Si existe un id guardado en el name 'id'...

        //* Obtener los datos de la usuario segun id
        $usuario = Usuario::find($id); # Objeto según id de la Clase Habitacion
        // debuguear($usuario);
        $resultado = $usuario->eliminar(); # Eliminando registro de usuario

        if ($resultado) {
          header('Location: /usuarios?resultado=3');
        }
        
      }
  
    }
    
  }
}