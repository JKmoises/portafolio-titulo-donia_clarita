<div class="panel-admin">
  <?php include_once __DIR__ . "/../templates/header.php"; ?>

  <?php include_once __DIR__ . "/../templates/navegacion.php"; ?>

  <section class="section p-t-0">
    <h2 class="nombre-pagina">Estadísticas</h2>

    <div class="estadisticas">
      <div class="grafico-ventas">
        <canvas id="graficoVentas" width="400" height="400"></canvas>
      </div>
      <div class="grafico">
        <canvas id="graficoVentas" width="400" height="400"></canvas>
      </div>
      <div class="grafico">
        <canvas id="graficoVentas" width="400" height="400"></canvas>
      </div>
    </div>

  </section>
</div>

<?php
# Cargando JS en esta vista
/* $script = '

  '; */
?>