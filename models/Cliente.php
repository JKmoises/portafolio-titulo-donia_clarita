<?php
namespace Model;

class Cliente extends ActiveRecord{
  protected static $tabla = 'cliente'; # Tabla en donde se manejaran los datos
  protected static $columnasDB = [ # Columnas de la Tabla
    'rut_empresa',
    'dv',
    'empresa',
    'telefono',
    'email',
    'direccion',
  ]; 

  public $rut_empresa;
  public $dv;
  public $empresa;
  public $telefono;
  public $email;
  public $direccion;

  public function __construct($args = []){
    $this->rut_empresa = $args['rut_empresa'] ?? null;
    $this->dv = $args['dv'] ?? '';
    $this->empresa = $args['empresa'] ?? '';
    $this->telefono = $args['telefono'] ?? '';
    $this->email = $args['email'] ?? '';
    $this->direccion = $args['direccion'] ?? '';
  }

  public function validar(){
    if (!$this->rut_empresa || strlen($this->rut_empresa) !== 8) {
      self::$alertas['error'][] = 'El Rut es Obligatorio y debe ser válido';
    }

    if (!$this->dv || strlen($this->dv) !== 1) {
      self::$alertas['error'][] = 'El Dígito Verificador es Obligatorio y debe ser solo un dígito';
    
    }

    if (!$this->empresa) {
      self::$alertas['error'][] = 'Debes añadir el nombre de la empresa';
    
    }

    if (!$this->telefono) {
      self::$alertas['error'][] = 'El Teléfono es Obligatorio';
    
    }

    if (!$this->email) {
      self::$alertas['error'][] = 'El Email es Obligatorio';
    
    }

    return self::$alertas;
  } 
}