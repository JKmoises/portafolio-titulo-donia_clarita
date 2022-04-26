<div class="panel-admin">
  <?php include_once __DIR__ . "/../templates/header.php"; ?>

  <?php include_once __DIR__ . "/../templates/navegacion.php"; ?>

  <section class="contenedor section">
    <h2 class="nombre pagina">Actualizar Habitación</h2>

    <?php include_once __DIR__ . "/../templates/boton-volver.php"; ?>

    <?php include_once __DIR__ . "/../templates/alertas.php"; ?>

    <p class="nro-habitacion"><b>Nro. Habitación:</b> <?php echo $habitacion->id; ?></p>
    <form class="formulario formulario-crud" method="POST">
      <?php include_once __DIR__ . "/../templates/formulario-habitacion.php"; ?>

      <button type="submit" class="boton-actualizar">
        <div class="icon">
          <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M25.6507 2.68268L29.6507 6.68268L26.6013 9.73335L22.6013 5.73335L25.6507 2.68268ZM11 21.3333H15L24.716 11.6173L20.716 7.61734L11 17.3333V21.3333Z" fill="white"/>
            <path d="M25.3333 25.3333H10.8773C10.8427 25.3333 10.8067 25.3467 10.772 25.3467C10.728 25.3467 10.684 25.3347 10.6387 25.3333H6.66667V6.66667H15.796L18.4627 4H6.66667C5.196 4 4 5.19467 4 6.66667V25.3333C4 26.8053 5.196 28 6.66667 28H25.3333C26.0406 28 26.7189 27.719 27.219 27.219C27.719 26.7189 28 26.0406 28 25.3333V13.776L25.3333 16.4427V25.3333Z" fill="white"/>
          </svg>
        </div>
        <p>Actualizar Habitación</p>
      </button>
    </form>
  </section>

</div>