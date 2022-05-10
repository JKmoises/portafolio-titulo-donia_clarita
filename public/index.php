<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\HabitacionController;
use Controllers\LoginController;
use Controllers\ReservasController;
use Controllers\UsuarioController;
use MVC\Router;

$router = new Router();

//* Iniciar Sesion
$router->get('/',[LoginController::class,'login']);
$router->post('/',[LoginController::class,'login']);
$router->get('/logout',[LoginController::class,'logout']);

//* Recuperar Password
$router->get('/olvide',[LoginController::class,'olvide']);
$router->post('/olvide',[LoginController::class,'olvide']);
$router->get('/recuperar',[LoginController::class,'recuperar']);
$router->post('/recuperar',[LoginController::class,'recuperar']);

//* Crear cuenta 
$router->get('/crear-cuenta',[LoginController::class,'crear']);
$router->post('/crear-cuenta',[LoginController::class,'crear']);

//* Confirmar cuenta 
$router->get('/confirmar-cuenta',[LoginController::class,'confirmar']);
$router->get('/mensaje',[LoginController::class,'mensaje']);



//* Habitaciones
$router->get('/habitaciones',[HabitacionController::class,'listar']); 
$router->get('/habitaciones/crear',[HabitacionController::class,'crear']); 
$router->post('/habitaciones/crear',[HabitacionController::class,'crear']); 
$router->get('/habitaciones/actualizar',[HabitacionController::class,'actualizar']); 
$router->post('/habitaciones/actualizar',[HabitacionController::class,'actualizar']); 
$router->post('/habitaciones/eliminar',[HabitacionController::class,'eliminar']);

//* Reservar Habitaciones
$router->get('/habitaciones/reservar',[ReservasController::class,'listar']); 


//* Usuarios Registrados 
$router->get('/usuarios',[UsuarioController::class,'listar']); 
$router->get('/usuarios/actualizar',[UsuarioController::class,'actualizar']); 
$router->post('/usuarios/actualizar',[UsuarioController::class,'actualizar']); 
$router->post('/usuarios/eliminar',[UsuarioController::class,'eliminar']);



//* Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();