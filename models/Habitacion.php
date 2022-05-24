<?php 
namespace Model;

class Habitacion extends ActiveRecord{
  protected static $tabla = 'habitacion'; # Tabla en donde se manejaran los datos
  protected static $columnasDB = [ # Columnas de la Tabla
    'id' ,
    'tipo',
    'estado',
    'precio',
    'descripcion',
    'tipo_cama',
  ]; 

  public $id;
  public $tipo;
  public $estado;
  public $precio;
  public $descripcion;
  public $tipo_cama;

  public function __construct($args = []){
    $this->id = $args['id'] ?? null;
    $this->tipo = $args['tipo'] ?? '';
    $this->estado = $args['estado'] ?? 'Disponible';
    $this->precio = $args['precio'] ?? '';
    $this->descripcion = $args['descripcion'] ?? '';
    $this->tipo_cama = $args['tipo_cama'] ?? '';
  }

  // TODO: Validando los campos para insertar o actualizar habitaion
  public function validar(){
    if (!$this->tipo) { 
      self::$alertas['error'][] = 'Debes añadir un tipo de habitación'; 
    }

    if (!$this->estado) { 
      self::$alertas['error'][] = 'Debes añadir un estado de la habitación'; 
    }

    if (!$this->precio) { 
      self::$alertas['error'][] = 'El precio es obligatorio';
    }
    
    if (!$this->descripcion || strlen($this->descripcion) > 100) { 
      self::$alertas['error'][] = 'La descripción es obligatoria y debe tener solo hasta 100 caracteres';
    }

    if (!$this->tipo_cama) { 
      self::$alertas['error'][] = 'Debes añadir un tipo de cama de habitación';
    }

    return self::$alertas;
  }
  
}