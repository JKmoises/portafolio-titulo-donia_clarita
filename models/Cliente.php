<?php
namespace Model;

class Cliente extends ActiveRecord{
  protected static $tabla = 'cliente'; # Tabla en donde se manejaran los datos
  protected static $columnasDB = [ # Columnas de la Tabla
    'rut_empresa' ,
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
}