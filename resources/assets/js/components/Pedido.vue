<template>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Administrar Pedidos</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active">Administrar Pedidos</li>
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
                    <!--
                    <div class="callout callout-info">
                        <button type="button" @click="mostrarDetalle()" class="btn btn-primary">
                            <i class="fa fa-plus-circle"></i>&nbsp;Nuevo
                        </button>
                    </div>-->
                    <!-- Listado-->
                    <template v-if="listado==1">
                        <div class="card card-primary">
                            <div class="card-header llamada llamada-info" style="padding: 1rem !important;">
                                <div class="row col-md-12">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select class="form-control" v-model="criterio">
                                                <option value="num_pedido">Número Pedido</option>
                                                <option value="created_at">Fecha-Hora Registro</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" v-model="buscar" @keyup.enter="listarPedido(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <button type="submit" @click="listarPedido(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
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
                                                    <th>Número Pedido</th>
                                                    <th>Dirección de Envio</th>
                                                    <th>Fecha-Hora Registro</th>
                                                    <th>Fecha-Hora Envio</th>
                                                    <th>Fecha-Hora Entrega</th>
                                                    <th>Estado</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="pedido in arrayPedido" :key="pedido.id">
                                                    <td>
                                                        <button type="button" @click="verPedido(pedido.id)" class="btn btn-success btn-sm btn-xs">
                                                            <i class="fa fa-eye"></i>
                                                        </button> &nbsp;
                                                        <button title="PDF PEDIDO" type="button" @click="pdfPedido(pedido.id)" class="btn btn-info btn-sm btn-xs">
                                                            <i class="far fa-file-pdf"></i>
                                                        </button> &nbsp;
                                                        <button title="PDF GUIA DE REMISION" type="button" @click="pdfPedidoguia(pedido.id)" class="btn btn-info btn-sm btn-xs">
                                                            <i class="far fa-file-pdf"></i>
                                                        </button> &nbsp;
                                                        <!--<template v-if="pedido.estado=='Entregado'">
                                                        <button type="button" class="btn btn-danger btn-sm btn-xs" @click="desactivarPedido(pedido.id)">
                                                            <i class="fa fa-trash"></i>
                                                        </button> &nbsp;
                                                        </template>-->
                                                        <template v-if="pedido.estado=='Pendiente'">
                                                        <!--
                                                        <button type="button" class="btn btn-danger btn-sm btn-xs" @click="eliminarPedido(pedido.id)">
                                                            <i class="fa fa-trash"></i>
                                                        </button> &nbsp;-->
                                                        <button title="Marcar Entrega" type="button" class="btn btn-success btn-sm btn-xs" @click="activarEntrega(pedido.id)">
                                                            <i class="fa fa-check"></i>
                                                        </button>
                                                        </template>
                                                        
                                                    </td>
                                                    <td v-text="pedido.usuario"></td>
                                                    <td v-text="pedido.nombre"></td>
                                                    <td v-text="pedido.num_pedido"></td>
                                                    <td v-text="pedido.dir_enviar"></td>
                                                    <td v-text="pedido.created_at"></td>
                                                    <td v-text="pedido.fecha_enviar+' '+pedido.hora_enviar"></td>
                                                    <template v-if="pedido.estado=='Entregado'">
                                                        <td v-text="pedido.updated_at"></td>
                                                    </template>
                                                    <template v-else>
                                                        <td>
                                                        </td>
                                                    </template>
                                                    <td>
                                                        <div v-if="pedido.estado=='Pendiente'">
                                                            <span class="badge badge naranja">Pendiente</span>
                                                        </div>
                                                        <div v-else-if="pedido.estado=='Entregado'">
                                                            <span class="badge badge verde">Entregado</span>
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
                        <div class="box-body">
                            <!--Primera cara-->
                            <div class="form-group">
                                <div class="panel panel-primary">
                                    <div class="panel-body">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label for="">Cliente(*)</label>
                                                <v-select
                                                    :on-search="selectCliente"
                                                    label="nombre"
                                                    :options="arrayCliente"
                                                    placeholder="Buscar Clientes..."
                                                    :onChange="getDatosCliente"                                        
                                                >
                                                </v-select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Número de Pedido(*)</label>
                                                <input type="text" class="form-control" v-model="num_pedido" placeholder="000xx">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Dirección a Enviar Pedido(*)</label>
                                                <input type="text" class="form-control" v-model="dir_enviar" placeholder="Ingrese dirección destinto del pedido...">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Fecha Entrega de Pedido(*)</label>
                                                <input type="date" class="form-control" v-model="fecha_enviar" placeholder="000xx">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Hora Entrega de Pedido(*)</label>
                                                <input type="time" class="form-control" v-model="hora_enviar" placeholder="000xx">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Descripción</label>
                                                <textarea type="text" class="form-control" v-model="descripcion" placeholder="Ingrese descripción..."></textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div v-show="errorVenta" class="form-group row div-error">
                                                <div class="text-center text-error">
                                                    <div v-for="error in errorMostrarMsjVenta" :key="error" v-text="error">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="panel panel-primary">
                                    <div class="panel-body">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Producto <span style="color:red;" v-show="idproducto==0">(*Ingrese Código)</span></label>
                                                <div class="form-inline">
                                                    <input type="text" class="form-control" v-model="codigo" @keyup.enter="buscarProducto()" placeholder="Ingrese producto">
                                                    <button @click="abrirModal()" class="btn btn-primary"><i class="fa fa-search-plus"></i></button>
                                                    <input type="text" readonly class="form-control" v-model="producto">
                                                </div>                                    
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Cantidad <span style="color:red;" v-show="cantidad==0">(*Ingrese)</span></label>
                                                <input type="number" value="0" min="1" pattern="^[0-9]+" class="form-control" v-model="cantidad">
                                                <span style="color:red;" v-show="cantidad<0">El valor debe ser igual o superior a 1</span>
                                            </div>
                                        </div>

                                        <div class="col-md-3" title="Agregar Detalle">
                                            <div class="form-group">
                                                <button @click="agregarDetalle()" class="btn btn-success form-control btnagregar"><i class="fa fa-plus-square"></i></button>
                                            </div>
                                        </div>
                                        <div class="table-responsive col-md-12">
                                        <table class="table table-bordered table-striped table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Opciones</th>
                                                    <th>Producto</th>
                                                    <th>Precio del Producto</th>
                                                    <th>Cantidad</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody v-if="arrayDetalle.length">
                                                <tr v-for="(detalle,index) in arrayDetalle" :key="detalle.id">
                                                    <td>
                                                        <button @click="eliminarDetalle(index)" type="button" class="btn btn-danger btn-sm">
                                                            <i class="fa fa-close"></i>
                                                        </button>
                                                    </td>
                                                    <td v-text="detalle.producto">
                                                    </td>
                                                    <td v-text="detalle.precio">
                                                    </td>
                                                    <td>
                                                        <span style="color:red;" v-show="detalle.cantidad>detalle.stock">Stock: {{detalle.stock}}</span>
                                                        <input v-model="detalle.cantidad" type="number" min="1" pattern="^[0-9]+" class="form-control">
                                                        <span style="color:red;" v-show="detalle.cantidad<1">El valor debe ser igual o superior a 1</span>
                                                    </td>
                                                    <td>
                                                        {{(detalle.precio*detalle.cantidad).toFixed(2)}}
                                                    </td>
                                                </tr>
                                                
                                                <tr style="background-color: #CEECF5;">
                                                    <td colspan="4" style="text-align: right !important"><strong>Total:</strong></td>
                                                    <!--ESTE TOTAL SE GUARDA A LA BD TABLA PEDIDOS-->
                                                    <td>S/. {{total=calcularTotal.toFixed(2)}}</td>
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
                            </div>
                            <div class="form-group text-center">
                                <div class="col-md-12">
                                    <button type="button" @click="ocultarDetalle()" class="btn btn-default">Salir</button>
                                    <button type="button" class="btn btn-primary" @click="registrarPedido()">Registrar Pedido</button>
                                </div>
                            </div>
                        </div>
                    </template>
                    <!-- Fin Detalle-->
                    <!-- Ver pedido -->
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
                                    <label for="">Número de Pedido</label>
                                    <p v-text="num_pedido"></p>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Dirección a Enviar Pedido</label>
                                        <p v-text="dir_enviar"></p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Fecha Entrega de Pedido</label>
                                        <p v-text="fecha_enviar"></p>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Hora Entrega de Pedido(*)</label>
                                        <p v-text="hora_enviar"></p>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Descripción</label>
                                        <p v-text="descripcion"></p>
                                    </div>
                                </div>

                                <div class="table-responsive col-md-12">
                                    <table class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>Producto</th>
                                                <th>Precio</th>
                                                <th>Cantidad</th>
                                                <th>Total</th>
                                                <!--
                                                <template  v-if="estado=='Entregado'">
                                                <th>Acción</th>
                                                </template>-->
                                            </tr>
                                        </thead>
                                        <tbody v-if="arrayDetalle.length">
                                            <tr v-for="detalle in arrayDetalle" :key="detalle.id">
                                                <td v-text="detalle.producto">
                                                </td>
                                                <td v-text="detalle.precio">
                                                </td>
                                                <td v-text="detalle.cantidad">
                                                    <!--
                                                    <input :readonly="detalle.inputReadonly" v-model="detalle.cantidad" @input="changeValue($event, index)" @keypress="validateInput($event, index)" ref="detallecantidad" type="number" min="1" pattern="^[0-9]+" class="form-control" :class="{'border-danger': detalle.error}">
                                                    <template v-if="detalle.error">
                                                        <span class="text-error" v-for="error in errorMostrarMsjProducto" :key="error" v-text="error"></span>
                                                    </template>-->
                                                </td>
                                                <td>
                                                    S/. {{(detalle.precio*detalle.cantidad).toFixed(2)}}
                                                </td>
                                                <!--
                                                <template v-if="detalle.inputReadonly">
                                                    <template  v-if="estado=='Entregado'">
                                                        <td>
                                                            <button type="button" @click="retornarProducto(index)" class="btn btn-info btn-sm btn-xs">
                                                                <i class="fas fa-edit"></i>
                                                            </button> &nbsp;
                                                        </td>
                                                    </template>
                                                </template>
                                                <template v-if="detalle.inputReadonly==false && detalle.error==false">
                                                    <td>
                                                        <button type="button" @click="devolverProducto(index)" class="btn btn-success btn-sm btn-xs">
                                                            <i class="fa fa-check"></i>
                                                        </button> &nbsp;
                                                    </td>
                                                </template>-->
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
                    <!-- fin ver pedido -->
                </div>
            </div>
        </div>
        <!-- Fin ejemplo de tabla Listado -->
    </section>
    <!--Inicio del modal agregar/actualizar-->
    <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none; overflow-y: scroll;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!--CABEZA DEL MODAL-->
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <button type="button" class="close" data-dismiss="modal" @click="cerrarModal()">&times;</button>
                    <h4 class="modal-title" v-text="tituloModal"></h4>
                </div>
                <!--CUERPO DEL MODAL-->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <select class="form-control col-md-3" v-model="criterioA">
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
                                    <th>Categoría</th>
                                    <th>Fecha de Vencimiento</th>
                                    <th>Precio del Producto</th>
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
                    <button type="button" class="btn btn-default pull-left" @click="cerrarModal()">Salir</button>
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
    export default {
        data (){
            return {
                errorMostrarMsjProducto: [],
                shouldDisable: true,
                venta_id: 0,
                idcliente:0,
                cliente:'',
                num_pedido : '',
                dir_enviar: '',
                fecha_enviar: '',
                hora_enviar: '',
                descripcion: '',
                estado: '',
                impuesto: 0.18,
                total:0.0,
                totalImpuesto: 0.0,
                totalParcial: 0.0,
                arrayPedido : [],
                arrayCliente: [],
                arrayDetalle : [],
                listado:1,
                arrayVehiculo : [],
                arrayTransportista : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorVenta : 0,
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
                criterio : 'num_pedido',
                buscar : '',
                criterioA:'nombre',
                buscarA: '',
                arrayProducto: [],
                idproducto: 0,
                codigo: '',
                producto: '',
                precio: 0,
                cantidad:0,
                stock:0,

                arrayComprobante:[],
                varNumBoletas: '',
                varNumFacturas: ''

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
                    resultado=resultado+(this.arrayDetalle[i].precio*this.arrayDetalle[i].cantidad)
                }
                return resultado;
            }
        },
        methods : {
            changeValue(event, index) {
                this.errorMostrarMsjProducto =[];
                
                /*if (this.idcategoria==0) this.errorMostrarMsjProducto.push("Seleccione una categoría."); 
                this.$refs.idcategoria.focus();
                if (!this.nombre) this.errorMostrarMsjProducto.push("El nombre del producto no puede estar vacío.");
                this.$refs.nombre.focus();
                if (!this.fecha_vencimiento) this.errorMostrarMsjProducto.push("La fecha de vencimiento del producto no puede estar vacío.");
                this.$refs.fecha_vencimiento.focus();
                if (!this.precio_venta) this.errorMostrarMsjProducto.push("El precio venta del producto debe ser un número y no puede estar vacío.");
                this.$refs.precio_venta.focus();
                if (this.stock<0) this.errorMostrarMsjProducto.push("El stock del producto debe ser un número positivo mayor o igual a 0.");
                this.$refs.stock.focus();
                if (this.precio_venta<0) this.errorMostrarMsjProducto.push("El precio venta del producto debe ser un número positivo mayor a 0.");
                this.$refs.precio_venta.focus();
                if (this.stock.length==0) this.errorMostrarMsjProducto.push("El stock del producto debe ser un número y no puede estar vacío.");
                this.$refs.stock.focus();
                if (this.errorMostrarMsjProducto.length) this.errorProducto = 1;

                return this.errorProducto;*/
                let newEvent = event.target.value;
                var cantmq = this.arrayDetalle[index].maxQuantity;
                if(newEvent > this.arrayDetalle[index].maxQuantity) {
                    this.arrayDetalle[index].error = true;
                    this.errorMostrarMsjProducto.push("no puede ser superior a la cantidad "+cantmq);
                }else if(newEvent == ''){
                    this.arrayDetalle[index].error = true;
                    this.errorMostrarMsjProducto.push("cantidad no puede estar vacio");
                }
                else{
                    this.arrayDetalle[index].error = false;
                }

            },
            validateInput(event, index) {
                const key = event.keyCode;
                if((key >= 48 && key <= 57) || key === 46) {
                    return true
                } else {
                    event.preventDefault();
                }
            },
            retornarProducto(index){
                
                swal({
                title: 'Esta seguro de devolver este producto?',
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
                    me.arrayDetalle[index].inputReadonly = false;
                    var idestdevpedido = this.arrayDetalle[index].idestdevpedido;

                    axios.put('/pedido/cambiarEstado',{
                        'idestdevpedido': idestdevpedido
                    }).then(function (response) {
                        swal(
                        'activado!',
                        'El registro ha sido activado con éxito.',
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
            
            devolverProducto(index){
                var cantidad = parseInt(this.arrayDetalle[index].cantidad);
                var maxcantidad = this.arrayDetalle[index].maxQuantity;
                var iddetalle_pedido = this.arrayDetalle[index].id;
                var idproducto = this.arrayDetalle[index].idproducto;
                var precio = this.arrayDetalle[index].precio;
                var idpedido = this.arrayDetalle[index].idpedido;
                var idestdevpedido = this.arrayDetalle[index].idestdevpedido;

                var newcantidad = maxcantidad - cantidad;
                var newprecio = precio * cantidad;

                let me = this;
                axios.put('/pedido/actualizar',{
                    'iddetalle_pedido': iddetalle_pedido,
                    'cantidad': newcantidad,
                    'cantidad_exac': cantidad,
                    'idproducto': idproducto,
                    'idpedido': idpedido,
                    'idestdevpedido': idestdevpedido,
                    'total': newprecio
                }).then(function (response) {
                    me.verPedido(idpedido);
                    swal({
                            type: 'success',
                            title: 'Actualizado!',
                            text: 'Los Datos del Pedido ha sido Actualizado Correctamente!',
                    })
                }).catch(function (error) {
                    console.log(error);
                    swal({
                            type: 'error',
                            title: 'Error!',
                            text: 'El Nombre o Codigo del Pedido ya se encuentra Registrado!',
                    })
                });
            },
            listarPedido (page,buscar,criterio){
                let me=this;
                var url= '/pedido?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayPedido = respuesta.pedido.data;
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
                me.idcliente = val1.id;
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
            pdfPedido(id){
                window.open('https://www.oindustrias.com/pedido/pdf/'+ id + ',' + '_blank');
            },
            pdfPedidoguia(id){
                window.open('https://www.oindustrias.com/pedido/pdfguia/'+ id + ',' + '_blank');
            },
            cambiarPagina(page,buscar,criterio){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listarPedido(page,buscar,criterio);
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
                                stock: me.stock
                            });
                            me.codigo="";
                            me.idproducto=0;
                            me.producto="";
                            me.cantidad=0;
                            me.precio=0;
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
            registrarPedido(){
                if (this.validarPedido()){
                    return;
                }
                
                let me = this;

                axios.post('/pedido/registrar',{
                    'idcliente': this.idcliente,
                    'num_pedido' : this.num_pedido,
                    'total' : this.total,
                    'dir_enviar': this.dir_enviar,
                    'fecha_enviar': this.fecha_enviar,
                    'hora_enviar': this.hora_enviar,
                    'descripcion': this.descripcion,
                    'data': this.arrayDetalle

                }).then(function (response) {
                    me.listado=1;
                    me.listarPedido(1,'','num_pedido');
                    me.idcliente=0;
                    me.num_pedido='';
                    me.total=0.0;
                    me.idproducto=0;
                    me.producto='';
                    me.cantidad=0;
                    me.precio=0;
                    me.stock=0;
                    me.codigo='';
                    me.descripcion= '';
                    me.dir_enviar= '';
                    me.fecha_enviar= '';
                    me.hora_enviar= '';
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
            validarPedido(){
                let me=this;
                me.errorVenta=0;
                me.errorMostrarMsjVenta =[];
                var art;
                
                me.arrayDetalle.map(function(x){
                    if (x.cantidad>x.stock){
                        art=x.producto + " con stock insuficiente";
                        me.errorMostrarMsjVenta.push(art);
                    }
                    else if (x.cantidad<1){
                        art=x.producto + " cantidad debe ser igual o superior a 1";
                        me.errorMostrarMsjVenta.push(art);
                    }
                    else if (x.precio<=0){
                        art=x.producto + " precio debe ser superior a 0";
                        me.errorMostrarMsjVenta.push(art);
                    }
                });

                if (me.idcliente==0) me.errorMostrarMsjVenta.push("Seleccione un Cliente");
                if (!me.num_pedido) me.errorMostrarMsjVenta.push("Ingrese el número de comprobante");
                if (!me.dir_enviar) me.errorMostrarMsjVenta.push("Ingrese la dirección donde se enviará el pedido");
                if (!me.fecha_enviar) me.errorMostrarMsjVenta.push("Ingrese la fecha para la entrega del pedido");
                if (!me.hora_enviar) me.errorMostrarMsjVenta.push("Ingrese la hora para la entrega del pedido");

                if (me.arrayDetalle.length<=0) me.errorMostrarMsjVenta.push("Ingrese detalles");
                

                if (me.errorMostrarMsjVenta.length) me.errorVenta = 1;
                
                return me.errorVenta;
            },
            mostrarDetalle(){
                let me=this;
                me.listado=0;
                me.idproveedor=0;
                me.impuesto=0,
                me.total=0.0;
                me.idproducto=0;
                me.producto='';
                me.cantidad=0;
                me.precio=0;
                me.num_pedido= '',
                me.descripcion= '';
                me.dir_enviar= '';
                me.fecha_enviar= '';
                me.hora_enviar= '';
                me.arrayDetalle=[];

            },
            ocultarDetalle(){
                this.listado=1;
                this.listarPedido(1,'','num_pedido');
            },
            verPedido(id){
                let me=this;
                me.listado=2;
                
                //Obtener los datos del compra
                var arrayPedidoT=[];
                var url= '/pedido/obtenerCabecera?id=' + id;
                
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    arrayPedidoT = respuesta.pedido;

                    me.cliente = arrayPedidoT[0]['nombre'];
                    me.num_pedido=arrayPedidoT[0]['num_pedido'];
                    me.dir_enviar=arrayPedidoT[0]['dir_enviar'];
                    me.fecha_enviar=arrayPedidoT[0]['fecha_enviar'];
                    me.hora_enviar=arrayPedidoT[0]['hora_enviar'];
                    me.estado=arrayPedidoT[0]['estado'];
                    me.descripcion=arrayPedidoT[0]['descripcion'];
                })
                .catch(function (error) {
                    console.log(error);
                });

                //Obtener los datos de los detalles 
                var urld= '/pedido/obtenerDetalles?id=' + id;
                
                axios.get(urld).then(function (response) {
                    console.log(response);
                    var respuesta= response.data;
                    me.arrayDetalle = respuesta.detalles.map((detalle) => {
                        detalle.inputReadonly = true;
                        detalle.maxQuantity = detalle.cantidad;
                        detalle.error = false;
                        return detalle;
                    });
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
            activarEntrega(id){

                const inputOptions1 = new Map
                this.arrayVehiculo.forEach(item => inputOptions1.set(item.id, item.marca+' - '+item.placa))

                const inputOptions2 = new Map
                this.arrayTransportista.forEach(item => inputOptions2.set(item.id, item.nombre))

                var idvehiculo = 0;
                var idtransportista = 0;
                var descripcionDespacho = '';
                
               swal.mixin({
                    input: 'text',
                    confirmButtonText: 'Siguiente &rarr;',
                    showCancelButton: true,
                    animation: true,
                    progressSteps: ['1', '2', '3', '4']
                }).queue([
                    {
                        title: 'COMPLETE LO SIGUIENTE, SI EL PEDIDO YA ESTA LISTO PARA EL DESPACHO',
                        text: 'Por favor, empieze seleccionando el vehiculo que llevará el despacho!',
                        input: 'select',
                        inputClass: 'swal-select-event',
                        inputPlaceholder: 'Por favor, Seleccione',
                        inputOptions: inputOptions1,
                        inputValidator: (value) => {
                            return new Promise((resolve) => {
                            if (value === '') {
                                resolve('Necesita seleccionar un vehiculo!')
                            } else {
                                resolve()
                            }
                            })
                        }
                    },
                    {
                        title: 'COMPLETE LO SIGUIENTE, SI EL PEDIDO YA ESTA LISTO PARA EL DESPACHO',
                        text: 'Que transportista llevará el despacho?',
                        input: 'select',
                        inputClass: 'swal-select-event',
                        inputPlaceholder: 'Por favor, Seleccione',
                        inputOptions: inputOptions2,

                        inputValidator: (value) => {
                            return new Promise((resolve) => {
                            if (value === '') {
                                resolve('Necesita seleccionar un transportista!')
                            } else {
                                resolve()
                            }
                            })
                        }
                    },
                    {
                        title: 'COMPLETE LO SIGUIENTE, SI EL PEDIDO YA ESTA LISTO PARA EL DESPACHO',
                        text: 'Se reviso que todos los productos de este pedido, se encuentren en el vehiculo?',
                        input: 'radio',
                        inputOptions: {
                                'si' : 'Si',
                                'no' : 'No'
                            },
                        inputValidator: (value) => {
                            return new Promise((resolve) => {
                                if (value === null) {
                                    resolve('Necesita seleccionar una opción!')
                                }
                                else if(value ==='no'){
                                    resolve('No puede continuar, necesita revisar que todos los productos de este pedido, se encuentren en el vehiculo!.')
                                }
                                else {
                                    resolve()
                                }
                            })
                        }
                    },
                    {
                        title: 'COMPLETE LO SIGUIENTE, SI EL PEDIDO YA ESTA LISTO PARA EL DESPACHO',
                        input: 'text',
                        text: 'Alguna otra información adicional que necesita agregar para este despacho?'
                    }
                ]).then((result) => {
                    if (result.value) {
                        idvehiculo = result.value[0];
                        idtransportista = result.value[1];
                        descripcionDespacho = result.value[3];
                        for (var i=0;i<this.arrayVehiculo.length;i++) {
                            var slug  = this.arrayVehiculo[i].id;
                            if (slug == result.value[0]) {
                                var marcaselected = this.arrayVehiculo[i].marca+' - '+this.arrayVehiculo[i].placa;
                            }
                        }

                        for (var i=0;i<this.arrayTransportista.length;i++) {
                            var slug  = this.arrayTransportista[i].id;
                            if (slug == result.value[1]) {
                                var transelected = this.arrayTransportista[i].nombre;
                            }
                        }
                        //var variable = parseInt('xxx');
                        var var4 = '------------';
                        if (isNaN(result.value[3])) {
                            var4 =   result.value[3];//SE EJECUTA
                        }

                        const answers = JSON.stringify(result.value)
                        swal.resetDefaults();
                        swal({
                            title: 'Todo listo!',
                            html:
                                'Confirme su respuesta: <pre style="text-align:left !important;">' +
                                '1. Vehiculo: <span style="color:rgba(0,0,0,0.6);">' + marcaselected + '</span><br>'+
                                '2. Transportista: <span style="color:rgba(0,0,0,0.6);">' + transelected + '</span><br>'+
                                '3. Todos los productos en Vehiculo: <span style="color:rgba(0,0,0,0.6);">' + result.value[2].charAt(0).toUpperCase() + result.value[2].slice(1)+ '</span><br>'+
                                '4. Información adicional: <span style="color:rgba(0,0,0,0.6);">' + var4 + '</span><br>'+
                                '</pre>',
                            confirmButtonText: 'Confirmar!',
                            showCancelButton: true
                        }).then((result) => {
                            if (result.value) {
                                let me = this;
                                console.log(idvehiculo);
                                console.log(idtransportista);
                                console.log(descripcionDespacho);
                                axios.put('/pedido/activarEntrega',{
                                    'id': id,
                                    'idvehiculo': idvehiculo,
                                    'idtransportista': idtransportista,
                                    'descripcion': descripcionDespacho
                                }).then(function (response) {
                                    me.listarPedido(1,'','num_pedido');
                                    let timerInterval
                                    swal({
                                        title: 'Por favor, espere mientras se procesa la información!',
                                        html: 'Esto terminará en <strong></strong> segundos.',
                                        timer: 4000,//1000 = 1segundo
                                        closeOnConfirm: false, //It does close the popup when I click on close button
                                        closeOnCancel: false,
                                        allowOutsideClick: false,
                                        onOpen: () => {
                                        swal.showLoading()
                                        timerInterval = setInterval(() => {
                                            swal.getContent().querySelector('strong')
                                            .textContent = Math.ceil(swal.getTimerLeft() / 1000)
                                        }, 100)
                                        },
                                        onClose: () => {
                                        clearInterval(timerInterval)
                                        }
                                    }).then((result) => {
                                        swal(
                                        'Entregado!',
                                        'El pedido ha sido entregado con éxito.',
                                        'success'
                                        )
                                        /*if (
                                        // Read more about handling dismissals
                                        result.dismiss === swal.DismissReason.timer
                                        ) {
                                        console.log('I was closed by the timer')
                                        }*/
                                    })
                                }).catch(function (error) {
                                    console.log(error);
                                });

                                //Envio de Correo
                                var urld= '/pedido/sendEmail?id=' + id;
                                
                                axios.get(urld).then(function (response) {
                                    console.log(response);
                                })
                                .catch(function (error) {
                                    console.log(error);
                                });
                                
                                
                            } 
                        }) 
                    }else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel

                ) {
                    
                }
                })
            },
            desactivarPedido(id){
               swal({
                title: 'Esta seguro de anular este pedido?',
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

                    axios.put('/pedido/desactivar',{
                        'id': id
                    }).then(function (response) {
                        me.listarPedido(1,'','num_pedido');
                        swal(
                        'Anulado!',
                        'El pedido ha sido anulado con éxito.',
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
            eliminarPedido(id){
               swal({
                title: 'Esta seguro de eliminar este pedido?',
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

                    axios.put('/pedido/eliminar',{
                        'id': id
                    }).then(function (response) {
                        me.listarPedido(1,'','num_pedido');
                        swal(
                        'Eliminado!',
                        'El pedido ha sido eliminado con éxito.',
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
            consultarRol(){

                let me=this;
                var url= '/pedido/selectVehiculo';

                axios.get(url).then(response => {
                                //console.log(response);
                    var respuesta= response.data;
                    me.arrayVehiculo = respuesta.vehiculo;                    
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            consultarTransportista(){

                let me=this;
                var url= '/pedido/selectTransportista';

                axios.get(url).then(response => {
                                //console.log(response);
                    var respuesta= response.data;
                    me.arrayTransportista = respuesta.transportista;                    
                })
                .catch(function (error) {
                    console.log(error);
                });
            }
            
        },

        mounted() {
            this.listarPedido(1,this.buscar,this.criterio);
            this.consultarRol();
            this.consultarTransportista();
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

    td, th{
        text-align: center;
    }

    .border-danger{
        border: 1px solid red;
    }

    .border-danger:focus {
        border-color: red;
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
