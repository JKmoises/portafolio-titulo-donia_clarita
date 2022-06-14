<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Doña Clarita</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;700;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../build/css/app.css">

  <meta name="description" content="Hola bienvenid@ al Hostal Doña Clarita, 
  Servicio de hospedaje y comedor ideal para empresas.">
  <link rel="shortcut icon" href="../build/img/bed-icon.svg" type="image/x-icon">

</head>

<body>

  <?php echo $contenido; ?>
  <?php echo $script ?? '';  # Carga el script de JS sino existe no se carga 
  ?>
</body>

</html>