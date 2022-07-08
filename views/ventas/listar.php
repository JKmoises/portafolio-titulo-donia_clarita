<div class="panel-admin">
  <?php include_once __DIR__ . "/../templates/header.php"; ?>

  <?php include_once __DIR__ . "/../templates/navegacion.php"; ?>
  
  <section class="section p-t-0">
    <?php include_once __DIR__ . "/../templates/titulo-reportes.php"; ?>

    <table class="tabla tabla-ventas">
      <thead>
        <tr>
          <th>Servicios</th>
          <th>Fecha LLegada</th>
          <th>Fecha Salida</th>
          <th>Total</th>
        </tr>
      </thead>

      <tbody>
        <!-- Mostrar los resultados(filas de las tablas) -->
        <?php foreach ($ventas as $venta) : ?>
          <tr>
            <td>
              <?php
              $servicios = explode(',', $venta->servicios);
              // debuguear($servicios);

              foreach ($servicios as $servicio) : ?>
                <li><?php echo $servicio; ?></li>
              <?php endforeach; ?>
            </td>
            <td><?php echo $venta->fecha_llegada ?></td>
            <td><?php echo $venta->fecha_salida ?></td>
            <td>$<?php echo number_format($venta->total, 0, ',', '.'); ?></td>
          </tr>
        <?php endforeach; ?>

      </tbody>
    </table>

  </section>

</div>