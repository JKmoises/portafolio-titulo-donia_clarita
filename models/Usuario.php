<?php 
/* 
? uniqid()
* - Generar un ID único prefijado basado en la hora actual en microsegundos.
*/
namespace Model;

class Usuario extends ActiveRecord{
  protected static $tabla = 'usuario'; # Tabla en donde se manejaran los datos
  protected static $columnasDB = [ # Columnas de la Tabla 
    'id',
    'nombre',
    'apellido',
    'password',
    'email',
    'telefono',
    'confirmado',
    'token',
    'rol',
    'empresa'
  ]; 

  public $id;
  public $nombre;
  public $apellido;
  public $password;
  public $email;
  public $telefono;
  public $confirmado;
  public $token;
  public $rol;
  public $empresa;


  public function __construct($args = []){
    $this->id = $args['id'] ?? null;
    $this->nombre = $args['nombre'] ?? '';
    $this->apellido = $args['apellido'] ?? '';
    $this->password = $args['password'] ?? '';
    $this->email = $args['email'] ?? '';
    $this->telefono = $args['telefono'] ?? '';
    $this->confirmado = $args['confirmado'] ?? '0';
    $this->token = $args['token'] ?? '';
    $this->rol = $args['rol'] ?? 'Cliente';
    $this->empresa = $args['empresa'] ?? '';
  }


  //? Mensajes de validación para la creacion de una cuenta
  public function validar(){
    if (!$this->nombre) {
      self::$alertas['error'][] = 'El Nombre es Obligatorio';
    }

    if (!$this->apellido) {
      self::$alertas['error'][] = 'El Apellido es Obligatorio';
    
    }

    if (!$this->telefono) {
      self::$alertas['error'][] = 'El Teléfono es Obligatorio';
    
    }

    if (strlen($this->telefono) > 9) {
      self::$alertas['error'][] = 'El Teléfono debe contener hasta 9 caracteres';
    
    }

    if (!$this->email) {
      self::$alertas['error'][] = 'El Email es Obligatorio';
    
    }

    if (!$this->password) {
      self::$alertas['error'][] = 'El Password es Obligatorio';
    }

    if (strlen($this->password) < 6) {
      self::$alertas['error'][] = 'El Password debe contener al menos 6 caracteres';
    }

    if (!$this->rol) {
      self::$alertas['error'][] = 'El Rol es Obligatorio';
    
    }

    return self::$alertas;
  } 

  
  public function validarLogin(){
    if (!$this->email) {
      self::$alertas['error'][] = 'El email es Obligatorio';
    }
    
    if (!$this->password) {
      self::$alertas['error'][] = 'El password es Obligatorio';
    }
    
    return self::$alertas;
  }


  //? Revisa si el usuario ya existe 
  public function existeUsuario(){
    $query = "SELECT * FROM " . self::$tabla . " WHERE email = '{$this->email}' LIMIT 1";
    // debuguear($query); 

    $resultado = self::$db->prepare($query); # Preparando query
    // debuguear($resultado->fetch());

    if ($resultado->fetch()) { # Si ya existe el correo a registrar en la BD...
      self::$alertas['error'][] = 'El usuario ya está registrado';
    }

    return $resultado->fetch(); # Devuelve true si existe el correo a registrar sino devuelve false
  }

  public function hashPassword(){
    $this->password = password_hash($this->password,PASSWORD_BCRYPT); # Hasheando password
  }

  public function crearToken(){
    $this->token = uniqid();
  }

  public function comprobarPasswordAndVerificado($password){
    // debuguear($this);

    //* Devuelve true si el password registrado en la BD es igual al password del login sino false
    $resultado = password_verify($password,$this->password);
    // debuguear($resultado);

    //* Si no es correcto el password autenticado o el usuario registrado no está confirmado en su email... 
    if (!$resultado || !$this->confirmado) { 
      self::$alertas['error'][] = 'Password Incorrecto o tu cuenta no ha sido confirmada';
    }else{ #Si es correcto el password autenticado y el usuario registrado está confirmado en su email... 
      return true;
    }
  }


}
  