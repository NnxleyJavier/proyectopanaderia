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












// seccion de ventas
$routes->get('/Pedidos', 'Pedidos::index',['filter'=>'PermissionFilter:ventas.admin']); // agregar que sea para admin igual
$routes->get('/Vista_Confirmacion_Usuario','Home::Vista_Confirmacion_Usuario',['filter'=>'PermissionFilter:ventas.access']);
$routes->get('/mermas', 'Mermas::index',['filter'=>'PermissionFilter:user.access',['filter'=>'PermissionFilter:ventas.access']]);
$routes->get('/PedidosdeMaterial','Pedidos::PedidosLimpieza',['filter'=>'PermissionFilter:ventas.access']);// Agregar al server

// Seccion de Administrador
$routes->get('/paginaprincipal', 'Home::paginaprincipal',['filter'=>'PermissionFilter:admin.access']);
$routes->get('/Corroborar', 'Home::Corroborar',['filter'=>'PermissionFilter:admin.access']);
$routes->get('/producto','Home::Producto',['filter'=>'PermissionFilter:admin.access']);
$routes->get('/Uso_Materia_Prima','Home::Uso_Materia_Prima',['filter'=>'PermissionFilter:admin.access']);
$routes->get('/Produccion_Deseada_admin','Home::Vista_Produccion_deseada',['filter'=>'PermissionFilter:admin.access']);
$routes->get('/PedidosdeMaterialConfirmacion','Pedidos::PedidosdeMaterialConfirmacion',['filter'=>'PermissionFilter:admin.access']);// Agregar al server

// usuarios seccion de produccion utilizamos el rol User para los panaderos o produccion

$routes->get('/Vista_Produccion_Real','Home::Vista_Produccion_Real',['filter'=>'PermissionFilter:user.index']);
$routes->get('/Produccion_Deseada','Home::Produccion_Deseada',['filter'=>'PermissionFilter:user.access']);
$routes->get('/Eliminarpanadero','Home::VistaEliminarRegistroProduccion');
$routes->post('/SeleccionarYEliminarPanadero','Home::SeleccionarYEliminarPanadero');

// seccion de Distribucion
$routes->get('/Vista_Produccion_Registrado','Home::Vista_Produccion_Registrado',['filter'=>'PermissionFilter:distribucion.access']);
$routes->get('/Vista_CantidadPredeterminada','Home::Vista_CantidadPredeterminada',['filter'=>'PermissionFilter:distribucion.access']);
$routes->post('/CambiarValorPredeterminado','Home::CambiarValorPredeterminado');
$routes->post('/AgregarDistribucion','Home::AgregarDistribucion');










$routes->post('/MandarProducto_Gasto', 'Home::MandarProducto_Gasto');
$routes->post('/MandarProducto','Home::MandarProducto');
$routes->post('/MandarAlmacen','Home::MandarAlmacen');
$routes->post('/MandarCorroboracion','Home::MandarCorroboracion');
$routes->post('/MandarProduccionDeseada','Home::MandarProduccionDeseada');
$routes->post('/MandarProduccion','Home::Registro_de_produccion_de_hoy');

$routes->post('/AgregarPedidos', 'Pedidos::AgregarPedidos');
$routes->post('/AgregarMermas', 'Mermas::AgregarMermas');
$routes->post('/AgregarPedidosLimpieza','Pedidos::AgregarPedidosLimpieza');// Agregar al server
$routes->post('/Registrar_Solicitud_Material','Pedidos::Registrar_Solicitud_Material');// Agregar al server

$routes->post('/Registrar_mercancia_sucursal','Home::Registrar_mercancia_sucursal');





service('auth')->routes($routes);

if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
 