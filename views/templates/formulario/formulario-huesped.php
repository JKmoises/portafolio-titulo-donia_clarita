<div div class="campo">
  <label for="rut_huesped">Rut Huésped:</label>
  <input type="text" id="rut_huesped" name="huesped[rut_huesped]" placeholder="Ingrese un Rut"
  value="<?php echo s($huesped->rut_huesped); ?>">
</div>

<div class="campo">
<label for="dv">Dv:</label>
  <input type="text" id="dv" name="huesped[dv]" placeholder="Ingrese un Dígito Verificador"
  value="<?php echo s($huesped->dv); ?>">
</div>

<div class="campo">
  <label for="nombre">Nombre:</label>
  <input type="text" id="nombre" name="huesped[nombre]" placeholder="Ingrese un nombre"
  value="<?php echo s($huesped->nombre); ?>">
</div>

<div class="campo">
  <label for="apellido">Apellido:</label>
  <input type="text" id="apellido" name="huesped[apellido]" placeholder="Ingrese un apellido"
  value="<?php echo s($huesped->apellido); ?>">
</div>

<div class="campo">
  <label for="profesion">Profesión:</label>
  <input type="text" id="profesion" name="huesped[profesion]" placeholder="Ingrese una profesión"
  value="<?php echo s($huesped->profesion); ?>">
</div>

<div class="campo">
  <label>Género:</label>
  <select id="genero" name="huesped[genero]">
    <option selected value="">-- Seleccione --</option>
    <?php foreach($generos as $genero): ?>
      <option  <?php echo s($huesped->genero === $genero ? 'selected' : ''); ?>
        value="<?php echo s($genero); ?>">
        <?php echo s($genero === 'F' ? 'Femenino' : 'Masculino'); ?>
      </option>
    <?php endforeach; ?>
  </select>
</div>

<div class="campo">
  <label for="direccion">Dirección:</label>
  <input type="text" id="direccion" name="huesped[direccion]" placeholder="Ingrese una dirección (opcional)"
  value="<?php echo s($huesped->direccion ?? 'No especificado'); ?>">
</div>

<div class="campo">
  <label for="telefono">Teléfono:</label>
  <input type="tel" id="telefono" name="huesped[telefono]" placeholder="Ingrese un Teléfono (opcional)"
  value="<?php echo s($huesped->telefono); ?>">
</div>



