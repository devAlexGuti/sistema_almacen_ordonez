<template>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Reporte de Compras</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active">Reporte de Compras</li>
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
                    </div>-->
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
                                <div class="row col-md-12">
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
                                                        <button type="button" @click="verCompra(compra.id)" class="btn btn-success btn-sm">
                                                        <i class="fa fa-eye"></i>
                                                        </button>
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
                    <!-- Ver compra -->
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
                                                    <td>S/. {{totalImpuesto=((total*impuesto)).toFixed(2)}}</td>
                                                </tr>
                                                <tr style="background-color: #CEECF5;">
                                                    <td colspan="3" style="text-align: right !important"><strong>Total:</strong></td>
                                                    <td>S/. {{total}}</td>
                                                </tr>
                                            </tbody>
                                            <tbody v-else>
                                                <tr>
                                                    <td colspan="4">
                                                        NO hay productos agregados
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
                tipo_comprobante : 'BOLETA',
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
                cantidad:0
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
            cargarPdf(){
                window.open('https://www.oindustrias.com/reporteindicador/reporteIndicador1','_blank');
            },
            cambiarPagina(page,buscar,criterio){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listarCompra(page,buscar,criterio);
            },
            mostrarDetalle(){
                let me=this;
                me.listado=0;

                me.idproveedor=0;
                me.tipo_comprobante='BOLETA';
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
                
                //Obtener los datos del compra
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
            }
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
    .verde{
        background-color: #00a65a;
    }
    .rojo{
        background-color: red;
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
