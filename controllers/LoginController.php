<?php 
namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController{
  
  public static function login(Router $router){
    $alertas = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
      $auth = new Usuario($_POST); //* Pasando el email y password a la instancia
      // debuguear($auth);

      $alertas = $auth->validarLogin(); # Validando login y Guardando alertas en caso de haberlas

      //* Revisar que el arreglo de alertas este vacio
      if (empty($alertas)) {
        //* Comprobar que exista el usuario
        $usuario = Usuario::where('email', $auth->email);  # Devuelve null si no existe el usuario
        // debuguear($usuario);

        if ($usuario) { # Si el usuario está registrado
          //* Verificar que el password es correcto y el usuario registrado esté confirmado
          if($usuario->comprobarPasswordAndVerificado($auth->password)){  
            //* Autenticar el usuario 
            session_start();

            # Guardando id del usuario autenticado en la sesión
            $_SESSION['id'] = $usuario->id; 
            # Guardando nombre y apellido del usuario autenticado en la sesión
            $_SESSION['nombre'] = "{$usuario->nombre} {$usuario->apellido}"; 
            # Guardando empresa del usuario autenticado en la sesión
            $_SESSION['empresa'] = $usuario->empresa; 
            # Guardando email del usuario autenticado en la sesión
            $_SESSION['email'] = $usuario->email; 
            # Guardando true en la sesión para indicar que se autenticó un usuario en
            $_SESSION['login'] = true; 
            $_SESSION['rol'] = $usuario->rol ?? null; # Guardando rol en la sesión sino null
            // debuguear($_SESSION);
            
            //* Redireccionamiento
            if ($usuario->rol === "Admin") { # Si el usuario autenticado es admin...
              header('Location: /estadisticas'); 
            }else if($usuario->rol === "Cliente"){ 
              header('Location: /reservar'); 
            }else if ($usuario->rol === "Empleado") {
              header('Location: /habitaciones'); 
            }else if($usuario->rol === "Proveedor"){
              header('Location: /habitaciones');
            }else{
              header('Location: /');
            }
          } 
          
        }else{ # Si el usuario no está registrado
          Usuario::setAlerta('error','Usuario no encontrado');
        }
      }
    }

    $alertas = Usuario::getAlertas(); # Añadiendo alerta de que el email y password no son válidos

    $router->render('auth/login',[
      'alertas' => $alertas,
    ]);
  }

  public static function logout(Router $router){
    session_start();
    
    $_SESSION = []; # Borrando sesion
    // debuguear($_SESSION);

    header('Location: /');
  }

  public static function olvide(Router $router){
    
    $router->render('auth/olvide-password',[

    ]);
  }
  
  public static function recuperar(Router $router){
    echo 'Desde Recuperar';
  }

  public static function crear(Router $router){
    $usuario = new Usuario(); # Instancia de usuario

    $alertas = []; # Alertas vacías
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $usuario->sincronizar($_POST); # Agregando valores a la instancia de usuario
      $alertas = $usuario->validar(); # Validando formulario para registrar un usuario y guardando alertas
      // debuguear($usuario);

      //* Revisar que el arreglo de alertas este vacio
      if (empty($alertas)) {
        //* Verificar que el usuario no esté registrado y retornando resultado
        $resultado = $usuario->existeUsuario();

        if ($resultado) { # Si ya existe el correo a registrar en la BD...
          $alertas = Usuario::getAlertas(); # Añadiendo alerta de que el usuario ya existe la BD
        }else{ # Si no existe el correo a registrar en la BD...
          //* Hashear el password 
          $usuario->hashPassword();
          
          //* Generar Token único para garantizar que un email es de un usuario real
          $usuario->crearToken();
          
          //* Enviar el email 
          $email = new Email($usuario->email,$usuario->nombre,$usuario->token);
          // debuguear($email);

          $email->enviarConfirmacion(); # Enviando confirmación a mailtrap para validar que el email es real

          //* Crear el usuario en la BD
          $resultado = $usuario->guardar(); 
          // debuguear($resultado); 

          // debuguear($usuario);
          if ($resultado) { # Si se inserta un nuevo usuario en la BD...
            header('Location: /mensaje');
          }

        }
      } 
    }
    
    $router->render('auth/crear-cuenta',[
      'usuario' => $usuario,
      'alertas' => $alertas,
    ]);
  }

  public static function mensaje(Router $router){
    $router->render('auth/mensaje');
  }


  public static function confirmar(Router $router){
    $alertas = [];

    $token = s($_GET['token']); # Guardando token de la URL
    // debuguear($token);

    $usuario = Usuario::where('token',$token); # Guardando Usuario registrado segun su token
    // debuguear($usuario);
    
    if (empty($usuario)) { # Si no existe un usuario con token registrado 
      //* Mostrar mensaje de error
      Usuario::setAlerta('error','Token No Válido'); # Agregando alerta de error al arreglo 
    }else{ # Si existe un usuario con token registrado 
      //* Modificar a usuario confirmado
      $usuario->confirmado = "1"; # Cambiando la columna confirmado a 1 del usuario que se registró
      $usuario->token = null; # Eliminando token
      $usuario->guardar('id'); # Actualizando al usuario registrado 
      Usuario::setAlerta('exito','Cuenta Comprobada Correctamente');#Agregando alerta de exito al arreglo 
    }

    $alertas = Usuario::getAlertas(); # Guardando arreglo de alertas
    
    $router->render('auth/confirmar-cuenta',[
      'alertas' => $alertas,
    ]);
  }

}