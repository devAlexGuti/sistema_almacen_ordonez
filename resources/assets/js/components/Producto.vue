<template>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0 text-dark">Administrar Productos</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item active">Administrar Productos</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <!-- Ejemplo de tabla Listado -->
            <div class="row">
                <div class="col-12">
                    <div class="callout callout-info">
                        <button type="button" @click="abrirModal('producto','registrar')" class="btn btn-primary">
                            <i class="fa fa-plus-circle"></i>&nbsp;Agregar Producto
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
                                            <option value="nombre">Nombre</option>
                                            <option value="descripcion">Descripción</option>
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
                                                <th>Opciones</th>
                                                <th>Código</th>
                                                <th>Categoría</th>
                                                <th>Nombre</th>
                                                <th>Unidad Medida</th>
                                                <th>Fecha Vencimiento</th>
                                                <th>Precio Venta</th>
                                                <th>Stock</th>
                                                <th>Descripción</th>
                                                <th>Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="producto in arrayProducto" :key="producto.id" v-bind:style="producto.stock<50">
                                                <td>
                                                    <button type="button" @click="abrirModal('producto','actualizar',producto)" class="btn btn-warning btn-sm btn-xs">
                                                    <i class="fas fa-edit"></i>
                                                    </button> &nbsp;
                                                    <template v-if="producto.condicion">
                                                        <button type="button" class="btn btn-danger btn-sm btn-xs" @click="desactivarProducto(producto.id)">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </template>
                                                    <template v-else>
                                                        <button type="button" class="btn btn-info btn-sm btn-xs" @click="activarProducto(producto.id)">
                                                            <i class="fa fa-check"></i>
                                                        </button>
                                                    </template>
                                                </td>
                                                <td v-text="producto.codigo"></td>
                                                <td v-text="producto.nombre_categoria"></td>
                                                <td v-text="producto.nombre"></td>
                                                <td v-text="producto.nombre_unidad_medida"></td>
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
                                                <td v-text="producto.descripcion"></td>
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
            <!-- Fin ejemplo de tabla Listado -->
        </div>
    </section>
    <!--Inicio del modal agregar/actualizar-->
    <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal, 'show' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none; overflow-y: auto;" aria-hidden="true">
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
                                <!-- ENTRADA PARA EL NOMBRE DE LA CATEGORIA -->
                                <div class="input-group input-group-lg mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-th"></i>
                                        </span>
                                    </div>
                                    <select class="form-control" :class="{'border-danger' : idcategoria==0}" v-model="idcategoria" ref="idcategoria">
                                        <option value="0" disabled>Seleccionar Categoría</option>
                                        <option v-for="categoria in arrayCategoria" :key="categoria.id" :value="categoria.id" v-text="categoria.nombre"></option>
                                    </select>
                                    <span class="input-group-text" style="color:red;" v-show="idcategoria==0">(*Seleccione)</span>
                                </div>

                                <!-- ENTRADA PARA UNIDAD DE MEDIDA -->
                                <div class="input-group input-group-lg mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-th"></i>
                                        </span>
                                    </div>
                                    <select class="form-control" :class="{'border-danger' : idunidad_medida==0}" v-model="idunidad_medida" ref="idunidad_medida">
                                        <option value="0" disabled>Seleccionar Unidad Medida</option>
                                        <option v-for="unidad_medida in arrayUnidad_medida" :key="unidad_medida.id" :value="unidad_medida.id" v-text="unidad_medida.nombre"></option>
                                    </select>
                                    <span class="input-group-text" style="color:red;" v-show="idunidad_medida==0">(*Seleccione)</span>
                                </div>
                                <!-- ENTRADA PARA EL CODIGO -->
                                <div class="input-group input-group-lg mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-barcode"></i>
                                        </span>
                                    </div>
                                    <input @input="validacionReact($event, 'codigo');" type="text" ref="codigo" v-model="codigo" class="form-control input-lg" :class="{'border-danger' : codigo=='' || existeCodigo}" placeholder="Ingrese un Código del Producto" maxlength="50">
                                    <template v-if="codigo == ''">
                                        <span class="input-group-text" style="color:red;">(*Ingrese)</span>
                                    </template>
                                    <template v-else-if="arrayExisteCodigo.length">
                                        <span class="input-group-text" style="color:red;" v-for="errorCod in arrayExisteCodigo" :key="errorCod" v-text="errorCod">(*Ingrese)</span>
                                    </template>
                                </div>

                                <!-- ENTRADA PARA EL NOMBRE DE PRODUCTO -->
                                <div class="input-group input-group-lg mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fab fa-product-hunt"></i>
                                        </span>
                                    </div>
                                    <input @input="validacionReact($event, 'nombre');" type="text" ref="nombre" v-model="nombre" class="form-control input-lg" :class="{'border-danger' : nombre=='' || existeNombre}"  placeholder="Ingrese nombre del producto" maxlength="100">
                                    <template v-if="nombre == ''">
                                        <span class="input-group-text" style="color:red;">(*Ingrese)</span>
                                    </template>
                                    <template v-else-if="arrayExisteNombre.length">
                                        <span class="input-group-text" style="color:red;" v-for="errorNom in arrayExisteNombre" :key="errorNom" v-text="errorNom">(*Ingrese)</span>
                                    </template>
                                </div>
                                
                                <!--ENTRADA PARA LA DESCRIPCION DEL PRODUCTO-->
                                <div class="input-group input-group-lg mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-info-circle"></i>
                                        </span>
                                    </div>
                                    <input type="text" v-model="descripcion" class="form-control input-lg"  placeholder="Ingrese descripción del producto" maxlength="250">
                                </div>
                                <!-- ENTRADA PARA LA FECHA DE VENCIMIENTO -->
                                <div title="Fecha de vencimiento del producto" class="input-group input-group-lg mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-times"></i>
                                        </span>
                                    </div>
                                    <input type="date" ref="fecha_vencimiento" v-model="fecha_vencimiento" class="form-control input-lg" placeholder="">
                                    <!--<span class="input-group-text" style="color:red;" v-show="fecha_vencimiento==''">(*Ingrese F. Venc.)</span>-->
                                </div>

                                <div class="input-group input-group-lg mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-money-bill-alt"></i>
                                        </span>
                                    </div>
                                    <input @keypress="validateInput($event,'decimal')" onpaste="return false" ref="precio_venta" type="text" step="0.1" maxlength="11" v-model="precio_venta" class="form-control input-lg" :class="{'border-danger' : precio_venta==0}" placeholder="Ingrese precio venta">
                                    <span class="input-group-text" style="color:red;" v-show="precio_venta==0">(*Ingrese)</span>
                                </div>
                                <div class="input-group input-group-lg mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-sort-amount-up-alt"></i>
                                        </span>
                                    </div>
                                    <input @keypress="validateInput($event, 'nodecimal')" onpaste="return false" type="text" maxlength="10" ref="stock" v-model="stock" class="form-control input-lg" :class="{'border-danger' : stock==''}" placeholder="Ingrese stock del producto">
                                    <span class="input-group-text" style="color:red;" v-show="stock==''">(*Ingrese)</span>
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

                <!--=====================================
                PIE DEL MODAL
                ======================================-->

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" @click="cerrarModal()"><i class="fas fa-times"></i>&nbsp;Salir</button>
                    <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarProducto()"><i class="fas fa-save"></i>&nbsp;Guardar Producto</button>
                    <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarProducto()"><i class="fas fa-save"></i>&nbsp;Actualizar Producto</button>
                </div>

            </div>

        </div>
    </div>


    <!--Fin del modal-->
