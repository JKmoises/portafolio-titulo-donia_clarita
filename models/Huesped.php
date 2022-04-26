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
}