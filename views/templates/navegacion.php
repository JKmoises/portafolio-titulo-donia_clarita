
<aside class="menu">
  <button type="button" class="boton-menu">Menú de Administración</button>
  
  <?php 
    if ($rol === 'Admin') {
      include_once __DIR__ . '/navegacion/navegacion-admin.php';
    }else if ($rol === 'Proveedor'){
      include_once __DIR__ . '/navegacion/navegacion-proveedor.php';
    }else if($rol === 'Empleado'){
      include_once __DIR__ . '/navegacion/navegacion-empleado.php';
    }else{
      include_once __DIR__ . '/navegacion/navegacion-cliente.php';
    }
  ?>
</aside>
<?php 
  $script = '<script src="/build/js/app.js"></script>';  # Cargando JS en esta vista
?>