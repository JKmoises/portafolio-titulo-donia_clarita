<!--  No recomendable dejar con espacios el textarea ya desaparece el placeholder -->

<div div class="campo">
  <label for="tipo">Habitación:</label>
  <input type="text" id="tipo" name="habitacion[tipo]" placeholder="Ingrese un Tipo de Habitación"
  value="<?php echo s($habitacion->tipo); ?>">
</div>

<div class="campo">
  <label>Estado:</label>
  <select id="estado" name="habitacion[estado]">
    <option selected value="">-- Seleccione --</option>
    <?php foreach($estados as $estado): ?>
      <option  <?php echo s($habitacion->estado === $estado) ? 'selected' : ''; ?>
        value="<?php echo s($estado); ?>">
        <?php echo s($estado); ?>
      </option>
    <?php endforeach; ?>
  </select>
</div>

<div class="campo">
  <label for="precio">Precio:</label>
  <input type="number" id="precio" name="habitacion[precio]" placeholder="Ingrese un Precio"
  value="<?php echo s($habitacion->precio); ?>">
</div>

<div class="campo">
  <label>Cama:</label>
  <select id="cama" name="habitacion[tipo_cama]">
    <option selected value="">-- Seleccione --</option>
    <?php foreach($camas as $cama): ?>
      <option  <?php echo s($habitacion->tipo_cama === $cama) ? 'selected' : ''; ?>
        value="<?php echo s($cama); ?>">
        <?php echo s($cama); ?>
      </option>
    <?php endforeach; ?>
  </select>
</div>

<div class="campo expand-2">
  <label class="text-top" for="descripcion">Descripción:</label>
  <textarea id="descripcion" name="habitacion[descripcion]" rows="10" placeholder="Ingrese una Descripcion"><?php echo s($habitacion->descripcion); ?></textarea>
</div>


