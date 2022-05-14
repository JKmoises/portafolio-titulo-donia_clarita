<?php 
namespace Model;

class Huesped extends ActiveRecord{
  protected static $tabla = 'huesped'; # Tabla en donde se manejaran los datos
  protected static $columnasDB = [ # Columnas de la Tabla
    'rut_huesped' ,
    'dv',
    'nombre',
    'apellido',
    'profesion',
    'genero',
    'direccion',
    'telefono',
    'cliente_id',
  ]; 

  public $rut_huesped;
  public $dv;
  public $nombre;
  public $apellido;
  public $profesion;
  public $genero;
  public $direccion;
  public $telefono;
  public $cliente_id;

  public function __construct($args = []){
    $this->rut_huesped = $args['rut_huesped'] ?? null;
    $this->dv = $args['dv'] ?? '';
    $this->nombre = $args['nombre'] ?? '';
    $this->apellido = $args['apellido'] ?? '';
    $this->profesion = $args['profesion'] ?? '';
    $this->genero = $args['genero'] ?? '';
    $this->direccion = $args['direccion'] ?? '';
    $this->telefono = $args['telefono'] ?? '';
    $this->cliente_id = $args['cliente_id'] ?? '';
  }

  public function validar(){
    if (!$this->rut_huesped || strlen($this->rut_huesped) !== 8) {
      self::$alertas['error'][] = 'El Rut es Obligatorio y debe ser válido';
    }

    if (!$this->dv || strlen($this->dv) !== 1) {
      self::$alertas['error'][] = 'El Dígito Verificador es Obligatorio y debe ser solo un dígito';
    
    }

    if (!$this->nombre) {
      self::$alertas['error'][] = 'Debes añadir el nombre del huesped';
    
    }

    if (!$this->apellido) {
      self::$alertas['error'][] = 'Debes añadir el apellido del huesped';
    
    }

    if (!$this->profesion) {
      self::$alertas['error'][] = 'Debes añadir la profesión del huesped';
    
    }

    if (!$this->cliente_id) {
      self::$alertas['error'][] = 'El cliente es Obligatorio';
    
    }

    return self::$alertas;
  } 
}