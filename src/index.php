<?php

include_once "vendor/autoload.php";

use Phroute\Phroute\Exception\HttpRouteNotFoundException;
use Phroute\Phroute\RouteCollector;
use App\Controlador\HuespedControlador;


$router = new RouteCollector();


$router->get('/',function (){
    include_once "app/View/principal.php";
});

$router->get('/huespedes',function (){
    $controlador = new HuespedControlador();
    return $controlador->listar();
});

$router->get('/huespedes/{id:i}', function ($id){
    $controlador = new HuespedControlador();
    return $controlador->show($id);
});

$router->post('/huespedes',function (){
    $controlador = new HuespedControlador();
    $controlador->crear();
});


$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());
try {
    $response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
}
catch(HttpRouteNotFoundException $e){
    return "Ruta no encontrada";
}

echo $response;
