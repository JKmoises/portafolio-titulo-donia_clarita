<?php
namespace Model;

class OrdenCompra extends ActiveRecord{
  protected static $tabla = 'orden_compra'; # Tabla en donde se manejaran los datos
  # Columnas de la Tabla 
  protected static $columnasDB = ['id','servicios','fecha_llegada','fecha_salida','subtotal','total','cliente_id']; 

  public $id;
  public $servicios;
  public $fecha_llegada;
  public $fecha_salida;
  public $subtotal;
  public $total;
  public $cliente_id;

  public function __construct($args = []){
    $this->id = $args['id'] ?? null;
    $this->servicios = $args['servicios'] ?? '';
    $this->fecha_llegada = $args['fecha_llegada'] ?? '';
    $this->fecha_salida = $args['fecha_salida'] ?? '';
    $this->subtotal = $args['subtotal'] ?? '';
    $this->total = $args['total'] ?? '';
    $this->cliente_id = $args['cliente_id'] ?? '';
  }

  //? Registra una reserva de habitacion
  public function registrarReserva(){
    //* Sanitizar los datos
    $atributos = $this->sanitizarAtributos();
    // debuguear(array_values($atributos));

    //* Insertar en la base de datos
    $query = " INSERT INTO " . static::$tabla . " ( ";
    $query .= join(', ', array_keys($atributos));
    $query .= " ) VALUES ( ";
    $query .= "{$atributos['servicios']},TO_DATE({$atributos['fecha_llegada']},'yyyy/mm/dd hh24:mi:ss'),";
    $query .= "TO_DATE({$atributos['fecha_salida']},'yyyy/mm/dd hh24:mi:ss'),";
    $query .= "{$atributos['subtotal']},{$atributos['total']},{$atributos['cliente_id']}";
    $query .= " ) ";
    // debuguear($query);

    // return json_encode(['query' => $query]);

    //* Ejecutando la consulta y devolviendo la cantidad de filas afectadas
    $resultado = self::$db->exec($query);
    // debuguear($resultado);

    return [
      'resultado' =>  $resultado, # true o false si se insertó o no
      // 'id' => self::$db->lastInsertId(), # Id de registro insertado
    ];
  }
}