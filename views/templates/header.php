<header class="header">
  <div href="#" class="logo">
    <h1>
      <span>Doña</span>Clarita
    </h1>
  </div>

  <div class="barra">
    <a href="/logout">Cerrar Sesión</a>
    <p><b><?php echo s($rol) ?? ''; ?></b>: <?php echo s($nombre) ?? ''; ?></p>
  </div>
</header>