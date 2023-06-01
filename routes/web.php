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

Route::group(['middleware'=>['guest']],function(){
    Route::get('/','Auth\LoginController@showLoginForm');
    Route::get('/login','Auth\LoginController@showLoginForm');
    Route::post('/login', 'Auth\LoginController@login')->name('login');
});

Route::group(['middleware'=>['auth']],function(){
    
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
    Route::get('/dashboard', 'DashboardController');
    Route::get('/dashboard/obtenerDatos', 'DashboardController@obtenerDatos');
    //Notificaciones 
    Route::post('/notification/get', 'NotificationController@get'); 

    ///dashboard/productosVendidos
    Route::get('/dashboard/productosVendidos', 'DashboardController@productosVendidos');
    Route::get('/dashboard/clientesCompradores', 'DashboardController@clientesCompradores');
    Route::get('/dashboard/productosPedidos', 'DashboardController@productosPedidos');
    Route::get('/dashboard/ventasDia', 'DashboardController@ventasDia');
    Route::get('/dashboard/reporteIndicador1', 'DashboardController@reporteIndicador1');
    Route::get('/dashboard/reporteIndicador1_postest', 'DashboardController@reporteIndicador1_postest');
    Route::get('/dashboard/reporteIndicador2', 'DashboardController@reporteIndicador2');
    Route::get('/dashboard/reporteIndicador2_postest', 'DashboardController@reporteIndicador2_postest');
    
    
    
    Route::get('/main', function () {
        return view('contenido/contenido');
    })->name('main');

    Route::group(['middleware' => ['Almacenero']], function () {
         /*categoria esta en el método index*/
        Route::get('/categoria', 'CategoriaController@index');
        Route::post('/categoria/registrar', 'CategoriaController@store');
        Route::put('/categoria/actualizar', 'CategoriaController@update');
        Route::put('/categoria/desactivar', 'CategoriaController@desactivar');
        Route::put('/categoria/activar', 'CategoriaController@activar');
        Route::get('/categoria/selectCategoria', 'CategoriaController@selectCategoria');

        Route::get('/producto', 'ProductoController@index');
        Route::post('/producto/registrar', 'ProductoController@store');
        Route::put('/producto/actualizar', 'ProductoController@update');
        Route::put('/producto/desactivar', 'ProductoController@desactivar');
        Route::put('/producto/activar', 'ProductoController@activar');
        Route::get('/producto/buscarProducto', 'ProductoController@buscarProducto');
        Route::get('/producto/listarProducto', 'ProductoController@listarProducto');
        Route::get('/producto/listarPdf','ProductoController@listarPdf')->name('productos_pdf');
        Route::get('/producto/selectUnidad_medida', 'ProductoController@selectUnidad_medida');

        Route::get('/proveedor', 'ProveedorController@index');
        Route::post('/proveedor/registrar', 'ProveedorController@store');
        Route::put('/proveedor/actualizar', 'ProveedorController@update');
        Route::get('/proveedor/selectProveedor', 'ProveedorController@selectProveedor');

        Route::get('/compra', 'CompraController@index');
        Route::post('/compra/registrar', 'CompraController@store');
        Route::put('/compra/desactivar', 'CompraController@desactivar');
        Route::get('/compra/obtenerCabecera', 'CompraController@obtenerCabecera');
        Route::get('/compra/obtenerDetalles', 'CompraController@obtenerDetalles');

    });

    Route::group(['middleware' => ['Vendedor']], function () {
        Route::get('/cliente', 'ClienteController@index');
        Route::post('/cliente/registrar', 'ClienteController@store');
        Route::put('/cliente/actualizar', 'ClienteController@update');
        Route::get('/cliente/selectCliente', 'ClienteController@selectCliente');
 
        Route::get('/producto/buscarProductoVenta', 'ProductoController@buscarProductoVenta');
        Route::get('/producto/listarProductoVenta', 'ProductoController@listarProductoVenta');

        Route::get('/venta', 'VentaController@index');
        Route::post('/venta/registrar', 'VentaController@store');
        Route::put('/venta/desactivar', 'VentaController@desactivar');
        Route::get('/venta/obtenerCabecera', 'VentaController@obtenerCabecera');
        Route::get('/venta/obtenerDetalles', 'VentaController@obtenerDetalles');
        Route::get('/venta/pdf/{id}','VentaController@pdf')->name('venta_pdf');
    });

    Route::group(['middleware' => ['Administrador']], function () {
        /*
        Route::get('sendmail', function(){
            $data = array(
                'name' => "Laravel 5.6",
            );
            
            Mail::send('emails.welcome', $data, function ($message){
            $message->from('alexfus8@gmail.com', 'Curso Laravel');
            $message->to('alexfus8@gmail.com')->subject('test email');
            });
            return "Tú email ha sido enviado correctamente";
        });*/
        Route::get('/pedido/sendEmail', 'PedidoController@sendEmail');
        Route::get('/categoria', 'CategoriaController@index');
        Route::post('/categoria/registrar', 'CategoriaController@store');
        Route::put('/categoria/actualizar', 'CategoriaController@update');
        Route::put('/categoria/desactivar', 'CategoriaController@desactivar');
        Route::put('/categoria/activar', 'CategoriaController@activar');
        Route::get('/categoria/selectCategoria', 'CategoriaController@selectCategoria');
        Route::post('/categoria/validacionReact', 'CategoriaController@validacionReact');
        
        //RUTA PARA EL PRODUCTO
        Route::get('/producto', 'ProductoController@index');
        Route::post('/producto/registrar', 'ProductoController@store');
        Route::put('/producto/actualizar', 'ProductoController@update');
        Route::put('/producto/desactivar', 'ProductoController@desactivar');
        Route::put('/producto/activar', 'ProductoController@activar');
        Route::get('/producto/buscarProducto', 'ProductoController@buscarProducto');
        Route::get('/producto/listarProducto', 'ProductoController@listarProducto');
        Route::get('/producto/buscarProductoVenta', 'ProductoController@buscarProductoVenta');
        Route::get('/producto/listarProductoVenta', 'ProductoController@listarProductoVenta');
        Route::get('/producto/listarPdf','ProductoController@listarPdf')->name('productos_pdf');
        Route::post('/producto/validacionReact', 'ProductoController@validacionReact');

        //RUTA PARA EL INDICADOR ENTREGA PERFECTA PRE TEST
        Route::get('/entrega_perfecta_pretest', 'EntregaPerfectaPreTestController@index');
        Route::post('/entrega_perfecta_pretest/registrar', 'EntregaPerfectaPreTestController@store');
        Route::put('/entrega_perfecta_pretest/actualizar', 'EntregaPerfectaPreTestController@update');
        Route::get('/entrega_perfecta_pretest/reporteindicador1', 'EntregaPerfectaPreTestController@reporteIndicador1');
        Route::put('/entrega_perfecta_pretest/eliminar', 'EntregaPerfectaPreTestController@eliminar');

        //RUTA PARA EL INDICADOR de entregas a tiempo PRETEST
        Route::get('/entregas_tiempo_pretest', 'EntregasTiempoPreTestController@index');
        Route::post('/entregas_tiempo_pretest/registrar', 'EntregasTiempoPreTestController@store');
        Route::put('/entregas_tiempo_pretest/actualizar', 'EntregasTiempoPreTestController@update');
        Route::get('/entregas_tiempo_pretest/reporteindicador2', 'EntregasTiempoPreTestController@reporteIndicador2');
        Route::put('/entregas_tiempo_pretest/eliminar', 'EntregasTiempoPreTestController@eliminar');


        //RUTA PARA EL INDICADOR ENTREGA PERFECTA POSTEST
        Route::get('/entrega_perfecta_postest', 'EntregaPerfectaPosTestController@index');
        Route::get('/entrega_perfecta_postest/reporteIndicador1', 'EntregaPerfectaPosTestController@reporteIndicador1');

        //RUTA PARA EL INDICADOR ENTREGAS A TIEMPO POSTEST
        Route::get('/entregas_tiempo_postest', 'EntregasTiempoPosTestController@index');
        Route::get('/entregas_tiempo_postest/reporteIndicador2', 'EntregasTiempoPosTestController@reporteIndicador2');

        Route::get('/proveedor', 'ProveedorController@index');
        Route::post('/proveedor/registrar', 'ProveedorController@store');
        Route::put('/proveedor/actualizar', 'ProveedorController@update');
        Route::get('/proveedor/selectProveedor', 'ProveedorController@selectProveedor');

        Route::get('/compra', 'CompraController@index');
        Route::post('/compra/registrar', 'CompraController@store');
        Route::put('/compra/desactivar', 'CompraController@desactivar');
        Route::get('/compra/obtenerCabecera', 'CompraController@obtenerCabecera');
        Route::get('/compra/obtenerDetalles', 'CompraController@obtenerDetalles');
        
        //RUTA PARA EL CLIENTE
        Route::get('/cliente', 'ClienteController@index');
        Route::post('/cliente/registrar', 'ClienteController@store');
        Route::put('/cliente/actualizar', 'ClienteController@update');
        Route::get('/cliente/selectCliente', 'ClienteController@selectCliente');
        
        //RUTA PARA LA VENTA
        Route::get('/venta', 'VentaController@index');
        Route::post('/venta/registrar', 'VentaController@store');
        Route::put('/venta/desactivar', 'VentaController@desactivar');
        Route::get('/venta/obtenerCabecera', 'VentaController@obtenerCabecera');
        Route::get('/venta/obtenerDetalles', 'VentaController@obtenerDetalles');
        Route::get('/venta/pdf/{id}','VentaController@pdf')->name('venta_pdf');

        //
        Route::get('/venta/obtenerNumComprobante', 'VentaController@obtenerNumComprobante');

        //Pedidos
        Route::post('/pedido/registrar', 'PedidoController@store');
        Route::get('/pedido', 'PedidoController@index');
        Route::put('/pedido/desactivar', 'PedidoController@desactivar');
        Route::put('/pedido/activarEntrega', 'PedidoController@activarEntrega');
        Route::put('/pedido/eliminar', 'PedidoController@eliminar');
        Route::get('/pedido/obtenerCabecera', 'PedidoController@obtenerCabecera');
        Route::get('/pedido/obtenerDetalles', 'PedidoController@obtenerDetalles');
        Route::put('/pedido/actualizar', 'PedidoController@update');
        Route::put('/pedido/cambiarEstado', 'PedidoController@cambiarEstado');
        Route::get('/pedido/pdf/{id}','PedidoController@pdf')->name('pedido_pdf');
        Route::get('/pedido/pdfguia/{id}','PedidoController@pdfguia')->name('pedido_pdfguia');
        Route::get('/pedido/selectVehiculo', 'PedidoController@selectVehiculo');
        Route::get('/pedido/selectTransportista', 'PedidoController@selectTransportista');

        //Despacho
        Route::get('/despacho', 'DespachoController@index');
        Route::post('/despacho/obtenerCodigo', 'DespachoController@obtenerCodigo');
        Route::post('/despacho/activarEntrega', 'DespachoController@activarEntrega');

        Route::get('/rol', 'RolController@index');
        Route::get('/rol/selectRol', 'RolController@selectRol');
        
        Route::get('/user', 'UserController@index');
        Route::post('/user/registrar', 'UserController@store');
        Route::put('/user/actualizar', 'UserController@update');
        Route::put('/user/desactivar', 'UserController@desactivar');
        Route::put('/user/activar', 'UserController@activar');
        Route::post('/user/validacionReact', 'UserController@validacionReact');
        Route::post('/user/validacionReactUser', 'UserController@validacionReactUser');
    });

});

//Route::get('/home', 'HomeController@index')->name('home');
