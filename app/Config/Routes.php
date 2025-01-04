<?php
namespace Config;

use CodeIgniter\Router\RouteCollection;


$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}


/**
 * @var RouteCollection $routes
 *
 *
 *
 */
service('auth')->routes($routes);

service('auth')->routes($routes, ['except' => ['register']]);
$routes->post('/user-login', 'Api\AuthController::userLogin');
 
$routes->get('/','Home::index');
$routes->get('/paginaprincipal', 'Home::paginaprincipal',['filter'=>'PermissionFilter:user.access']);
$routes->get('/Corroborar', 'Home::Corroborar');
$routes->get('/producto','Home::Producto');
$routes->get('/Uso_Materia_Prima','Home::Uso_Materia_Prima');
$routes->get('/Produccion_Deseada','Home::Produccion_Deseada');
$routes->get('/Produccion_Deseada_admin','Home::Vista_Produccion_deseada');
$routes->get('/Vista_Produccion_Real','Home::Vista_Produccion_Real');
$routes->get('/Vista_Produccion_Registrado','Home::Vista_Produccion_Registrado');

$routes->post('/MandarProducto_Gasto', 'Home::MandarProducto_Gasto');
$routes->post('/MandarProducto','Home::MandarProducto');
$routes->post('/MandarAlmacen','Home::MandarAlmacen');
$routes->post('/MandarCorroboracion','Home::MandarCorroboracion');
$routes->post('/MandarProduccionDeseada','Home::MandarProduccionDeseada');
$routes->post('/MandarProduccion','Home::Registro_de_produccion_de_hoy');
$routes->post('/AgregarDistribucion','Home::AgregarDistribucion');
service('auth')->routes($routes);


if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
 