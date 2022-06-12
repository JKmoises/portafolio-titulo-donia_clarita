<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;700;900&display=swap" rel="stylesheet">
  <title>Reporte Ventas</title>

  <style>
    html {
      font-size: 62.5%;
      box-sizing: border-box;
      height: 100%;
    }

    *,
    *:before,
    *:after {
      box-sizing: inherit;
    }

    body {
      min-height: 100%;
      display: flex;
      flex-direction: column;
      color: #333333;
      margin: 0;
      overflow-x: hidden;
      font-family: 'Poppins', sans-serif;
      font-size: 1.6rem;
    }

    .nombre-pagina {
      font-weight: 700;
      text-align: center;
      text-transform: uppercase;
    }

    .section {
      background-color: #F3F3F3;
      padding-top: 5rem;
      grid-column: 2 / 3;
    }

    .p-t-0 {
      padding-top: 0;
    }

    .tabla-ventas thead {
      background-color: #b8a11e80;
    }


    table.tabla {
      margin-top: 4rem;
      width: 100%;
      border-spacing: 0;
    }

    table.tabla th {
      color: #fff;
      padding: 2rem;
      text-transform: uppercase;
      font-weight: 300;
      font-size: 1.8rem;
    }

    table.tabla tbody {
      text-align: center;
    }

    table.tabla tr,
    table.tabla td {
      border: thin solid #CCCCCC;
    }


    td {
      padding: 1rem;
      padding-right: 0;
      font-size: 1.9rem;
    }
  </style>
</head>

<body>
  <section class="section p-t-0">
    <h2 class="nombre-pagina">Reporte de Ventas</h2>

    <table class="tabla tabla-ventas">
      <thead>
        <tr>
          <th>ID Venta</th>
          <th>Servicios</th>
          <th>Fecha LLegada</th>
          <th>Fecha Salida</th>
          <th>Total</th>
          <th>Rut Cliente</th>
        </tr>
      </thead>

      <tbody>
        <!-- Mostrar los resultados(filas de las tablas) -->
        <?php foreach ($ventas as $venta) : ?>
          <tr>
            <td><?php echo $venta->id ?></td>
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
            <td>$<?php echo $venta->total ?></td>
            <td><?php echo $venta->cliente_id ?></td>
          </tr>
        <?php endforeach; ?>

      </tbody>
    </table>

  </section>
</body>

</html>