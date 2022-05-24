<div class="panel-admin">
  <?php include_once __DIR__ . "/../templates/header.php"; ?>

  <?php include_once __DIR__ . "/../templates/navegacion.php"; ?>

  <section class="section p-t-0">
    <?php include_once __DIR__ . "/../templates/boton-volver.php"; ?>

    <?php include_once __DIR__ . "/../templates/detalle-habitacion.php"; ?>
    
    <form class="formulario formulario-crud box-shadow-1" method="POST">
    <?php include_once __DIR__ . "/../templates/formulario/formulario-reserva.php"; ?>
    </form>
  </section>

</div>