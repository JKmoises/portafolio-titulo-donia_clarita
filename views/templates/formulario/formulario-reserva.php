<div class="campo">
  <label for="cliente_id">Cliente</label>
  <select id="cliente_id" name="orden_compra[cliente_id]">
    <option selected value="">-- Seleccione --</option>
    <?php foreach($clientes as $cliente): ?>
      <option value="<?php echo s($cliente->rut_empresa); ?>">
        <?php echo s($cliente->rut_empresa."-".$cliente->dv. " " . strtoupper($cliente->empresa)); ?>
      </option>
    <?php endforeach; ?>
  </select>
</div>

<div class="campo">
  <label for="fecha_llegada">Fecha llegada:</label>
  <input type="datetime-local" id="fecha_llegada" name="orden_compra[fecha_llegada]" value="">
</div>

<div class="campo">
  <label for="fecha_salida">Fecha salida:</label>
  <input type="datetime-local" id="fecha_salida" name="orden_compra[fecha_salida]" value="">
</div>

