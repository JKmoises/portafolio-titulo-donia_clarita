<?php 

require __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__); # Llamando ubicacion de las variables de entorno
$dotenv->safeLoad(); # Esto lo que  permite es que no haya errores si no existe el archivo .env 
require 'funciones.php';
require 'database.php';

//* Conectarnos a la base de datos
use Model\ActiveRecord;
ActiveRecord::setDB($db);