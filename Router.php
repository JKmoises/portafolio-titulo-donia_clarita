<?php 

namespace MVC;

class Router{
  public $rutasGET = [];
  public $rutasPOST = [];

  //? Crea las rutas de nuestra web con una función del Controller asociada cuando es GET
  public function get($url,$fn){
    $this->rutasGET[$url] = $fn; # Asignando URL como propiedad y función como valor en el arreglo de GET
  }

  //? Crea las rutas de nuestra web con una función del Controller asociada cuando es POST
  public function post($url,$fn){
    $this->rutasPOST[$url] = $fn; # Asignando URL como propiedad y función como valor en el arreglo de POST
  }
  
  //? Valida que existan las rutas con su función asociada
  public function comprobarRutas(){
    // debuguear($_SERVER);

    // * Nota: En el servidor apache no sirve PATH_INFO para detectar las rutas sino que sirve REQUEST_URI
    $urlActual = $_SERVER["PATH_INFO"] ?? '/';  
    # Si exista una ruta vacia se agrega '/' sino se agrega la ruta a la que naveguemos
    $urlActual = ($_SERVER["REQUEST_URI"] === '') ? '/' : $_SERVER["REQUEST_URI"];  
    $metodo = $_SERVER["REQUEST_METHOD"]; # Por defecto es GET
    // debuguear($urlActual);

    if ($metodo == 'GET') { # Si el método http es GET...
      //* Guardando función de URL actual con su namespace, si no existe la url por defecto sería null
      $fn = $this->rutasGET[$urlActual] ?? null; 
    }else{ # Si el método http es POST...
      // debuguear($_POST);
      //* Guardando función de URL actual con su namespace, si no existe la url por defecto sería null
      $fn = $this->rutasPOST[$urlActual] ?? null; 
    }


    if ($fn) { # Si existe una función asociada en la URL...
      // debuguear($this);
      // debuguear($fn);
      // * Como argumento se pasa el callback a ejecutar y el objeto con las rutas GET y POST como argumento 
      //* del callback
      call_user_func($fn,$this); # Ejecutando función asociada a la URL actual y pasando su argumento
    }else{
      echo "Página No Encontrada o Ruta no válida";
    }
  }

  //? Renderiza una vista(HTML) y permite pasar datos a esta
  public function render($view,$datos = []){
    // debuguear($datos);

    //* Creando variables con con el arreglo pasado como 2do argumento
    foreach ($datos as $key => $value) {
      $$key = $value; # Creando variable en cada iteracion que es el $key del arreglo y su valor el $value
    }

    //* Almacena en memoria del Buffer que es la vista a renderizar
    ob_start(); 
    include_once __DIR__ . "/views/{$view}.php"; # Importando vista 

    //* Limpia el Buffer en memoria que es la vista almacenada a renderizar y se guarda en variable $contenido
    $contenido = ob_get_clean(); 
    include_once __DIR__ . '/views/layout.php'; # Importando layout que contiene el header y el footer
  }
}