<div class="panel-admin">
  <?php include_once __DIR__ . "/../templates/header.php"; ?>

  <?php include_once __DIR__ . "/../templates/navegacion.php"; ?>

  <section class="contenedor section">
    <h2 class="nombre pagina">Registrar Habitación</h2>

    <?php include_once __DIR__ . "/../templates/boton-volver.php"; ?>

    <?php include_once __DIR__ . "/../templates/alertas.php"; ?>

    <form class="formulario formulario-crud" method="POST">
      <?php include_once __DIR__ . "/../templates/formulario-habitacion.php"; ?>

      <button type="submit" class="boton-crear">
        <div class="icon">
          <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M5.33335 29.3333H21.3334V26.6667H5.33335V10.6667H2.66669V26.6667C2.66669 28.1373 3.86269 29.3333 5.33335 29.3333Z" fill="white"/>
            <path d="M26.6667 2.66666H10.6667C9.196 2.66666 8 3.86266 8 5.33332V21.3333C8 22.804 9.196 24 10.6667 24H26.6667C28.1373 24 29.3333 22.804 29.3333 21.3333V5.33332C29.3333 3.86266 28.1373 2.66666 26.6667 2.66666ZM24 14.6667H20V18.6667H17.3333V14.6667H13.3333V12H17.3333V7.99999H20V12H24V14.6667Z" fill="white"/>
          </svg>
        </div>
        <p>Crear Habitación</p>
      </button>
    </form>
  </section>

</div>