<div class="panel-admin">
  <?php include_once __DIR__ . "/../templates/header.php"; ?>

  <?php include_once __DIR__ . "/../templates/navegacion.php"; ?>

  <section class="section">
    <h2 class="nombre pagina">Usuarios</h2>

    <?php 
    if($resultado):
      //* Guardando mensaje de alerta según la consulta del CRUD que se realice 
      $mensaje = mostrarNotificacion(intval($resultado)); # El argumento se convierte a entero 
      if ($mensaje): # Si existe un mensaje... ?> 
        <p class="alerta exito"><?php echo s($mensaje); ?></p> 
    <?php 
      endif;
    endif; 
    ?>

    <table class="tabla tabla-usuarios">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Email</th>
          <th>Telefono</th>
          <th>Rol</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <!-- Mostrar los resultados(filas de las tablas) -->
        <?php foreach ($usuarios as $usuario): ?>
          <tr>
            <td><?php echo $usuario->id; ?></td>
            <td><?php echo $usuario->nombre . " " . $usuario->apellido; ?></td>
            <td><?php echo $usuario->email; ?></td>
            <td><?php echo $usuario->telefono; ?></td>
            <td><?php echo $usuario->rol; ?></td>
            <td>
              <?php $deshabilitadoClass = $usuario->rol === 'Admin' ? 'deshabilitado' : ''; ?>
              <form method="POST" class="formulario-eliminar w-100" action="/usuarios/eliminar">
                <!-- entrada de formulario oculta para guardar id de cada usuario -->
                <input type="hidden" name="id" value="<?php echo $usuario->id; ?>">
                <button type="submit" class="boton-eliminar <?php echo $deshabilitadoClass ?>">
                  <div class="icon">
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M21.5893 8.45868L15.932 14.1147L10.276 8.45868L8.39066 10.344L14.0467 16L8.39066 21.656L10.276 23.5413L15.932 17.8853L21.5893 23.5413L23.4747 21.656L17.8187 16L23.4747 10.344L21.5893 8.45868Z" fill="white"/>
                    </svg>

                  </div>
                  <p>Eliminar</p>
                </button>
              </form>

              <a href="/usuarios/actualizar?id=<?php echo $usuario->id; ?>" class="boton-actualizar-2
              <?php echo $deshabilitadoClass ?>">
                <div div class="icon">
                  <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M21.3333 2.68268L25.3333 6.68268L22.284 9.73335L18.284 5.73335L21.3333 2.68268ZM5.33334 18.6667V22.6667H9.33334L20.3987 11.6173L16.3987 7.61734L5.33334 18.6667ZM5.33334 26.6667H26.6667V29.3333H5.33334V26.6667Z" fill="white"/>
                  </svg>
                </div>
                <p>Cambiar Rol</p>
              </a>
            </td>
          </tr>
        <?php endforeach; ?>

      </tbody>
    </table>

  </section>

</div>
<?php 
  $script = '<script src="build/js/app.js"></script>';  # Cargando JS en esta vista
?>
