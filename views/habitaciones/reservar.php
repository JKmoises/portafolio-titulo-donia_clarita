<div class="panel-admin">
  <?php include_once __DIR__ . "/../templates/header.php"; ?>

  <?php include_once __DIR__ . "/../templates/navegacion.php"; ?>
  
 
 <section class="section p-t-0">
   <h2 class="nombre-pagina">Reserva una habitacion</h2>

   <div class="habitaciones">
      <?php foreach($habitaciones as $habitacion): ?>
        <?php 
          if ($habitacion->estado === 'Disponible') {
            $estadoClass = 'disponible';
          }else if($habitacion->estado === 'Ocupada'){
            $estadoClass = 'ocupada';
          }else if($habitacion->estado === 'Reservada'){
            $estadoClass = 'reservada';
          }else{
            $estadoClass = 'mantenimiento';
          }
        ?>
        <a href="#" class="habitacion <?php echo $estadoClass; ?>">
          <img class="icono" src="/build/img/bed-icon.svg" alt="Cama">
          <span class="numero">Nro. <?php echo $habitacion->id; ?></span>
          <hr>
          <p class="precio text-center">$<?php echo $habitacion->precio; ?> - <?php echo $habitacion->titulo; ?></p>
          <p class="estado text-center"><?php echo $habitacion->estado; ?></p>
        </a>
      <?php endforeach; ?>
   </div>
 </section>
</div>