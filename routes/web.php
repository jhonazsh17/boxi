<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'IndexController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/home/ventas', 'VentasController@Index');

Route::get('/mi-perfil', 'HomeController@perfil');
Route::get('/administracion', 'HomeController@administracion');

Route::get('/empresa/crear', 'EmpresaController@create');
Route::post('/empresa/save', 'EmpresaController@save');
Route::get('/{slug}/dash', 'EmpresaController@empresaDash');
Route::get('/{slug}/{slugsuc}/dash', 'EmpresaController@empresaDashSuc');
Route::get('/{slug}/configuracion', 'EmpresaController@empresaConfiguracion');

Route::post('/ajax/edit/save/empresa/{id}', 'EmpresaController@empresaEdit');

//--- rutas ajax
Route::post('ajax/save/user/employed', 'EmpleadoController@save');

Route::post('/ajax/guardar/sucursal/empresa/{id}','SucursalController@ajaxSave');
Route::post('/ajax/guardar/editar/sucursal/{idSucursal}/empresa/{id}','SucursalController@ajaxSaveEditar');
Route::get('/ajax/obtener/sucursales/{id}','SucursalController@all');
Route::get('/ajax/obtener/sucursales/2/{id}','SucursalController@all2');
Route::get('/ajax/get/sucursal/{id}', 'SucursalController@getSucursal');

Route::get('/ajax/obtener/tipos-inventario/{id}', 'TipoInventarioController@getTipo');
Route::post('/ajax/guardar/tipo-inventario/{id}', 'TipoInventarioController@saveTipo');

Route::post('/ajax/guardar/cargo/empresa/{id}','CargoController@ajaxSave');
Route::get('/ajax/obtener/cargos/{id}', 'CargoController@getCargos');
Route::get('/ajax/obtener/cargos/empresa/{id}', 'CargoController@ajaxGetCargos');

Route::get('/ajax/obtener/usuarios-empleados/{id}', 'EmpleadoController@getDataUsuariosEmpleados');
Route::get('/ajax/obtener/usuario/empleado/{id}', 'EmpleadoController@getEmpleado');

Route::post('/ajax/crear/categoria', 'CategoriaController@crear');
Route::post('/ajax/crear/unidad', 'UnidadMedidaController@crear');
Route::post('/ajax/crear/producto', 'ProductosController@crear');


Route::get('/ajax/obtener/categoria/{id}', 'CategoriaController@getCategoria');
Route::get('/ajax/obtener/all/categorias', 'CategoriaController@getAllCategorias');
Route::get('/ajax/obtener/all/unidades', 'UnidadMedidaController@getAllUnidades');
Route::get('/ajax/obtener/unidad/{id}', 'UnidadMedidaController@getUnidad');
Route::get('/ajax/obtener/productos/{idSucursal}', 'ProductosController@getProductos');
Route::get('/ajax/obtener/productos/almacen/{id}', 'AlmacenController@getProductos');

Route::get('/ajax/obtener/movimientos/almacen/{id}', 'AlmacenController@getMovimientos');

Route::get('/ajax/obtener/todos/productos/{idSucursal}', 'ProductosController@ajaxGetAllProductos');

Route::post('/ajax/guardar/varios/productos/{id}', 'ProductosController@crearProductos');

Route::post('/ajax/crear/inventario', 'InventarioController@crear');
Route::post('/ajax/guardar/inventario/varios/productos/{id}', 'InventarioController@guardarProductos');
Route::get('/ajax/eliminar/producto/inventario/{codigo}', 'InventarioController@eliminarProductoInventario');
Route::get('/ajax/obtener/categoria/unidad/por/code/{codigo}', 'InventarioController@getCatUnidad');
Route::post('/ajax/guardar/producto/en/inventario', 'InventarioController@guardarProductoEnInventario');

Route::get('/ajax/obtener/inventarios/{id}', 'InventarioController@getInventarios');

Route::get('/ajax/obtener/todos/inventarios/{idSucursal}', 'InventarioController@allInventarios');
Route::get('/ajax/get/inventario/{id}', 'InventarioController@getInventario');
Route::get('/ajax/get/productos/inventario/{id}', 'InventarioController@getProductosInventario');
Route::get('/ajax/eliminar/inventario/{id}', 'InventarioController@eliminarInventario');
// Route::get('/ajax/eliminar/producto/en/inventario/{codigo}','InventarioController@eliminarProductoEnInventario');
Route::get('/ajax/obtener/all/tipo-inventario/{id}','TipoInventarioController@getTipoInventario');

Route::post('/ajax/guardar/venta/{id}', 'VentasController@save');
Route::get('/ajax/obtener/ventas/{idSucursal}', 'VentasController@obtenerVentas');
Route::get('/ajax/obtener/ventas/hoy/{idSucursal}', 'VentasController@obtenerVentasHoy');
Route::get('/ajax/obtener/ventas/mes/sincronice/{idSucursal}', 'VentasController@obtenerVentasMesSincronice');

Route::get('/ajax/obtener/ventas/hoy/sincronice/{idSucursal}', 'VentasController@obtenerVentasHoySincronice');
Route::get('/ajax/obtener/total/ventas/hoy/{idSucursal}', 'VentasController@obtenerTotalVentasHoy');
Route::get('/ajax/obtener/ventas/dia/{date}/{idSucursal}', 'VentasController@obtenerVentasDia');
Route::get('/ajax/obtener/total/ventas/dia/{date}/{idSucursal}', 'VentasController@obtenerTotalVentasDia');
Route::get('/ajax/get/venta/{id}', 'VentasController@obtenerVenta');
Route::get('/ajax/get/stock/{id}', 'VentasController@getStockProducto');

Route::post('/ajax/guardar/compra/{id}', 'ComprasController@save');
Route::get('/ajax/obtener/compras/{idSucursal}', 'ComprasController@obtenerCompras');
Route::get('/ajax/obtener/compras/hoy/{idSucursal}', 'ComprasController@obtenerComprasHoy');
Route::get('/ajax/obtener/compras/hoy/sincronice/{idSucursal}', 'ComprasController@obtenerComprasHoySincronice');
Route::get('/ajax/obtener/compras/mes/sincronice/{idSucursal}', 'ComprasController@obtenerComprasMesSincronice');


Route::get('/ajax/obtener/clientes/{idEmpresa}', 'ClienteController@obtenerClientes');
Route::get('/ajax/obtener/todos/clientes/{idEmpresa}', 'ClienteController@allClientes');

Route::get('/ajax/obtener/proveedores/{idEmpresa}', 'ProveedorController@obtenerProveedores');
Route::get('/ajax/obtener/todos/proveedores/{idEmpresa}', 'ProveedorController@allProveedores');

Route::get('/ajax/obtener/categorias/{id}', 'CategoriaController@getAllCategoriasForConfig');
Route::post('/ajax/config/guardar/categoria/{id}', 'CategoriaController@guardarNuevaCategoriaForConfig');

Route::get('/ajax/obtener/unidades/{id}', 'UnidadMedidaController@getAllUnidadesForConfig');
Route::post('/ajax/config/guardar/unidad/{id}', 'UnidadMedidaController@guardarNuevaUnidadForConfig');

//post register empresa
Route::get('/post-register/crear/empresa', 'EmpresaController@createEmpresaPostRegister');

Route::get('/example', 'ExampleController@example_form')->name('example');
Route::post('/create/example', 'ExampleController@crear')->name('create');


Route::get('login/facebook', 'Auth\LoginController@redirectToProvider');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('sunat/api', 'ExampleController@obtener');