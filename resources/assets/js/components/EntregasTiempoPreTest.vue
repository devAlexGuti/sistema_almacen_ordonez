<template>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0 text-dark">Datos Indicador Entregas a Tiempo Pre-Test</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active">Datos Indicador Entregas a Tiempo Pre-Test</li>
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
                        <button type="button" @click="abrirModal('producto','registrar')" class="btn btn-primary">
                            <i class="fa fa-plus-circle"></i>&nbsp;Agregar Datos
                        </button>
                        <button type="button" @click="cargarPdf()" class="btn btn-info">
                            <i class="far fa-file-pdf"></i>&nbsp;Reporte
                        </button>
                    </div>
                    <div class="card card-primary">
                        <div class="card-header llamada llamada-info" style="padding: 1rem !important;">
                            <div class="row col-md-12">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select class="form-control" v-model="criterio">
                                            <option value="fecha_consulta">Fecha de Consulta</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" v-model="buscar" @keyup.enter="listarProducto(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <button type="submit" @click="listarProducto(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
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
                                                    <th class="center">OPCIONES</th>
                                                    <th class="center">ITEM</th>
                                                    <th class="center">FECHA DE CONSULTA</th>
                                                    <th class="center">PEDIDOS  ENTREGADOS A TIEMPO</th>
                                                    <th class="center">TOTAL PEDIDOS ENTREGADOS</th>
                                                    <th class="center">ENTREGAS A TIEMPO</th>
                                                </tr>
                                            </thead>
                                        <tbody>
                                            <tr v-for="producto in arrayProductosTest" :key="producto.id">
                                                <td class="center">
                                                    <button type="button" @click="abrirModal('producto','actualizar',producto)" class="btn btn-warning btn-sm btn-xs">
                                                    <i class="fas fa-edit"></i>
                                                    </button> &nbsp;
                                                    <button type="button" class="btn btn-danger btn-sm btn-xs" @click="desactivarProducto(producto.id)">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                                <td class="center" v-text="producto.item"></td>
                                                <td class="center" v-text="producto.fecha_consulta"></td>
                                                <td class="center" v-text="producto.ped_et"></td>
                                                <td class="center" v-text="producto.tot_pe"></td>
                                                <td class="center">{{producto.entrega_tiempo_pretest}} %</td>
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
                </div>
            </div>
        </div>
        <!-- Fin ejemplo de tabla Listado -->
    </section>
    <!--Inicio del modal agregar/actualizar-->
    <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal, 'show' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none; overflow-y: scroll;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!--=====================================
                CABEZA DEL MODAL
                ======================================-->
                <div class="modal-header" style="background:#117a8b; color:white">
                    <h4 class="modal-title" v-text="tituloModal"></h4>
                    <button type="button" class="close" data-dismiss="modal" @click="cerrarModal()">&times;</button>
                </div>
                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <div class="card-body">
                            <div class="input-group input-group-lg mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-sort-numeric-up"></i>
                                    </span>
                                </div>
                                <input type="number" v-model="item" class="form-control input-lg" placeholder="Ingrese Número de Item">                                        
                                <span class="input-group-text" style="color:red;" v-show="item==''">(*Ingrese)</span> 
                            </div>
                            <div class="input-group input-group-lg mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-times"></i>
                                    </span> 
                                </div>
                                <input type="date" title="Fecha de Consulta" v-model="fecha_consulta" class="form-control input-lg" placeholder="Ingrese Fecha de Consulta">                                        
                                <span class="input-group-text" style="color:red;" v-show="fecha_consulta==''">(*Ingrese)</span>
                            </div>

                            <div class="input-group input-group-lg mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-calculator"></i>
                                    </span>  
                                </div>
                                <input type="number" v-model="ped_et" class="form-control input-lg" placeholder="Ingrese cantidad de pedidos entregados a tiempo">                                        
                                <span class="input-group-text" style="color:red;" v-show="ped_et==''">(*Ingrese)</span>
                            </div>
                            <div class="input-group input-group-lg mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-calculator"></i>
                                    </span>
                                </div>
                                <input type="number" v-model="tot_pe" class="form-control input-lg" placeholder="Ingrese total pedidos entregados">                                        
                                <span class="input-group-text" style="color:red;" v-show="tot_pe==''">(*Ingrese)</span>
                            </div>
                            <div class="input-group input-group-lg mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-calculator"></i>
                                    </span>
                                </div>
                                <span  type="hidden" class="form-control input-lg" for="text-input">{{entregas_tiempo_pretest=((ped_et/tot_pe)*100).toFixed(2)}} %</span>                                       
                            </div>
            
                            <div v-show="errorProducto" class="row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjProducto" :key="error" v-text="error">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" @click="cerrarModal()"><i class="fas fa-times"></i>&nbsp;Salir</button>
                    <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarProducto()"><i class="fa fa-save"></i>&nbsp;Guardar Datos</button>
                    <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarProducto()"><i class="fa fa-save"></i>&nbsp;Actualizar Datos</button>
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
    import VueBarcode from 'vue-barcode';
    export default {
        data (){
            return {
                item : '',
                fecha_consulta:'',
                ped_et : '',
                tot_pe:'',
                sdPeriodo:'',
                stockMedio:'',
                entregas_tiempo_pretest:0.0,
                arrayProductosTest: [],
                indicador1_id: 0,
                arrayCategoria :[],
                arrayProducto : [],

                arrayProductoStock:[],
                producto_id: 0,
                codigo : '',
                precio_venta : 0,
                stock : 0,
                descripcion : '',
                
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorProducto : 0,
                errorMostrarMsjProducto : [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'fecha_consulta',
                buscar : ''
                
            }
        },
        components: {
        'barcode': VueBarcode,
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

            }
        },
        methods : {
            listarProducto (page,buscar,criterio){
                let me=this;
                var url= '/entregas_tiempo_pretest?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayProductosTest = respuesta.entregas_tiempo_pretest.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            cargarPdf(){
                window.open('https://www.oindustrias.com/entregas_tiempo_pretest/reporteindicador2','_blank');
            },

            cambiarPagina(page,buscar,criterio){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listarProducto(page,buscar,criterio);
            },
            registrarProducto(){
                if (this.validarProducto()){
                    return;
                }
                let me = this;

                axios.post('/entregas_tiempo_pretest/registrar',{
                    'item': this.item,
                    'fecha_consulta': this.fecha_consulta,
                    'ped_et': this.ped_et,
                    'tot_pe': this.tot_pe,
                    'entregas_tiempo_pretest': this.entregas_tiempo_pretest,
                    'id': this.indicador1_id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarProducto(1,'','id');
                    swal({
                            type: 'success',
                            title: 'Registrado!',
                            text: 'Los Datos han sido Registrado Correctamente!',
                    })
                }).catch(function (error) {
                    console.log(error);
                    swal({
                            type: 'error',
                            title: 'Error!',
                            text: 'Este Item ya se encuentra Registrado!',
                    })
                });
            },
            actualizarProducto(){
               if (this.validarProducto()){
                    return;
                }
                
                let me = this;

                axios.put('/entregas_tiempo_pretest/actualizar',{
                    'item': this.item,
                    'fecha_consulta': this.fecha_consulta,
                    'ped_et': this.ped_et,
                    'tot_pe': this.tot_pe,
                    'entregas_tiempo_pretest': this.entregas_tiempo_pretest,
                    'id': this.indicador1_id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarProducto(1,'','id');
                    swal({
                            type: 'success',
                            title: 'Actualizado!',
                            text: 'Los Datos han sido Registrado Correctamente!',
                    })
                }).catch(function (error) {
                    console.log(error);
                }); 
            },
            desactivarProducto(id){
               swal({
                title: 'Esta seguro de eliminar este registro?',
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

                    axios.put('/entregas_tiempo_pretest/eliminar',{
                        'id': id
                    }).then(function (response) {
                        me.listarProducto(1,'','nombre');
                        swal(
                        'Eliminado!',
                        'El registro fue eliminado con éxito.',
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
            activarProducto(id){
               swal({
                title: 'Esta seguro de activar este producto?',
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

                    axios.put('/producto/activar',{
                        'id': id
                    }).then(function (response) {
                        me.listarProducto(1,'','nombre');
                        swal(
                        'Activado!',
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
            validarProducto(){
                this.errorProducto=0;
                this.errorMostrarMsjProducto =[];

                if (this.item.length==0) this.errorMostrarMsjProducto.push("El Item debe ser un número y no puede estar vacío.");
                if (!this.fecha_consulta) this.errorMostrarMsjProducto.push("La Fecha consulta no puede estar vacío.");
                if (this.ped_et.length==0) this.errorMostrarMsjProducto.push("Salida durante el periodo debe ser un número y no puede estar vacío.");
                if (this.tot_pe.length==0) this.errorMostrarMsjProducto.push("El Stock medio debe ser un número y no puede estar vacío.");
                
                if (this.errorMostrarMsjProducto.length) this.errorProducto = 1;

                return this.errorProducto;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.nombre_categoria = '';
                this.item = '';
                this.fecha_consulta = '';
                this.ped_et = '';
                this.tot_pe = '';
		        this.errorProducto=0;
            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "producto":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'AGREGAR DATOS DEL INDICADOR 2 PRE - TEST';
                                this.nombre_categoria='';
                                this.item = '';
                                this.fecha_consulta ='';
                                this.ped_et = '';
                                this.tot_pe = '';
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                //console.log(data);
                                this.modal=1;
                                this.tituloModal='ACTUALIZAR DATOS DEL INDICADOR 1 PRE - TEST';
                                this.tipoAccion=2;
                                this.indicador1_id=data['id'];
                                this.item=data['item'];
                                this.fecha_consulta = data['fecha_consulta'];
                                this.ped_et=data['ped_et'];
                                this.tot_pe=data['tot_pe'];
                                this.entregas_tiempo_pretest= data['entrega_tiempo_pretest'];
                                break;
                            }
                        }
                    }
                }
            }
        },
        mounted() {
            this.listarProducto(1,this.buscar,this.criterio);
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
    .stock-bajo {
	color: red !important;
    font-weight: bold;
    }
    .center{
        text-align: center;
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
