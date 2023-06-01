<template>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Administrar Categorías</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Administrar Categorías</li>
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
                        <button type="button" @click="abrirModal('categoria','registrar')" class="btn btn-primary">
                            <i class="fa fa-plus-circle"></i>&nbsp;Agregar Categoría
                        </button>
                    </div>
                    <!-- general form elements -->
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
                                        <input type="text" v-model="buscar" @keyup.enter="listarCategoria(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <button type="submit" @click="listarCategoria(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
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
                                                <th>Nombre</th>
                                                <th>Descripción</th>
                                                <th>Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="categoria in arrayCategoria" :key="categoria.id">
                                                <td>
                                                    <button type="button" @click="abrirModal('categoria','actualizar',categoria)" class="btn btn-warning btn-sm btn-xs">
                                                    <i class="fas fa-edit"></i>
                                                    </button> &nbsp;
                                                    <template v-if="categoria.condicion">
                                                        <button type="button" class="btn btn-danger btn-sm btn-xs" @click="desactivarCategoria(categoria.id)">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </template>
                                                    <template v-else>
                                                        <button type="button" class="btn btn-info btn-sm btn-xs" @click="activarCategoria(categoria.id)">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                    </template>
                                                </td>
                                                <td v-text="categoria.nombre"></td>
                                                <td v-text="categoria.descripcion"></td>
                                                <td>
                                                    <div v-if="categoria.condicion">
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
                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </div>

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        <!-- Fin ejemplo de tabla Listado -->
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
                                <!-- el v-model en vue viene ser como un identificador -->
                                <input @input="validacionReact($event, 'nombre')" type="text" maxlength="50" ref="nombre" v-model="nombre" class="form-control" :class="{'border-danger': nombre=='' || errorConsulta}" placeholder="Ingrese nombre de categoría">
                                <template v-if="nombre==''">
                                    <span class="input-group-text" style="color:red;">(*Ingrese)</span>
                                </template>
                                <template v-else-if="arrayExisteNombre.length">
                                    <span class="input-group-text" style="color:red;" v-for="error1 in arrayExisteNombre" :key="error1" v-text="error1">(*Ingrese)</span>
                                </template>
                            </div>

                            <!-- ENTRADA PARA LA DESCRIPCIÓN DE LA CATEGORIA -->

                            <div class="input-group input-group-lg mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-info-circle"></i></span>
                                </div>
                                <input type="text" maxlength="256" v-model="descripcion" class="form-control"  placeholder="Ingrese descripción" required autocomplete="off">
                            </div>

                            <div v-show="errorCategoria" class="row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjCategoria" :key="error" v-text="error">
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
                    <!-- @click es un método en vue, ej js vendria ser el método onclick-->
                    <button type="button" class="btn btn-secondary pull-left" @click="cerrarModal()"><i class="fas fa-times"></i>&nbsp;Salir</button>
                    <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarCategoria()"><i class="fas fa-save"></i>&nbsp;Guardar Categoría</button>
                    <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarCategoria()"><i class="fas fa-save"></i>&nbsp;Actualizar Categoría</button>
                </div>

            </div>

        </div>
    </div>
    <!--Fin del modal-->
</div>

</template>

<script>
    export default {
         /*data es para almacenar las variables, se tiene que declarar la data para que reconozca*/
        data (){
             /*aqui se hace las  declaraciones de las variables*/
            return {
                categoria_id: 0,
                nombre : '',
                descripcion : '',
                arrayCategoria : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorCategoria : 0,
                errorMostrarMsjCategoria : [],
                errorMostrarMsjReact: [],
                arrayExisteNombre: [],
                errorConsulta: 0,
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
                buscar : ''
            }
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
             /*se hizo la conexión la vista con el controlador, que esta en la carpeta controladores*/
           /*listar categoria es un método*/
           listarCategoria (page,buscar,criterio){
                let me=this;
                 /*categoria nos esta devolviendo un arreglo*/
                var url= '/categoria?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                     /*el arreglo se esta recibiendo acá*/
                    me.arrayCategoria = respuesta.categorias.data;
                    me.pagination= respuesta.pagination;
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
                me.listarCategoria(page,buscar,criterio);
            },
            /* validación ya existe*/
            validacionReact(event, x){
                let newEvent = event.target.value;
                let me=this;
                
                if(x == 'nombre'){
                    axios.post('/categoria/validacionReact',{
                        'nombre': newEvent,
                        'variable': x
                    }).then(function (response) {
                        var respuesta= response.data;
                        me.errorConsulta = 0;
                        me.arrayExisteNombre = [];
                        if(respuesta.consulta.length >= 1){
                            me.errorConsulta = 1;
                            me.arrayExisteNombre.push("(*Ya existe)");                            
                        }else{
                            console.log("no hay coincidencia");
                        }
                        
                    }).catch(function (error) {
                        console.log(error);
                    });

                    console.log("salida: " + me.errorConsulta);
                }
                
            },
            registrarCategoria(){
                if (this.validarCategoria()){
                    return;
                }
                
                let me = this;
                /* El axios es como casi similar al ajax,sirve para que no se refresque la página */
                /* Al momento de agregar algo no se va refrescar la página, sino se va almacenar */
                /* se envia a la ruta categoria/registrar */
                axios.post('/categoria/registrar',{
                    'nombre': this.nombre,
                    'descripcion': this.descripcion
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarCategoria(1,'','nombre');
                    swal({
                            type: 'success',
                            title: 'Registrado!',
                            text: 'La Categoría ha sido Registrado Correctamente!',
                    })
                }).catch(function (error) {
                    console.log(error);
                    swal({
                            type: 'error',
                            title: 'Error!',
                            text: 'El Nombre de la Categoría ya se encuentra Registrado!',
                    })
                });
            },
            actualizarCategoria(){
               if (this.validarCategoria()){
                    return;
                }
                
                let me = this;

                axios.put('/categoria/actualizar',{
                    'nombre': this.nombre,
                    'descripcion': this.descripcion,
                    'id': this.categoria_id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarCategoria(1,'','nombre');
                    swal({
                            type: 'success',
                            title: 'Actualizado!',
                            text: 'Los Datos de la Categoría ha sido Actualizado Correctamente!',
                    })
                }).catch(function (error) {
                    console.log(error);
                    swal({
                            type: 'error',
                            title: 'Error!',
                            text: 'El Nombre de la Categoría ya se encuentra Registrado!',
                    })
                }); 
            },
            desactivarCategoria(id){
               swal({
                title: 'Esta seguro de desactivar esta categoría?',
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

                    axios.put('/categoria/desactivar',{
                        'id': id
                    }).then(function (response) {
                        me.listarCategoria(1,'','nombre');
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
            activarCategoria(id){
               swal({
                title: 'Esta seguro de activar esta categoría?',
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

                    axios.put('/categoria/activar',{
                        'id': id
                    }).then(function (response) {
                        me.listarCategoria(1,'','nombre');
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
            /*método validarCategoria*/
            validarCategoria(){
                this.errorCategoria=0;
                this.errorMostrarMsjCategoria =[];
                     /*si el campo nombre esta vacio, te mandará una alerta*/
                if (!this.nombre){
                    this.errorMostrarMsjCategoria.push("El nombre de la categoría no puede estar vacío.");
                    this.$refs.nombre.focus();
                }
                /*si el campo nombre ya existe, te mandará una alerta*/
                if(this.errorConsulta){
                    this.errorMostrarMsjCategoria.push("El nombre de la categoría ya existe");
                    this.$refs.nombre.focus();
                }
                if (this.errorMostrarMsjCategoria.length) this.errorCategoria = 1;

                return this.errorCategoria;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.nombre='';
                this.descripcion='';
            },
            
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "categoria":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Agregar Categoría';
                                this.nombre= '';
                                this.descripcion = '';
                                this.tipoAccion = 1;
                                //Establecer el foco de la entrada al campo nombre
                                this.$nextTick(() => {
                                    this.$refs.nombre.focus();
                                })
                                break;
                            }
                            case 'actualizar':
                            {
                                //console.log(data);
                                this.modal=1;
                                this.tituloModal='Actualizar Categoría';
                                this.tipoAccion=2;
                                this.categoria_id=data['id'];
                                this.nombre = data['nombre'];
                                this.descripcion= data['descripcion'];
                                break;
                            }
                        }
                    }
                }
            }
        },
        mounted() {
            this.listarCategoria(1,this.buscar,this.criterio);
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
