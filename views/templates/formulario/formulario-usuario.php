<div class="campo">
  <label for="nombre">Nombre</label>
  <input type="text" id="nombre" name="usuario[nombre]" placeholder="Tu Nombre" readonly
  value="<?php echo s($usuario->nombre); ?>">
</div>

<div class="campo">
  <label for="apellido">Apellido</label>
  <input type="text" id="apellido" name="usuario[apellido]" placeholder="Tu Apellido" readonly
  value="<?php echo s($usuario->apellido); ?>">
</div>

<div class="campo">
  <label for="telefono">Teléfono</label>
  <input type="tel" id="telefono" name="usuario[telefono]" placeholder="Tu Teléfono" readonly
  value="<?php echo s($usuario->telefono); ?>">
</div>

<div class="campo">
  <label for="email">E-mail</label>
  <input type="email" id="email" name="usuario[email]" placeholder="Tu E-mail" readonly
  value="<?php echo s($usuario->email); ?>">
</div>

<div class="campo expand-2">
  <label for="rol">Rol</label>
  <select id="rol" name="usuario[rol]">
    <option selected value="">-- Seleccione --</option>
    <?php foreach($roles as $rol): ?>
      <option  <?php echo s($usuario->rol === $rol) ? 'selected' : ''; ?>
        value="<?php echo s($rol); ?>">
        <?php echo s($rol); ?>
      </option>
    <?php endforeach; ?>
  </select>
</div>

