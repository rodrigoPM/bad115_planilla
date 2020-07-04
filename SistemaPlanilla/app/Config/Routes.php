<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes(true);

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Login::index');

//Agregar Autorización a las rutas protegidas
$routes->get('dashboard', 'Dashboard::index', ['filter' => 'auth']);

//Vistas de Empresa
$routes->match(['get', 'post'], 'empresa', 'Empresa::index', ['filter' => 'checkRole']);
$routes->match(['get', 'post'], 'departamentos_empresa', 'Departamentos_empresa::index', ['filter' => 'checkRole']);
$routes->match(['get', 'post'], 'area', 'Area::index', ['filter' => 'checkRole']);
$routes->match(['get', 'post'], 'secciones', 'Secciones::index', ['filter' => 'checkRole']);
$routes->match(['get', 'post'], 'subsecciones', 'SubSecciones::index', ['filter' => 'checkRole']);
$routes->match(['get', 'post'], 'unidades', 'Unidades::index', ['filter' => 'checkRole']);
$routes->match(['get', 'post'], 'puestos_trabajo', 'Puestos_Trabajo::index', ['filter' => 'checkRole']);

//Vistas de Planilla
$routes->match(['get', 'post'], 'generar_planilla', 'Generar_planilla::index', ['filter' => 'checkRole']);
$routes->match(['get', 'post'], 'boleta_pago', 'Boleta_pago::index', ['filter' => 'checkRole']);
$routes->match(['get', 'post'], 'calendario', 'Calendario::index', ['filter' => 'checkRole']);
$routes->match(['get', 'post'], 'periodicidades', 'Periodicidades::index', ['filter' => 'checkRole']);

//Vistas de Empleados
$routes->match(['get', 'post'], 'empleados', 'Empleados::index', ['filter' => 'checkRole']);
$routes->match(['get', 'post'], 'estado_empleados', 'Estado_empleados::index', ['filter' => 'checkRole']);
$routes->match(['get', 'post'], 'profesiones', 'Profesiones::index', ['filter' => 'checkRole']);
$routes->match(['get', 'post'], 'domicilios', 'Domicilios::index', ['filter' => 'checkRole']);
$routes->match(['get', 'post'], 'estado_civil', 'Estado_civil::index', ['filter' => 'checkRole']);
$routes->match(['get', 'post'], 'generos', 'Generos::index', ['filter' => 'checkRole']);
$routes->match(['get', 'post'], 'telefonos', 'Telefonos::index', ['filter' => 'checkRole']);

//Vistas de Ingresos y Descuentos
$routes->match(['get', 'post'], 'ingresos_descuentos', 'Ingresos_descuentos::index', ['filter' => 'checkRole']);
$routes->match(['get', 'post'], 'tipos_movimiento', 'Tipos_movimiento::index', ['filter' => 'checkRole']);
$routes->match(['get', 'post'], 'ventas', 'Ventas::index', ['filter' => 'checkRole']);
$routes->match(['get', 'post'], 'rangocomision', 'RangoComision::index', ['filter' => 'checkRole']);
$routes->match(['get', 'post'], 'pagos_eventuales', 'Pagos_eventuales::index', ['filter' => 'checkRole']);
$routes->match(['get', 'post'], 'pagos_programados', 'Pagos_programados::index', ['filter' => 'checkRole']);
$routes->match(['get', 'post'], 'descuentos_eventuales', 'Descuentos_eventuales::index', ['filter' => 'checkRole']);
$routes->match(['get', 'post'], 'descuentos_programados', 'Descuentos_programados::index', ['filter' => 'checkRole']);

//Visats de Finanzas
$routes->match(['get', 'post'], 'presupuestos', 'Presupuestos::index', ['filter' => 'checkRole']);
$routes->match(['get', 'post'], 'accion_personal', 'Accion_personal::index', ['filter' => 'checkRole']);
$routes->match(['get', 'post'], 'tipo_accion_personal', 'Tipo_accion_personal::index', ['filter' => 'checkRole']);
$routes->match(['get', 'post'], 'tipos_contratacion', 'Tipos_contratacion::index', ['filter' => 'checkRole']);
$routes->match(['get', 'post'], 'tablarenta', 'TablaRenta::index', ['filter' => 'checkRole']);
$routes->match(['get', 'post'], 'detallestablarenta', 'DetallesTablaRenta::index', ['filter' => 'checkRole']);
$routes->match(['get', 'post'], 'afps', 'Afps::index', ['filter' => 'checkRole']);

//Vistas de Usuarios
$routes->match(['get', 'post'], 'usuarios', 'Usuarios::index', ['filter' => 'checkRole']);
$routes->match(['get', 'post'], 'roles', 'Roles::index', ['filter' => 'checkRole']);
$routes->match(['get', 'post'], 'menus', 'Menus::index', ['filter' => 'checkRole']);


/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
