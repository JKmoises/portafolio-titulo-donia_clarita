<?php 
namespace Model;

class Habitacion extends ActiveRecord{
  protected static $tabla = 'habitacion'; # Tabla en donde se manejaran los datos
  protected static $columnasDB = [ # Columnas de la Tabla
    'id' ,
    'titulo',
    'estado',
    'precio',
    'descripcion',
    'tipo_cama',
    'huesped_id',
  ]; 

  public $id;
  public $titulo;
  public $estado;
  public $precio;
  public $descripcion;
  public $tipo_cama;
  public $huesped_id;

  public function __construct($args = []){
    $this->id = $args['id'] ?? null;
    $this->titulo = $args['titulo'] ?? '';
    $this->estado = $args['estado'] ?? 'Disponible';
    $this->precio = $args['precio'] ?? '';
    $this->descripcion = $args['descripcion'] ?? '';
    $this->tipo_cama = $args['tipo_cama'] ?? '';
    $this->huesped_id = $args['huesped_id'] ?? '';
  }

  // TODO: Validando los campos para insertar o actualizar habitaion
  public function validar(){
    if (!$this->titulo) { 
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


    if (!$this->huesped_id) { 
      self::$alertas['error'][] = 'Elige un Huesped';
    }


    return self::$alertas;
  }
  
}