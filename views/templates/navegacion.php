
<aside class="menu">
  <p>Menú de Administración</p>
  
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