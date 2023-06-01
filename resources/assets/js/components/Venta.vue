<template>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Administrar Ventas</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active">Administrar Ventas</li>
                    </ol>
                    </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <!-- Ejemplo de tabla Listado -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="callout callout-info">
                        <button type="button" @click="mostrarDetalle()" class="btn btn-primary">
                            <i class="fa fa-plus-circle"></i>&nbsp;Agregar Venta
                        </button>
                    </div>
                    <!-- Listado-->
                    <template v-if="listado==1">
                        <div class="card card-primary">
                            <div class="card-header llamada llamada-info" style="padding: 1rem !important;">
                                <div class="row col-md-12">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select class="form-control" v-model="criterio">
                                                <option value="tipo_comprobante">Tipo Comprobante</option>
                                                <option value="num_comprobante">Número Comprobante</option>
                                                <option value="fecha_hora">Fecha-Hora</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" v-model="buscar" @keyup.enter="listarVenta(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <button type="submit" @click="listarVenta(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Opciones</th>
                                                    <th>Usuario</th>
                                                    <th>Cliente</th>
                                                    <th>Tipo Comprobante</th>
                                                    <th>Serie Comprobante</th>
                                                    <th>Número Comprobante</th>
                                                    <th>Fecha Hora</th>
                                                    <th>Total</th>
                                                    <th>Impuesto</th>
                                                    <th>Estado</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="venta in arrayVenta" :key="venta.id">
                                                    <td>
                                                        <button type="button" @click="verVenta(venta.id)" class="btn btn-success btn-sm btn-xs">
                                                            <i class="fa fa-eye"></i>
                                                            </button> &nbsp;
                                                        <button type="button" @click="pdfVenta(venta.id)" class="btn btn-info btn-sm btn-xs">
                                                            <i class="far fa-file-pdf"></i>
                                                            </button> &nbsp;
                                                        <template v-if="venta.estado=='Registrado'">
                                                            <button type="button" class="btn btn-danger btn-sm btn-xs" @click="desactivarVenta(venta.id)">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </template>
                                                    </td>
                                                    <td v-text="venta.usuario"></td>
                                                    <td v-text="venta.nombre"></td>
                                                    <td v-text="venta.tipo_comprobante"></td>
                                                    <td v-text="venta.serie_comprobante"></td>
                                                    <td v-text="venta.num_comprobante"></td>
                                                    <td v-text="venta.fecha_hora"></td>
                                                    <td v-text="venta.total"></td>
                                                    <td v-text="venta.impuesto"></td>
                                                    <td>
                                                        <div v-if="venta.estado=='Registrado'">
                                                            <span class="badge badge verde">Registrado</span>
                                                        </div>
                                                        <div v-else>
                                                            <span class="badge badge rojo">Anulado</span>
                                                        </div>
                                                    </td>
                                                </tr>                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <nav aria-label="Contacts Page Navigation">
                                    <ul class="pagination justify-content-center m-0">
                                        <li class="page-item" v-if="pagination.current_page > 1">
                                            <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                                        </li>
                                        <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                            <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                                        </li>
                                        <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                            <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </template>
                    <!--Fin Listado-->
                    <!-- Detalle-->
                    <template v-else-if="listado==0">
                        <div class="card card-primary">
                            <!--Primera cara-->
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="">Cliente <span style="color:red;" v-show="idcliente==0">(*Ingrese)</span></label>
                                            <v-select
                                                :on-search="selectCliente"
                                                label="nombre"
                                                :options="arrayCliente"
                                                placeholder="Buscar Clientes..."
                                                :onChange="getDatosCliente"
                                                :class="{'border-danger': idcliente==0}"                                        
                                            >
                                            </v-select>
                                        </div>
                                    </div>
                                    <div class="col-md-4" v-if="tipo_comprobante=='FACTURA'">
                                        <div class="form-group">
                                            <label for="">Impuesto(*)</label>
                                            <input type="text" class="form-control" v-model="impuesto" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4" v-else-if="tipo_comprobante=='BOLETA DE VENTA'">
                                        <div class="form-group">
                                            <label for="">Impuesto(*)</label>
                                            <input type="text"  value="0" step="any" class="form-control" readonly v-model="impuesto">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tipo Comprobante(*)</label>
                                            <select id="tipo_comprobante" class="form-control" v-model="tipo_comprobante" @change="ddlselect">
                                                <option disabled="disabled" value="0">Seleccione</option>
                                                <option value="BOLETA DE VENTA">Boleta de Venta</option>
                                                <option value="FACTURA">Factura</option>
                                                <!--<option value="GUIA DE REMISION">Guía de Remisión</option>-->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Serie Comprobante</label>
                                            <input type="text" class="form-control"  readonly v-model="serie_comprobante" placeholder="000x">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Número Comprobante(*)</label>
                                            <input type="text" class="form-control" readonly v-model="num_comprobante" placeholder="000xx">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Dirección de Entrega <span style="color:red;" v-show="dir_enviar==0">(*Ingrese)</span></label>
                                            <input type="text" class="form-control" :class="{'border-danger': dir_enviar==0}" v-model="dir_enviar" placeholder="Ingrese dirección destino del pedido...">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Fecha de Entrega <span style="color:red;" v-show="fecha_enviar==0">(*Ingrese)</span></label>
                                            <input type="date" class="form-control" :class="{'border-danger': fecha_enviar==0}" v-model="fecha_enviar" placeholder="000xx">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Hora de Entrega <span style="color:red;" v-show="hora_enviar==0">(*Ingrese)</span></label>
                                            <input type="time" class="form-control" :class="{'border-danger': hora_enviar==0}" v-model="hora_enviar" placeholder="000xx">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Descripción</label>
                                            <textarea type="text" class="form-control" v-model="descripcion" placeholder="Ingrese descripción..."></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Producto <span style="color:red;" v-show="idproducto==0">(*Ingrese código o Seleccione)</span></label>
                                            <div class="form-inline">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" :class="{'border-danger' : codigo == 0 && idproducto ==0}" v-model="codigo" @keyup.enter="buscarProducto()" placeholder="Ingrese código">
                                                </div>
                                                <div class="form-group mx-sm-3">
                                                    <button @click="abrirModal()" class="btn btn-primary"><i class="fa fa-search-plus"></i> Buscar</button>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" readonly class="form-control" :class="{'border-danger' : idproducto == 0}" v-model="producto">
                                                </div>
                                            </div>                                    
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Precio <span style="color:red;" v-show="idproducto>0 && precio<=0">(*Ingrese)</span></label>
                                            <input type="number" value="0" min="0.1" step="0.1" class="form-control" :class="{'border-danger' : idproducto>0 && precio <=0}" v-model="precio">
                                            <span style="color:red;" v-show="idproducto>0 && precio<=0">El valor debe ser superior a 0</span>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Cantidad <span style="color:red;" v-show="idproducto>0 && cantidad<=0">(*Ingrese)</span></label>
                                            <input type="number" value="0" min="1" pattern="^[0-9]+" class="form-control" :class="{'border-danger' : idproducto>0 && cantidad <=0}" v-model="cantidad">
                                            <span style="color:red;" v-show="idproducto>0 && cantidad<=0">El valor debe ser igual o superior a 1</span>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Descuento</label>
                                            <input type="number" value="0" class="form-control" v-model="descuento">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <button @click="agregarDetalle()" class="btn btn-success form-control btnagregar"><i class="fa fa-plus-square"></i> Agregar</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="table-responsive col-md-12">
                                        <table class="table table-bordered table-striped table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Opciones</th>
                                                    <th>Producto</th>
                                                    <th>Precio</th>
                                                    <th>Cantidad</th>
                                                    <th>Descuento</th>
                                                    <th>Importe</th>
                                                </tr>
                                            </thead>
                                            <tbody v-if="arrayDetalle.length">
                                                <tr v-for="(detalle,index) in arrayDetalle" :key="detalle.id">
                                                    <td>
                                                        <button @click="eliminarDetalle(index)" type="button" class="btn btn-danger btn-sm">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </td>
                                                    <td v-text="detalle.producto">
                                                    </td>
                                                    <td>
                                                        <input v-model="detalle.precio" type="number" step="0.1" min="0.1" class="form-control" :class="{'border-danger': detalle.precio<=0}">
                                                        <span style="color:red;" v-show="detalle.precio<=0">El valor debe ser superior a 0</span>
                                                    </td>
                                                    <td>
                                                        <span style="color:red;" v-show="detalle.cantidad>detalle.stock">Stock: {{detalle.stock}}</span>
                                                        <input v-model="detalle.cantidad" type="number" min="1" pattern="^[0-9]+" class="form-control" :class="{'border-danger': detalle.cantidad>detalle.stock || detalle.cantidad<1}">
                                                        <span style="color:red;" v-show="detalle.cantidad<1">El valor debe ser igual o superior a 1</span>
                                                    </td>
                                                    <td>
                                                        <span style="color:red;" v-show="detalle.descuento>(detalle.precio*detalle.cantidad)">Descuento superior</span>
                                                        <input v-model="detalle.descuento" type="number" class="form-control" :class="{'border-danger' : detalle.descuento>(detalle.precio*detalle.cantidad)}">
                                                    </td>
                                                    <td>
                                                        {{(detalle.precio*detalle.cantidad-detalle.descuento).toFixed(2)}}
                                                    </td>
                                                </tr>
                                                <tr style="background-color: #CEECF5;">
                                                    <td colspan="5" style="text-align: right !important;"><strong>Sub Total:</strong></td>
                                                    <td>S/. {{totalParcial=(total-totalImpuesto).toFixed(2)}}</td>
                                                </tr>
                                                <tr style="background-color: #CEECF5;">
                                                    <td colspan="5" style="text-align: right !important;"><strong>IGV 18%:</strong></td>
                                                    <td>S/. {{totalImpuesto=((total*impuesto)/(1+impuesto)).toFixed(2)}}</td>
                                                </tr>
                                                <tr style="background-color: #CEECF5;">
                                                    <td colspan="5" style="text-align: right !important;"><strong>Total:</strong></td>
                                                    <td>S/. {{total=calcularTotal.toFixed(2)}}</td>
                                                </tr>
                                            </tbody>
                                            <tbody v-else>
                                                <tr>
                                                    <td colspan="6" style="color:red;">
                                                        No hay productos agregados
                                                    </td>
                                                </tr>
                                            </tbody>                                    
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group text-center">
                                <div class="col-md-12">
                                    <div v-show="errorVenta" class="form-group row div-error">
                                        <div class="text-center text-error">
                                            <div v-for="error in errorMostrarMsjVenta" :key="error" v-text="error">

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer">
                                <div class="col-md-12 justify-content-between" style="display: flex !important;">
                                    <button type="button" @click="ocultarDetalle()" class="btn btn-secondary pull-left"><i class="fa fa-arrow-circle-left"></i>&nbsp;Salir</button>
                                    <button type="button" class="btn btn-primary pull-right" @click="registrarVenta()"><i class="fa fa-save"></i>&nbsp;Registrar Venta</button>
                                </div>
                            </div>
                        </div>
                    </template>
                    <!-- Fin Detalle-->
                    <!-- Ver compra -->
                    <template v-else-if="listado==2">
                        <div class="card card-primary">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="">Cliente</label>
                                            <p v-text="cliente"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="">Impuesto</label>
                                        <p v-text="impuesto"></p>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tipo Comprobante</label>
                                            <p v-text="tipo_comprobante"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Serie Comprobante</label>
                                            <p v-text="serie_comprobante"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Número Comprobante</label>
                                            <p v-text="num_comprobante"></p>
                                        </div>
                                    </div>
                                    <div class="table-responsive col-md-12">
                                        <table class="table table-bordered table-striped table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Producto</th>
                                                    <th>Precio</th>
                                                    <th>Cantidad</th>
                                                    <th>Descuento</th>
                                                    <th>Importe</th>
                                                </tr>
                                            </thead>
                                            <tbody v-if="arrayDetalle.length">
                                                <tr v-for="detalle in arrayDetalle" :key="detalle.id">
                                                    <td v-text="detalle.producto">
                                                    </td>
                                                    <td v-text="detalle.precio">
                                                    </td>
                                                    <td v-text="detalle.cantidad">
                                                    </td>
                                                    <td v-text="detalle.descuento">
                                                    </td>
                                                    <td>
                                                        {{(detalle.precio*detalle.cantidad-detalle.descuento).toFixed(2)}}
                                                    </td>
                                                </tr>
                                                <tr style="background-color: #CEECF5;" v-if="tipo_comprobante=='FACTURA'">
                                                    <td colspan="4" style="text-align: right !important;"><strong>Sub Total:</strong></td>
                                                    <td>S/. {{totalParcial=(total-totalImpuesto).toFixed(2)}}</td>
                                                </tr>
                                                <tr style="background-color: #CEECF5;" v-if="tipo_comprobante=='FACTURA'">
                                                    <td colspan="4" style="text-align: right !important;"><strong>IGV 18%:</strong></td>
                                                    <td>S/. {{totalImpuesto=(total - (total/1.18)).toFixed(2)}}</td>
                                                </tr>
                                                <tr style="background-color: #CEECF5;">
                                                    <td colspan="4" style="text-align: right !important;"><strong>Total:</strong></td>
                                                    <td>S/. {{total}}</td>
                                                </tr>
                                            </tbody>
                                            <tbody v-else>
                                                <tr>
                                                    <td colspan="5" style="color:red;">
                                                        No hay productos agregados
                                                    </td>
                                                </tr>
                                            </tbody>                                    
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="button" @click="ocultarDetalle()" class="btn btn-secondary"><i class="fa fa-arrow-circle-left"></i>&nbsp;Salir</button>
                            </div>
                        </div>
                    </template>
                    <!-- fin ver compra -->
                </div>
            </div>
        </div>
        <!-- Fin ejemplo de tabla Listado -->
    </section>
    <!--Inicio del modal agregar/actualizar-->
    <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal, 'show' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none; overflow-y: scroll;" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <!--CABEZA DEL MODAL-->
                <div class="modal-header" style="background:#117a8b; color:white">
                    <h4 class="modal-title" v-text="tituloModal"></h4>
                    <button type="button" class="close" data-dismiss="modal" @click="cerrarModal()">&times;</button>
                </div>
                <!--CUERPO DEL MODAL-->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <select class="form-control" v-model="criterioA">
                                <option value="nombre">Nombre</option>
                                <option value="descripcion">Descripción</option>
                                <option value="codigo">Código</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" v-model="buscarA" @keyup.enter="listarProducto(buscarA,criterioA)" class="form-control" placeholder="Texto a buscar">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <button type="submit" @click="listarProducto(buscarA,criterioA)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Agregar</th>
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Un.Medida</th>
                                    <th>Descripción</th>
                                    <th>Categoría</th>
                                    <th>Fecha de Vencimiento</th>
                                    <th>Precio Venta</th>
                                    <th>Stock</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="producto in arrayProducto" :key="producto.id">
                                    <td>
                                        <button type="button" @click="agregarDetalleModal(producto)" class="btn btn-success btn-xs">
                                        <i class="fa fa-check"></i>
                                        </button>
                                    </td>
                                    <td v-text="producto.codigo"></td>
                                    <td v-text="producto.nombre"></td>
                                    <td v-text="producto.unidad_medida"></td>
                                    <td v-text="producto.descripcion"></td>
                                    <td v-text="producto.nombre_categoria"></td>
                                    <td v-text="producto.fecha_vencimiento"></td>
                                    <td v-text="producto.precio_venta"></td>
                                    <td>
                                        <div v-if="producto.stock==0">
                                        <span class="badge badge rojo tamletra" v-text="producto.stock"></span>
                                        <span class="badge badge rojo">¡NO HAY STOCK!</span>
                                        </div>
                                        <div v-else-if="producto.stock<=10">
                                            <span class="badge badge rojo tamletra" v-text="producto.stock"></span>
                                            <span class="badge badge rojo">¡STOCK BAJO!</span>
                                        </div>
                                        <div v-else-if="producto.stock>=10 && producto.stock<=20">
                                            <span class="badge badge naranja tamletra" v-text="producto.stock"></span>
                                            <!--<span class="badge badge rojo">STOCK BAJO</span>-->
                                        </div>
                                        <div v-else-if="producto.stock>20">
                                            <span class="badge badge verde tamletra" v-text="producto.stock"></span>
                                        </div>
                                    </td>
                                    <td>
                                        <div v-if="producto.condicion">
                                            <span class="badge badge verde">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge rojo">Desactivado</span>
                                        </div>
                                        
                                    </td>
                                </tr>                                
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="cerrarModal()"><i class="fas fa-times"></i>&nbsp;Salir</button>
                    <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarPersona()">Guardar</button>
                    <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarPersona()">Actualizar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal-->
</div>
</template>

<script>
    import vSelect from 'vue-select';
    import VueMoment  from 'vue-moment';
    import moment  from 'moment';


    export default {
        data (){
            return {
                venta_id: 0,
                idcliente:0,
                cliente:'',
                tipo_comprobante : 'BOLETA DE VENTA',
                serie_comprobante : '',
                num_comprobante : '',
                impuesto: 0.18,
                total:0.0,
                totalImpuesto: 0.0,
                totalParcial: 0.0,
                dir_enviar: '',
                fecha_enviar: '',
                hora_enviar: '',
                descripcion: '',
                arrayVenta : [],
                arrayCliente: [],
                arrayDetalle : [],
                listado:1,
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorVenta : 0,
                pruebaError: 0,
                errorMostrarMsjVenta : [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'num_comprobante',
                buscar : '',
                criterioA:'nombre',
                buscarA: '',
                arrayProducto: [],
                idproducto: 0,
                codigo: '',
                producto: '',
                precio: 0,
                cantidad:0,
                descuento: 0,
                stock:0,

                arrayComprobante:[],
                varNumBoletas: '',
                varNumFacturas: '',
                varNumGuia: ''

            }
        },
        components: {
            vSelect
        },
        computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            //Calcula los elementos de la paginación
            pagesNumber: function() {
                if(!this.pagination.to) {
                    return [];
                }
                
                var from = this.pagination.current_page - this.offset; 
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2); 
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }  

                var pagesArray = [];
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            },
            calcularTotal: function(){
                var resultado=0.0;
                for(var i=0;i<this.arrayDetalle.length;i++){
                    resultado=resultado+(this.arrayDetalle[i].precio*this.arrayDetalle[i].cantidad-this.arrayDetalle[i].descuento)
                }
                return resultado;
            }
        },
        methods : {
            ddlselect(){
                let me=this;
                var url= '/venta/obtenerNumComprobante';
                
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayComprobante = respuesta.ventas;
                    //me.loadobtenerNumComprobante();
                    me.varNumBoletas=me.arrayComprobante[0]['numboletas'];
                    me.varNumFacturas=me.arrayComprobante[0]['numfacturas'];
                    me.varNumGuia=me.arrayComprobante[0]['numguia'];

                    if(me.tipo_comprobante=="FACTURA"){
                        me.impuesto=0.18;
                        
                        if(me.num_comprobante<99999){
                            me.serie_comprobante='001';
                            me.num_comprobante=me.varNumFacturas;
                        }
                        if(me.num_comprobante=="FACTURA VACIA"){
                            me.serie_comprobante='001';
                            me.num_comprobante='00001';
                        }
                    }
                    if(me.tipo_comprobante=="BOLETA DE VENTA"){
                        me.impuesto=0;
                        
                        if(me.num_comprobante<99999){
                            me.serie_comprobante='001';
                            me.num_comprobante=me.varNumBoletas;
                        }
                        if(me.num_comprobante=="BOLETA VACIA"){
                            me.serie_comprobante='004';
                            me.num_comprobante='00001';
                        }
                    }

                    if(me.tipo_comprobante=="GUIA DE REMISION"){
                        me.impuesto=0;
                        
                        if(me.num_comprobante<99999){
                            me.serie_comprobante='0001';
                            me.num_comprobante=me.varNumGuia;
                        }
                        if(me.num_comprobante=="GUIA DE REMISION VACIA"){
                            me.serie_comprobante='0001';
                            me.num_comprobante='00001';
                        }
                    }


                })
                .catch(function (error) {
                    console.log(error);
                });


                
            },

            listarVenta (page,buscar,criterio){


                let me=this;
                var url= '/venta?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayVenta = respuesta.ventas.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectCliente(search,loading){
                let me=this;
                loading(true)

                var url= '/cliente/selectCliente?filtro='+search;
                axios.get(url).then(function (response) {
                    let respuesta = response.data;
                    q: search
                    me.arrayCliente=respuesta.clientes;
                    loading(false)
                })
                .catch(function (error) {
                    console.log(error);
                });
            }, 
            getDatosCliente(val1){
                let me = this;
                me.loading = true;
                if(val1==null){
                    me.idcliente = 0;
                }else{
                    me.idcliente = val1.id;
                }
            },
            buscarProducto(){
                let me=this;
                var url= '/producto/buscarProductoVenta?filtro=' + me.codigo;

                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayProducto = respuesta.productos;

                    if (me.arrayProducto.length>0){
                        me.producto=me.arrayProducto[0]['nombre'];
                        me.idproducto=me.arrayProducto[0]['id'];
                        me.precio=me.arrayProducto[0]['precio_venta'];
                        me.stock=me.arrayProducto[0]['stock'];
                    }
                    else{
                        me.producto='No existe producto';
                        me.idproducto=0;
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            pdfVenta(id){
                window.open('https://www.oindustrias.com/venta/pdf/'+ id + ',' + '_blank');
            },
            cambiarPagina(page,buscar,criterio){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listarVenta(page,buscar,criterio);
            },
            encuentra(id){
                var sw=0;
                for(var i=0;i<this.arrayDetalle.length;i++){
                    if(this.arrayDetalle[i].idproducto==id){
                        sw=true;
                    }
                }
                return sw;
            },
            eliminarDetalle(index){
                let me = this;
                me.arrayDetalle.splice(index, 1);
            },
            agregarDetalle(){
                let me=this;
                if(me.idproducto==0 || me.cantidad==0 || me.precio==0){
                }
                else{
                    if(me.encuentra(me.idproducto)){
                        swal({
                            type: 'error',
                            title: 'Error...',
                            text: 'Ese producto ya se encuentra agregado!',
                            })
                    }
                    else{
                       if(me.cantidad>me.stock){
                           swal({
                            type: 'error',
                            title: 'Error...',
                            text: 'NO hay stock disponible!',
                            })
                       }
                       else if(me.cantidad<1){
                           swal({
                            type: 'error',
                            title: 'Error...',
                            text: 'Cantidad de producto debe ser igual o superior a 1!',
                            })
                       }
                       else if(me.precio<0){
                           swal({
                            type: 'error',
                            title: 'Error...',
                            text: 'Precio de producto debe ser superior a 0!',
                            })
                        }  
                       else{
                           me.arrayDetalle.push({
                                idproducto: me.idproducto,
                                producto: me.producto,
                                cantidad: me.cantidad,
                                precio: me.precio,
                                descuento: me.descuento,
                                stock: me.stock
                            });
                            me.codigo="";
                            me.idproducto=0;
                            me.producto="";
                            me.cantidad=0;
                            me.precio=0;
                            me.descuento=0;
                            me.stock=0
                       }
                    }
                    
                }

                

            },
            agregarDetalleModal(data =[]){
                let me=this;
                if(me.encuentra(data['id'])){
                        swal({
                            type: 'error',
                            title: 'Error...',
                            text: 'Ese producto ya se encuentra agregado!',
                            })
                    }
                    else{
                       me.arrayDetalle.push({
                            idproducto: data['id'],
                            producto: data['nombre'],
                            cantidad: 1,
                            precio: data['precio_venta'],
                            descuento:0,
                            stock:data['stock']
                        }); 
                    }
            },
            listarProducto (buscar,criterio){
                let me=this;
                var url= '/producto/listarProductoVenta?buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayProducto = respuesta.productos.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            registrarVenta(){
                if (this.validarVenta()){
                    return;
                }
                
                let me = this;
                var fecha = moment().format('HH:mm:ss');
                //Formato AM / PM
                /*console.log(moment(fecha, "hh:mm:ss A").add(25, 'minutes').format('LTS'));*/
                /*console.log(moment(fecha, "hh:mm:ss").add(25, 'minutes').format('HH:mm:ss'));
                console.log(moment().format('HH:mm:ss'));
                console.log(moment().format('YYYY-MM-DD'));
                if(!me.checkEntrega){
                    var dir_enviar = 'Almacen';
                    var fecha_enviar = moment().format('YYYY-MM-DD');
                    var hora_enviar = moment(fecha, "hh:mm:ss").add(25, 'minutes').format('HH:mm:ss');//+25 minutos
                    var descripcion = 'Despacho en Almacen';
                }else{
                    var dir_enviar = me.dir_enviar;
                    var fecha_enviar = me.fecha_enviar;
                    var hora_enviar = me.hora_enviar;
                    var descripcion = me.descripcion;
                }*/
                axios.post('/venta/registrar',{
                    'idcliente': this.idcliente,
                    'tipo_comprobante': this.tipo_comprobante,
                    'serie_comprobante' : this.serie_comprobante,
                    'num_comprobante' : this.num_comprobante,
                    'impuesto' : this.impuesto,
                    'total' : this.total,
                    'dir_enviar' : me.dir_enviar,
                    'fecha_enviar' : me.fecha_enviar,
                    'hora_enviar' : me.hora_enviar,
                    'descripcion' : me.descripcion,
                    'data': this.arrayDetalle

                }).then(function (response) {
                    me.listado=1;
                    me.listarVenta(1,'','num_comprobante');
                    me.idcliente=0;
                    me.tipo_comprobante='BOLETA DE VENTA';
                    me.serie_comprobante='';
                    me.num_comprobante='';
                    me.impuesto=0.18;
                    me.total=0.0;
                    me.idproducto=0;
                    me.producto='';
                    me.cantidad=0;
                    me.precio=0;
                    me.stock=0;
                    me.codigo='';
                    me.descuento=0;
                    me.dir_enviar='';
                    me.fecha_enviar='';
                    me.hora_enviar='';
                    me.descripcion='';
                    me.arrayDetalle=[];
                    swal({
                            type: 'success',
                            title: 'Registrado!',
                            text: 'La Venta ha sido Registrada Correctamente!',
                    })
                    window.open('https://www.oindustrias.com/venta/pdf/'+ response.data.id + ',' + '_blank');

                }).catch(function (error) {
                    console.log(error);
                    swal({
                            type: 'error',
                            title: 'Error!',
                            text: 'El Número de Comprobante ya se encuentra Registrado!',
                    })
                });
            },
            validarVenta(){
                let me=this;
                me.errorVenta=0;
                me.errorMostrarMsjVenta =[];
                var art;
                
                me.arrayDetalle.map(function(x){
                    if (x.cantidad>x.stock){
                        art=x.producto + " Con Stock Insuficiente";
                        me.errorMostrarMsjVenta.push(art);
                    }
                    else if (x.cantidad<1){
                        art=x.producto + " cantidad debe ser igual o superior a 1";
                        me.errorMostrarMsjVenta.push(art);
                    }
                    else if (x.precio<=0){
                        art=x.producto + " precio debe ser superior a 0";
                        me.errorMostrarMsjVenta.push(art);
                    }else if (x.descuento>(x.precio*x.cantidad)){
                        art=x.producto + " descuento no puede ser superior al precio de venta x cantidad";
                        me.errorMostrarMsjVenta.push(art);
                    }
                });

                if (me.idcliente==0) me.errorMostrarMsjVenta.push("Ingrese un Cliente");
                if (me.tipo_comprobante==0) me.errorMostrarMsjVenta.push("Seleccione el comprobante");
                if (!me.num_comprobante) me.errorMostrarMsjVenta.push("Ingrese el número de comprobante");
                if (me.tipo_comprobante=="FACTURA" && !me.impuesto) {
                    me.errorMostrarMsjVenta.push("Ingrese el impuesto de compra");
                }
                if (me.dir_enviar==0) me.errorMostrarMsjVenta.push("Ingrese dirección de entrega");
                if (me.fecha_enviar==0) me.errorMostrarMsjVenta.push("Ingrese fecha de entrega");
                if (me.hora_enviar==0) me.errorMostrarMsjVenta.push("Ingrese hora de entrega");
                if (me.arrayDetalle.length<=0) me.errorMostrarMsjVenta.push("Ingrese detalles");
                

                if (me.errorMostrarMsjVenta.length) me.errorVenta = 1;

                return me.errorVenta;
            },
            mostrarDetalle(){
                let me=this;
                me.ddlselect();
                me.listado=0;
                me.idcliente=0;
                me.tipo_comprobante='BOLETA DE VENTA';
                me.impuesto=0,
                me.total=0.0;
                me.idproducto=0;
                me.producto='';
                me.cantidad=0;
                me.precio=0;
                me.arrayDetalle=[];

            },
            ocultarDetalle(){
                this.listado=1;
            },
            verVenta(id){
                let me=this;
                me.listado=2;
                
                //Obtener los datos del compra
                var arrayVentaT=[];
                var url= '/venta/obtenerCabecera?id=' + id;
                
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    arrayVentaT = respuesta.venta;

                    me.cliente = arrayVentaT[0]['nombre'];
                    me.tipo_comprobante=arrayVentaT[0]['tipo_comprobante'];
                    me.serie_comprobante=arrayVentaT[0]['serie_comprobante'];
                    me.num_comprobante=arrayVentaT[0]['num_comprobante'];
                    me.impuesto=arrayVentaT[0]['impuesto'];
                    me.total=arrayVentaT[0]['total'];
                })
                .catch(function (error) {
                    console.log(error);
                });

                //Obtener los datos de los detalles 
                var urld= '/venta/obtenerDetalles?id=' + id;
                
                axios.get(urld).then(function (response) {
                    console.log(response);
                    var respuesta= response.data;
                    me.arrayDetalle = respuesta.detalles;
                })
                .catch(function (error) {
                    console.log(error);
                });               
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
            }, 
            abrirModal(){               
                this.arrayProducto=[];
                this.modal = 1;
                this.tituloModal = 'Seleccione uno o varios productos';
            },
            desactivarVenta(id){
               swal({
                title: 'Esta seguro de anular esta venta?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put('/venta/desactivar',{
                        'id': id
                    }).then(function (response) {
                        me.listarVenta(1,'','num_comprobante');
                        swal(
                        'Anulado!',
                        'La venta ha sido anulada con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
            },
        },
        mounted() {
            this.listarVenta(1,this.buscar,this.criterio);
        }
    }
</script>
<style>    
    .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
    @media (min-width: 600px) {
        .btnagregar {
            margin-top: 2rem;
        }
    }
    .stock-bajo {
	color: red !important;
    font-weight: bold;
    }
    .verde{
        background-color: #00a65a;
    }
    .rojo{
        background-color: red;
    }
    .naranja{
        background-color: orange;
    }
    .tamletra{

        font-size: 16px;
    }
    .border-danger {
        border: 1px solid red;
    }

    .border-danger:focus {
        border-color: red;
    }

    .container {
    display: block !important;
    position: relative !important;
    padding-left: 35px !important;
    margin-bottom: 12px !important;
    cursor: pointer !important;
    font-size: 18px !important;
    -webkit-user-select: none !important;
    -moz-user-select: none !important;
    -ms-user-select: none !important;
    user-select: none !important;
    }

    /* Hide the browser's default checkbox */
    .container input {
    position: absolute !important;
    opacity: 0 !important;
    cursor: pointer !important;
    height: 0 !important;
    width: 0 !important;
    }

    /* Create a custom checkbox */
    .checkmark {
    position: absolute !important;
    top: 0 !important;
    left: 0 !important;
    height: 25px !important;
    width: 25px !important;
    background-color: #eee !important;
    }

    /* On mouse-over, add a grey background color */
    .container:hover input ~ .checkmark {
    background-color: #ccc !important;
    }

    /* When the checkbox is checked, add a blue background */
    .container input:checked ~ .checkmark {
    background-color: #2196F3 !important;
    }

    /* Create the checkmark/indicator (hidden when not checked) */
    .checkmark:after {
    content: "" !important;
    position: absolute !important;
    display: none !important;
    }

    /* Show the checkmark when checked */
    .container input:checked ~ .checkmark:after {
    display: block !important;
    }

    /* Style the checkmark/indicator */
    .container .checkmark:after {
    left: 10px !important;
    top: 6px !important;
    width: 7px !important;
    height: 12px !important;
    border: solid white !important;
    border-width: 0 3px 3px 0 !important;
    -webkit-transform: rotate(45deg) !important;
    -ms-transform: rotate(45deg) !important;
    transform: rotate(45deg) !important;
    }
    .arrayError{
        animation-name: arrayError;
        animation-duration: 5s;
        animation-iteration-count: 3;
    }

    @keyframes arrayError{
        0% {background-color: rgba(215,215,215,0.5);} /*Amarillo*/
        25% {background-color: rgba(189,236,182,0.5);} /*Naranja*/
        50% {background-color: rgba(184,183,153,0.5);} /*Negro*/
        75% {background-color: rgba(189,236,182,0.5);} /*Otra vez naranja*/
        100% {background-color: rgba(215,215,215,0.5);} /*Otra vez amarillo*/
    }
    .llamada{
    border-radius: .25rem;
    background-color: #fff;
    border-left: 5px solid #e9ecef;
    }

    .llamada.llamada-info{
        border-left-color: #117a8b;
    }
</style>
