<div div class="campo">
  <label for="rut_empresa">Rut Empresa:</label>
  <input type="text" id="rut_empresa" name="cliente[rut_empresa]" placeholder="Ingrese un Rut Empresa"
  value="<?php echo s($cliente->rut_empresa); ?>">
</div>

<div class="campo">
<label for="dv">Dv:</label>
  <input type="text" id="dv" name="cliente[dv]" placeholder="Ingrese un Dígito Verificador"
  value="<?php echo s($cliente->dv); ?>">
</div>

<div class="campo">
  <label for="empresa">Empresa:</label>
  <input type="text" id="empresa" name="cliente[empresa]" placeholder="Ingrese el nombre de la empresa"
  value="<?php echo s($cliente->empresa); ?>">
</div>

<div class="campo">
  <label for="telefono">Teléfono:</label>
  <input type="tel" id="telefono" name="cliente[telefono]" placeholder="Ingrese un Teléfono"
  value="<?php echo s($cliente->telefono); ?>">
</div>

<div class="campo">
  <label for="email">Email:</label>
  <input type="email" id="email" name="cliente[email]" placeholder="Ingrese un Email"
  value="<?php echo s($cliente->email); ?>">
</div>

<div class="campo">
  <label for="direccion">Dirección:</label>
  <input type="text" id="direccion" name="cliente[direccion]" placeholder="Ingrese una dirección (opcional)"
  value="<?php echo s($cliente->direccion); ?>">
</div>

