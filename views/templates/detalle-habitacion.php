<aside class="detalle-habitacion box-shadow-1">
  <h4 class="titulo text-left">Detalle de la Habitación</h4>

  <ul class="datos-habitacion">
    <li>N° Habitación: <span><?php echo $habitacion->id; ?></span></li>
    <li>Tipo de Habitación: <span><?php echo $habitacion->titulo; ?></span></li>
    <li>
      Estado:
      <span class="<?php echo $estadoClass; ?>"><?php echo $habitacion->estado; ?></span>
    </li>
    <li>Tipo Cama: <span><?php echo $habitacion->tipo_cama; ?></span></li>
    <li>Precio: 
      <span class="precio">$<?php echo $habitacion->precio; ?></span>
    </li>
    <li>Descripción: <span><?php echo $habitacion->descripcion; ?></span></li>
  </ul>
</aside>