
<aside class="menu">
  <button type="button" class="boton-menu">Menú de Administración</button>
  
  <?php 
    if ($rol === 'Admin') {
      include_once __DIR__ . '/navegacion/navegacion-admin.php';
    }else if ($rol === 'Proveedor'){
      include_once __DIR__ . '/navegacion/navegacion-proveedor.php';
    }else if($rol === 'Empleado'){
      include_once __DIR__ . '/navegacion/navegacion-empleado.php';
    }
  ?>
</aside>
<?php 
  # Cargando JS en esta vista
  $script = '
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js"></script>
    <script src="/build/js/app.js"></script>
  ';  
?>