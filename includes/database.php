<?php

//* Conectar a la BD con PDO
$db = new PDO("oci:dbname={$_ENV['DB_HOST']};charset=utf8",$_ENV['DB_USER'],$_ENV['DB_PASS']);
// debuguear($_ENV);

if (!$db) {
    echo "Error: No se pudo conectar a OracleSQL.";
    echo "errno de depuración: " . mysqli_connect_errno();
    echo "error de depuración: " . mysqli_connect_error();
    exit;
}
