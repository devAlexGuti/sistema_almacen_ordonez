<template>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Administrar Compras</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active">Administrar Compras</li>
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
                            <i class="fa fa-plus-circle"></i>&nbsp;Agregar Compra
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
                                            <input type="text" v-model="buscar" @keyup.enter="listarCompra(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <button type="submit" @click="listarCompra(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row col-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Opciones</th>
                                                    <th>Usuario</th>
                                                    <th>Proveedor</th>
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
                                                <tr v-for="compra in arrayCompra" :key="compra.id">
                                                    <td>
                                                        <button type="button" @click="verCompra(compra.id)" class="btn btn-success btn-xs">
                                                            <i class="fa fa-eye"></i>
                                                        </button> &nbsp;
                                                        <template v-if="compra.estado=='Registrado'">
                                                            <button type="button" class="btn btn-danger btn-xs" @click="desactivarCompra(compra.id)">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </template>
                                                    </td>
                                                    <td v-text="compra.usuario"></td>
                                                    <td v-text="compra.nombre"></td>
                                                    <td v-text="compra.tipo_comprobante"></td>
                                                    <td v-text="compra.serie_comprobante"></td>
                                                    <td v-text="compra.num_comprobante"></td>
                                                    <td v-text="compra.fecha_hora"></td>
                                                    <td v-text="compra.total"></td>
                                                    <td v-text="compra.impuesto"></td>
                                                    <td>
                                                        <div v-if="compra.estado=='Registrado'">
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
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="">Proveedor <span style="color:red;" v-show="idproveedor==0">(*Ingrese)</span></label>
                                            <v-select
                                                :on-search="selectProveedor"
                                                label="nombre"
                                                :options="arrayProveedor"
                                                placeholder="Buscar Proveedores..."
                                                :onChange="getDatosProveedor"
                                                :class="{'border-danger': idproveedor==0}"                                         
                                            >

                                            </v-select>
                                        </div>
                                    </div>
                                    <div class="col-md-3" v-if="tipo_comprobante=='FACTURA'">
                                        <div class="form-group">
                                            <label for="">Impuesto(*)</label>
                                            <input type="text" class="form-control" readonly v-model="impuesto">
                                        </div>
                                    </div>
                                    <div class="col-md-3" v-else-if="tipo_comprobante=='BOLETA'">
                                        <label for="">Impuesto(*)</label>
                                        <input type="text" step="any" class="form-control" readonly v-model="impuesto">
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tipo Comprobante(*)</label>
                                            <select class="form-control" v-model="tipo_comprobante" @change="ddlselect">
                                                <option disabled="disabled" value="0">Seleccione</option>
                                                <option value="BOLETA">Boleta</option>
                                                <option value="FACTURA">Factura</option>
                                                <option value="TICKET">Ticket</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Serie Comprobante <span style="color:red;" v-show="serie_comprobante == ''">(*Ingrese)</span></label>
                                            <input type="text" class="form-control" :class="{'border-danger': serie_comprobante==''}" v-model="serie_comprobante" placeholder="000x">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Número Comprobante <span style="color:red;" v-show="num_comprobante == ''">(*Ingrese)</span></label>
                                            <input type="text" class="form-control" :class="{'border-danger': num_comprobante == ''}" v-model="num_comprobante" placeholder="000xx">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div v-show="errorCompra" class="form-group row div-error">
                                            <div class="text-center text-error">
                                                <div v-for="error in errorMostrarMsjCompra" :key="error" v-text="error">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Producto <span style="color:red;" v-show="idproducto==0">(*Ingrese código o Seleccione)</span></label>
                                            <div class="form-inline">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" :class="{'border-danger' : codigo == 0 && idproducto ==0}" v-model="codigo" @keyup.enter="buscarProducto()" placeholder="Ingrese código">
                                                </div>
                                                <div class="form-group mx-sm-3">
                                                    <button @click="abrirModal()" class="btn btn-primary"><i class="fa fa-search-plus"> Buscar</i></button>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" readonly class="form-control" v-model="producto" :class="{'border-danger' : idproducto == 0}">
                                                </div>
                                            </div>                                    
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Precio <span style="color:red;" v-show="idproducto>0 && precio<=0">(*Ingrese)</span></label>
                                            <input type="number" value="0" step="0.1" min="0.1" class="form-control" :class="{'border-danger' : idproducto>0 && precio <=0}" v-model="precio">
                                            <span style="color:red;" v-show="idproducto>0 && precio<=0">El valor debe ser superior a 0</span>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Cantidad <span style="color:red;" v-show="idproducto>0 && cantidad<=0">(*Ingrese)</span></label>
                                            <input type="number" value="0" min="1" class="form-control" v-model="cantidad" :class="{'border-danger' : idproducto>0 && cantidad <=0}">
                                            <span style="color:red;" v-show="idproducto>0 && cantidad<=0">El valor debe ser igual o superior a 1</span>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <button @click="agregarDetalle()" class="btn btn-success form-control btnagregar"><i class="fa fa-plus-square"> Agregar</i></button>
                                        </div>
                                    </div>
                                    <div class="table-responsive col-md-12">
                                        <table class="table table-bordered table-striped table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Opciones</th>
                                                    <th>Producto</th>
                                                    <th>Precio Unitario</th>
                                                    <th>Cantidad</th>
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
                                                        <input v-model="detalle.precio" type="number" step="0.1" min="0.1" value="3" class="form-control" :class="{'border-danger' : detalle.precio <=0 }">
                                                        <span style="color:red;" v-show="detalle.precio<=0">El valor debe ser superior a 0</span>
                                                    </td>
                                                    <td>
                                                        <input v-model="detalle.cantidad" type="number" value="2" min="1" class="form-control" :class="{'border-danger' : detalle.cantidad <=0 }">
                                                        <span style="color:red;" v-show="detalle.cantidad<=0">El valor debe ser igual o superior a 1</span>
                                                    </td>
                                                    <td>
                                                        {{detalle.precio*detalle.cantidad}}
                                                    </td>
                                                </tr>
                                                <tr style="background-color: #CEECF5;">
                                                    <td colspan="4" style="text-align: right !important"><strong>Sub Total:</strong></td>
                                                    <td>S/. {{totalParcial=(total-totalImpuesto).toFixed(2)}}</td>
                                                </tr>
                                                <tr style="background-color: #CEECF5;">
                                                    <td colspan="4" style="text-align: right !important"><strong>IGV 18%:</strong></td>
                                                    <td>S/. {{totalImpuesto=((total*impuesto)/(1+impuesto)).toFixed(2)}}</td>
                                                </tr>
                                                <tr style="background-color: #CEECF5;">
                                                    <td colspan="4" style="text-align: right !important"><strong>Total:</strong></td>
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

                            <div class="card-footer">
                                <div class="d-flex justify-content-between">
                                    <button type="button" @click="ocultarDetalle()" class="btn btn-secondary"><i class="fa fa-arrow-circle-left"></i>&nbsp;Salir</button>
                                    <button type="button" class="btn btn-primary" @click="registrarCompra()"><i class="fa fa-save"></i>&nbsp;Registrar Compra</button>
                                </div>
                            </div>
                        </div>
                    </template>
                    <!-- Fin Detalle-->
                    <!-- Ver compra-->
                    <template v-else-if="listado==2">
                        <div class="card card-primary">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="">Proveedor</label>
                                            <p v-text="proveedor"></p>
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
                                                    <th>Subtotal</th>
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
                                                    <td>
                                                        {{detalle.precio*detalle.cantidad}}
                                                    </td>
                                                </tr>
                                                <tr style="background-color: #CEECF5;">
                                                    <td colspan="3" style="text-align: right !important"><strong>Sub Total:</strong></td>
                                                    <td>S/. {{totalParcial=(total-totalImpuesto).toFixed(2)}}</td>
                                                </tr>
                                                <tr style="background-color: #CEECF5;">
                                                    <td colspan="3" style="text-align: right !important"><strong>IGV 18%:</strong></td>
                                                    <td>S/. {{totalImpuesto=(total - (total/1.18)).toFixed(2)}}</td>
                                                </tr>
                                                <tr style="background-color: #CEECF5;">
                                                    <td colspan="3" style="text-align: right !important"><strong>Total:</strong></td>
                                                    <td>S/. {{total}}</td>
                                                </tr>
                                            </tbody>
                                            <tbody v-else>
                                                <tr>
                                                    <td colspan="4" style="color:red;">
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
    <!--Inicio del modal agregar productos a la tabla-->
    <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal, 'show' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none; overflow-y: scroll;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!--CABEZA DEL MODAL-->
                <div class="modal-header" style="background:#117a8b; color:white">
                    <h4 class="modal-title" v-text="tituloModal"></h4>
                    <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
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
    export default {
        data (){
            return {
                compra_id: 0,
                idproveedor:0,
                proveedor:'',
                nombre : '',
                fecha_vencimiento : '',
                tipo_comprobante : 'FACTURA',
                serie_comprobante : '',
                num_comprobante : '',
                impuesto: 0.18,
                total:0.0,
                totalImpuesto: 0.0,
                totalParcial: 0.0,
                arrayCompra : [],
                arrayProveedor: [],
                arrayDetalle : [],
                listado:1,
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorCompra : 0,
                errorMostrarMsjCompra : [],
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
                checkimpuesto: false
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
            ddlselect(){
                if(this.tipo_comprobante=="FACTURA"){
                    this.impuesto=0.18;
                }
                if(this.tipo_comprobante=="BOLETA"){
                    this.impuesto=0;
                }
            },
            listarCompra (page,buscar,criterio){
                let me=this;
                var url= '/compra?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayCompra = respuesta.compras.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectProveedor(search,loading){
                let me=this;
                loading(true)

                var url= '/proveedor/selectProveedor?filtro='+search;
                axios.get(url).then(function (response) {
                    let respuesta = response.data;
                    q: search
                    me.arrayProveedor=respuesta.proveedores;
                    loading(false)
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            getDatosProveedor(val1){
                let me = this;
                me.loading = true;
                if(val1==null){
                    me.idproveedor = 0;
                }else{
                    me.idproveedor = val1.id;
                }
            },
            buscarProducto(){
                let me=this;
                var url= '/producto/buscarProducto?filtro=' + me.codigo;

                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayProducto = respuesta.productos;

                    if (me.arrayProducto.length>0){
                        me.producto=me.arrayProducto[0]['nombre'];
                        me.idproducto=me.arrayProducto[0]['id'];
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

            cambiarPagina(page,buscar,criterio){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listarCompra(page,buscar,criterio);
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
                            precio: me.precio
                        });
                        me.codigo="";
                        me.idproducto=0;
                        me.producto="";
                        me.cantidad=0;
                        me.precio=0; 
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
                            precio: 1
                        }); 
                    }
            },
            listarProducto (buscar,criterio){
                let me=this;
                var url= '/producto/listarProducto?buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayProducto = respuesta.productos.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            registrarCompra(){
                if (this.validarCompra()){
                    return;
                }
                
                let me = this;

                axios.post('/compra/registrar',{
                    'idproveedor': this.idproveedor,
                    'tipo_comprobante': this.tipo_comprobante,
                    'serie_comprobante' : this.serie_comprobante,
                    'num_comprobante' : this.num_comprobante,
                    'impuesto' : this.impuesto,
                    'total' : this.total,
                    'data': this.arrayDetalle

                }).then(function (response) {
                    me.listado=1;
                    me.listarCompra(1,'','num_comprobante');
                    me.idproveedor=0;
                    me.tipo_comprobante='FACTURA';
                    me.serie_comprobante='';
                    me.num_comprobante='';
                    me.impuesto=0.18;
                    me.total=0.0;
                    me.idproducto=0;
                    me.producto='';
                    me.cantidad=0;
                    me.precio=0;
                    me.arrayDetalle=[];
                    swal({
                            type: 'success',
                            title: 'Registrado!',
                            text: 'La compra ha sido Registrado Correctamente!',
                    })
                }).catch(function (error) {
                    console.log(error);
                    swal({
                            type: 'error',
                            title: 'Error!',
                            text: 'El Número de comprobante ya se encuentra Registrado!',
                    })
                });
            },
            validarCompra(){
                this.errorCompra=0;
                this.errorMostrarMsjCompra =[];
                var art;
                let me=this;
                me.arrayDetalle.map(function(x){

                    if (x.cantidad<1){
                        art=x.producto + " cantidad debe ser igual o superior a 1";
                        me.errorMostrarMsjCompra.push(art);
                    }
                    else if (x.precio<=0){
                        art=x.producto + " precio debe ser superior a 0";
                        me.errorMostrarMsjCompra.push(art);
                    }
                });

                if (this.idproveedor==0) this.errorMostrarMsjCompra.push("Seleccione un Proveedor");
                if (this.tipo_comprobante==0) this.errorMostrarMsjCompra.push("Seleccione el comprobante");
                if (!this.num_comprobante) this.errorMostrarMsjCompra.push("Ingrese el número de comprobante");
                if (this.tipo_comprobante=="FACTURA" && !this.impuesto) {
                    this.errorMostrarMsjVenta.push("Ingrese el impuesto de compra");
                }
                if (this.arrayDetalle.length<=0) this.errorMostrarMsjCompra.push("Ingrese detalles");

                if (this.errorMostrarMsjCompra.length) this.errorCompra = 1;

                return this.errorCompra;
            },
            mostrarDetalle(){
                let me=this;
                me.listado=0;

                me.idproveedor=0;
                me.tipo_comprobante='FACTURA';
                me.serie_comprobante='';
                me.num_comprobante='';
                me.impuesto=0.18;
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
            verCompra(id){
                let me=this;
                me.listado=2;
                
                //Obtener los datos dLa compra
                var arrayCompraT=[];
                var url= '/compra/obtenerCabecera?id=' + id;
                
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    arrayCompraT = respuesta.compra;

                    me.proveedor = arrayCompraT[0]['nombre'];
                    me.tipo_comprobante=arrayCompraT[0]['tipo_comprobante'];
                    me.serie_comprobante=arrayCompraT[0]['serie_comprobante'];
                    me.num_comprobante=arrayCompraT[0]['num_comprobante'];
                    me.impuesto=arrayCompraT[0]['impuesto'];
                    me.total=arrayCompraT[0]['total'];
                })
                .catch(function (error) {
                    console.log(error);
                });

                //Obtener los datos de los detalles 
                var urld= '/compra/obtenerDetalles?id=' + id;
                
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
            desactivarCompra(id){
               swal({
                title: 'Esta seguro de anular este compra?',
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

                    axios.put('/compra/desactivar',{
                        'id': id
                    }).then(function (response) {
                        me.listarCompra(1,'','num_comprobante');
                        swal(
                        'Anulado!',
                        'La compra ha sido anulado con éxito.',
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
            this.listarCompra(1,this.buscar,this.criterio);
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
    .llamada{
    border-radius: .25rem;
    background-color: #fff;
    border-left: 5px solid #e9ecef;
    }

    .llamada.llamada-info{
        border-left-color: #117a8b;
    }
</style>