</div>
</template>

<script>
    import VueBarcode from 'vue-barcode';
    export default {
        data (){
            return {
                arrayProductoStock:[],
                producto_id: 0,
                idcategoria : 0,
                idunidad_medida: 0,
                nombre_categoria : '',
                codigo : '',
                nombre : '',
                fecha_vencimiento: '',
                precio_venta : '',
                stock : '',
                descripcion : '',
                arrayProducto : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorProducto : 0,
                errorMostrarMsjProducto : [],
                errorMostrarMsjReact: [],
                errorConsulta: 0,
                existeCodigo: 0,
                arrayExisteCodigo: [],
                existeNombre: 0,
                arrayExisteNombre: [],
                arrayRespuestaReact : [],
                arrayUnidad_medida: [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'nombre',
                buscar : '',
                arrayCategoria :[]
            }
        },
        components: {
        'barcode': VueBarcode
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
            validacionReact(event, x){
                let newEvent = event.target.value;
                //console.log(x+": "+newEvent);
                let me=this;

                if(x== ''){
                me.errorMostrarMsjReact.push("Ingrese"); 
                }else{
                    me.errorConsulta = 0;

                    axios.post('/producto/validacionReact',{
                        'value': newEvent,
                        'variable': x,
                    }).then(function (response) {
                        var respuesta= response.data;
                        me.arrayRespuestaReact = respuesta.consulta;

                        if(x == 'codigo'){
                            me.existeCodigo = 0;
                            me.arrayExisteCodigo = [];
                        }else if (x == 'nombre'){
                            me.existeNombre = 0;
                            me.arrayExisteNombre = [];
                        }

                        if(respuesta.consulta.length >= 1){
                            me.errorConsulta = 1;
                            if(respuesta.variable == 'codigo'){
                                me.existeCodigo = 1;
                                //me.errorMostrarMsjReact.push({codigo: '(*Ya existe)'});
                                me.arrayExisteCodigo.push("(*Ya Existe)");
                            }else if (respuesta.variable == 'nombre'){
                                me.existeNombre = 1;
                                //me.errorMostrarMsjReact.push({nombre: '(*Ya existe)'});
                                me.arrayExisteNombre.push("(*Ya Existe)");
                            }
                        }else{
                            console.log("no hay coincidencia");
                        }
                        
                    }).catch(function (error) {
                        console.log(error);
                    });

                    console.log("salida: " + me.errorConsulta);
                }
            },
            validateInput(event, vari) {//SOLO NUMEROS, Y PUNTO
                const key = event.keyCode;
                if(vari == 'decimal'){
                    if((key >= 48 && key <= 57) || key === 46) {
                        return true
                    } else {
                        event.preventDefault();
                    }
                }else if (vari == 'nodecimal'){
                    if((key >= 48 && key <= 57)) {
                        return true
                    } else {
                        event.preventDefault();
                    }
                }
            },
            listarProducto (page,buscar,criterio){
                let me=this;
                var url= '/producto?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayProducto = respuesta.productos.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            cargarPdf(){
                window.open('https://www.oindustrias.com/producto/listarPdf','_blank');
            },
            selectCategoria(){
                let me=this;
                var url= '/categoria/selectCategoria';
                axios.get(url).then(function (response) {
                    //console.log(response);
                    var respuesta= response.data;
                    me.arrayCategoria = respuesta.categorias;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectUnidad_medida(){
                let me=this;
                var url= '/producto/selectUnidad_medida';
                axios.get(url).then(function (response) {
                    //console.log(response);
                    var respuesta= response.data;
                    me.arrayUnidad_medida = respuesta.unidad_medida;
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
                me.listarProducto(page,buscar,criterio);
            },
            registrarProducto(){
                if (this.validarProducto()){
                    return;
                }
                
                let me = this;

                axios.post('/producto/registrar',{
                    'idcategoria': this.idcategoria,
                    'idunidad_medida': this.idunidad_medida,
                    'codigo': this.codigo,
                    'nombre': this.nombre,
                    'fecha_vencimiento': this.fecha_vencimiento,
                    'stock': this.stock,
                    'precio_venta': this.precio_venta,
                    'descripcion': this.descripcion
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarProducto(1,'','nombre');
                    swal({
                            type: 'success',
                            title: 'Registrado!',
                            text: 'El Producto ha sido Registrado Correctamente!',
                    })
                }).catch(function (error) {
                    console.log(error);
                    swal({
                            type: 'error',
                            title: 'Error!',
                            text: 'El Nombre o Codigo del Producto ya se encuentra Registrado!',
                    })
                });
            },
            actualizarProducto(){
               if (this.validarProducto()){
                    return;
                }
                
                let me = this;

                axios.put('/producto/actualizar',{
                    'idcategoria': this.idcategoria,
                    'idunidad_medida': this.idunidad_medida,
                    'codigo': this.codigo,
                    'nombre': this.nombre,
                    'fecha_vencimiento': this.fecha_vencimiento,
                    'stock': this.stock,
                    'precio_venta': this.precio_venta,
                    'descripcion': this.descripcion,
                    'id': this.producto_id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarProducto(1,'','nombre');
                    swal({
                            type: 'success',
                            title: 'Actualizado!',
                            text: 'Los Datos del Producto ha sido Actualizado Correctamente!',
                    })
                }).catch(function (error) {
                    console.log(error);
                    swal({
                            type: 'error',
                            title: 'Error!',
                            text: 'El Nombre o Codigo del Producto ya se encuentra Registrado!',
                    })
                }); 
            },
            desactivarProducto(id){
               swal({
                title: 'Esta seguro de desactivar este producto?',
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

                    axios.put('/producto/desactivar',{
                        'id': id
                    }).then(function (response) {
                        me.listarProducto(1,'','nombre');
                        swal(
                        'Desactivado!',
                        'El registro ha sido desactivado con éxito.',
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
                buttonsStyling: false,
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
                
                if (this.idcategoria==0) this.errorMostrarMsjProducto.push("Seleccione una categoría."); 
                this.$refs.idcategoria.focus();
                if (this.idunidad_medida==0) this.errorMostrarMsjProducto.push("Seleccione unidad medida."); 
                this.$refs.idunidad_medida.focus();
                if (!this.codigo) this.errorMostrarMsjProducto.push("El código del producto no puede estar vacío.");
                this.$refs.codigo.focus();
                if (!this.nombre) this.errorMostrarMsjProducto.push("El nombre del producto no puede estar vacío.");
                this.$refs.nombre.focus();
                /*if (!this.fecha_vencimiento) this.errorMostrarMsjProducto.push("La fecha de vencimiento del producto no puede estar vacío.");
                this.$refs.fecha_vencimiento.focus();*/
                if (!this.precio_venta || this.precio_venta==0) this.errorMostrarMsjProducto.push("El precio venta del producto debe ser un número superior a 0 y no puede estar vacío.");
                this.$refs.precio_venta.focus();
                if (this.stock<0) this.errorMostrarMsjProducto.push("El stock del producto debe ser un número positivo mayor o igual a 0.");
                this.$refs.stock.focus();
                if (this.precio_venta<0) this.errorMostrarMsjProducto.push("El precio venta del producto debe ser un número positivo mayor a 0.");
                this.$refs.precio_venta.focus();
                if (this.stock.length==0) this.errorMostrarMsjProducto.push("El stock del producto debe ser un número y no puede estar vacío.");
                this.$refs.stock.focus();
                if(this.existeCodigo){
                    this.errorMostrarMsjProducto.push("El código del producto ya existe");
                    this.$refs.codigo.focus();
                }
                if(this.existeNombre){
                    this.errorMostrarMsjProducto.push("El nombre del producto ya existe");
                    this.$refs.nombre.focus();
                }
                if (this.errorMostrarMsjProducto.length) this.errorProducto = 1;

                return this.errorProducto;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.idcategoria= 0;
                this.idunidad_medida= 0;
                this.nombre_categoria = '';
                this.codigo = '';
                this.nombre = '';
                this.precio_venta = 0;
                this.stock = 0;
                this.descripcion = '';
                this.errorProducto=0;
                this.fecha_vencimiento= '';
            },
            selectProductoStock(){
                let me=this;
                estadoA=false;
                var url= '/producto/selectProductoStock';
                axios.get(url).then(function (response) {
                    //console.log(response);
                    var respuesta= response.data;
                    me.arrayProductoStock = respuesta.productos;
                    this.producto_id=arrayProductoStock['id'];
                    this.nombre = arrayProductoStock['nombre'];
                    this.stock=arrayProductoStock['stock'];

                    if(this.stock>=50){
                        estadoA=true;
                    }

                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "producto":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Agregar Producto';
                                this.idcategoria=0;
                                this.idunidad_medida=0;
                                this.nombre_categoria='';
                                this.codigo='';
                                this.nombre= '';
                                this.precio_venta='';
                                this.stock='';
                                this.descripcion = '';
                                this.tipoAccion = 1;
                                //Establecer el foco de la entrada al campo nombre
                                this.$nextTick(() => {
                                    this.$refs.idcategoria.focus();
                                })
                                break;
                            }
                            case 'actualizar':
                            {
                                //console.log(data);
                                this.modal=1;
                                this.tituloModal='Actualizar Producto';
                                this.tipoAccion=2;
                                this.producto_id=data['id'];
                                this.idcategoria=data['idcategoria'];
                                this.idunidad_medida=data['idunidad_medida'];
                                this.codigo=data['codigo'];
                                this.nombre = data['nombre'];
                                this.fecha_vencimiento = data['fecha_vencimiento'];
                                this.stock=data['stock'];
                                this.precio_venta=data['precio_venta'];
                                this.descripcion= data['descripcion'];
                                break;
                            }
                        }
                    }
                }
                this.selectCategoria();
                this.selectUnidad_medida();
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
    @media all and (max-width: 600px){
    .modal-content{
        overflow-y: scroll;
    }
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
    font-size: 18px;
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

    .llamada{
    border-radius: .25rem;
    background-color: #fff;
    border-left: 5px solid #e9ecef;
    }

    .llamada.llamada-info{
        border-left-color: #117a8b;
    }
</style>
