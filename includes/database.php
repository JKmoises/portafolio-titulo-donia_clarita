<?php

//* Conectar a la BD con PDO
$db = new PDO("oci:dbname=localhost;charset=utf8",'ADMIN','ADMIN');
// debuguear($_ENV);

if (!$db) {
    echo "Error: No se pudo conectar a OracleSQL.";
    echo "errno de depuración: " . mysqli_connect_errno();
    echo "error de depuración: " . mysqli_connect_error();
    exit;
}
