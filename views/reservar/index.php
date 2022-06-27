<div class="contenido-app">
  <div class="imagen">

  </div>

  <div class="app">
    <h1 class="nombre-pagina">Crear Nueva Reserva</h1>
    <p class="descripcion-pagina">Elige tus habitaciones y coloca tus datos</p>

    <?php require_once __DIR__ . '/../templates/barra.php'; ?>

    <div id="app">
      <nav class="tabs">
        <button class="actual" data-paso="1">habitaciones</button>
        <button data-paso="2">Información Reserva</button>
        <button data-paso="3">Resumen</button>
      </nav>

      <div id="paso-1" class="seccion">
        <h2>Habitaciones</h2>
        <p class="text-center m-b-10">Elige tus habitaciones a continuación</p>

        <div id="servicios" class="listado-servicios">

        </div>
      </div>

      <div id="paso-2" class="seccion">
        <h2>Tus Datos y Reserva</h2>
        <p class="text-center m-b-10">Coloca tus datos y fecha de tu reserva</p>

        <form class="formulario">
          <div class="campo">
            <label for="nombre">Nombre</label>
            <input id="nombre" type="text" placeholder="Tu Nombre" value="<?php echo s($nombre); ?>" readonly>
          </div>

          <div class="campo">
            <label for="fecha_llegada">Fecha Entrada</label>
            <input id="fecha_llegada" type="datetime-local" min="<?php echo date('Y-m-d H:i', strtotime('+1 day')); ?>">
          </div>

          <div class="campo">
            <label for="fecha_salida">Fecha Salida</label>
            <input id="fecha_salida" type="datetime-local" min="<?php echo date('Y-m-d H:i', strtotime('+1 day')); ?>">
          </div>

          <div class="campo">
            <label for="empresa">Email Empresa</label>

            <select id="empresa" name="empresa">
              <option selected value="">-- Seleccione --</option>
              <?php foreach ($clientes as $cliente) : ?>
                <option value="<?php echo s($cliente->rut_empresa); ?>">
                  <?php echo s($cliente->email); ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

        </form>
      </div>

      <div id="paso-3" class="seccion contenido-resumen">
        <h2>Resumen</h2>
        <p class="text-center">Verifica que la información sea correcta</p>
      </div>

      <div class="paginacion">
        <button id="anterior" class="boton">&laquo; Anterior</button>
        <button id="siguiente" class="boton">Siguiente &raquo;</button>
      </div>

    </div>

  </div>
</div>

<?php
# Cargando JS en esta vista
$script = '
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="build/js/cliente.js"></script>
  ';
?>