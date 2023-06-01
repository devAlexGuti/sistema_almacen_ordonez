<template>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0 text-dark">Administrar Clientes</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item active">Administrar Clientes</li>
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
                        <button type="button" @click="abrirModal('persona','registrar')" class="btn btn-primary">
                            <i class="fa fa-plus-circle"></i>&nbsp;Agregar Cliente
                        </button>
                    </div>
                    <div class="card card-primary">
                        <div class="card-header llamada llamada-info" style="padding: 1rem !important;">
                            <div class="row col-md-12">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select class="form-control" v-model="criterio">
                                            <option value="nombre">Nombre</option>
                                            <option value="tipo_documento">Tipo Documento</option>
                                            <option value="num_documento">Num. Documento</option>
                                            <option value="telefono">Teléfono</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" v-model="buscar" @keyup.enter="listarPersona(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <button type="submit" @click="listarPersona(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
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
                                                <th>Tipo Documento</th>
                                                <th>Número</th>
                                                <th>Dirección</th>
                                                <th>Teléfono</th>
                                                <th>Email</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="persona in arrayPersona" :key="persona.id">
                                                <td>
                                                    <button type="button" @click="abrirModal('persona','actualizar',persona)" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                    </button>
                                                </td>
                                                <td v-text="persona.nombre"></td>
                                                <td v-text="persona.tipo_documento"></td>
                                                <td v-text="persona.num_documento"></td>
                                                <td v-text="persona.direccion"></td>
                                                <td v-text="persona.telefono"></td>
                                                <td v-text="persona.email"></td>
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
    <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal, 'show': modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none; overflow-y: scroll;" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background:#117a8b; color:white">
                    <h4 class="modal-title" v-text="tituloModal"></h4>
                    <button type="button" class="close" data-dismiss="modal" @click="cerrarModal()">&times;</button>
                </div>
                <!---CUERPO DEL MODAL-->
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <div class="card-body">
                            <!-- ENTRADA PARA EL NOMBRE DEL CLIENTE-->
                            <div class="input-group input-group-lg mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-user fijo"></i>
                                    </span>
                                </div>
                                <input type="text" @keypress="soloLetras($event);" onpaste="return false" maxlength="100" ref="nombre" v-model="nombre" class="form-control input-lg" :class="{'border-danger' : nombre==''}" placeholder="Ingrese nombre del cliente">
                                <span class="input-group-text" style="color:red;" v-show="nombre==''">(*Ingrese)</span>
                            </div>
                            <!-- ENTRADA PARA EL TIPO DE DOCUMENTO-->
                            <div class="input-group input-group-lg mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-th-list fijo"></i>
                                    </span>                               
                                </div>
                                <select v-model="tipo_documento" class="form-control input-lg" ref="tipo_documento">
                                    <option value="0" disabled>Seleccionar tipo de documento</option>
                                    <option value="DNI">DNI</option>
                                    <option value="RUC">RUC</option>
                                    <option value="PASS">PASS</option>
                                </select>
                                <span class="input-group-text" style="color:red;" v-show="tipo_documento==0">(*Seleccione)</span>     
                            </div>
                            <!-- ENTRADA PARA EL NUMERO DE DOCUMENTO-->
                            <div class="input-group input-group-lg mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-id-card-alt"></i>
                                    </span>                                   
                                </div>
                                <input type="text" @keypress="soloNumeros($event, 'num_documento');" onpaste="return false" @input="validacionReact($event, 'num_documento');" ref="numero" v-model="num_documento" maxlength="12" class="form-control" :class="{'border-danger' : existeNum_documento || num_documento==0 || (tipo_documento== 'RUC' && (num_documento.length<11 || num_documento.length>11)) || (tipo_documento== 'DNI' && (num_documento.length<8 || num_documento.length>8))}" placeholder="Ingrese número de documento">
                                <template v-if="num_documento==0 || (tipo_documento== 'RUC' && num_documento.length<11 ) || (tipo_documento== 'DNI' && num_documento.length<8 )">
                                    <span class="input-group-text" style="color:red;">(*Ingrese)</span>
                                </template>
                                <template v-else-if="(tipo_documento == 'RUC' && num_documento.length>11) || (tipo_documento == 'DNI' && num_documento.length>8)">
                                    <span class="input-group-text" style="color:red;">(*Incorrecto)</span>
                                </template>
                                <template v-else-if="arrayExisteNum_documento.length">
                                    <span class="input-group-text" style="color:red;" v-for="errorNum_doc in arrayExisteNum_documento" :key="errorNum_doc" v-text="errorNum_doc"></span>
                                </template>
                            </div>
                            <div class="input-group input-group-lg mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-address-card"></i>
                                    </span>
                                </div>
                                <input type="text" v-model="direccion" class="form-control input-lg" placeholder="Ingrese dirección">
                            </div>
                            <div class="input-group input-group-lg mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-mobile-alt fijo"></i>
                                    </span>
                                </div>
                                <input type="text" @keypress="soloNumeros($event);" maxlength="9" onpaste="return false" v-model="telefono" class="form-control input-lg" placeholder="Ingrese teléfono">
                            </div>
                            <div class="input-group input-group-lg mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-envelope fijo"></i>
                                    </span>
                                </div>
                                <input type="email" id="email" v-model="email" class="form-control" :class="{'border-danger' : alto}" placeholder="Ingrese correo ejemplo@gmail.com"
                                @blur="validar" ref="email">
                                <span class="input-group-text" style="color:red;" v-if="alto"> (*Formato Incorrecto)</span>
                            </div>
                            <div v-show="errorPersona" class="row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjPersona" :key="error" v-text="error">

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
                    <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarPersona()"><i class="fa fa-save"></i>&nbsp;Guardar Cliente</button>
                    <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarPersona()"><i class="fa fa-save"></i>&nbsp;Actualizar Cliente</button>
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
    export default {
        data (){
            return {
                persona_id: 0,
                nombre : '',
                tipo_documento : 'DNI',
                num_documento : '',
                direccion : '',
                telefono : '',
                email : '',
                arrayPersona : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorPersona : 0,
                errorMostrarMsjPersona : [],
                existeNum_documento: 0,
                arrayExisteNum_documento: [],
                criterioKey: '',
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

                alto: ""

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
            validacionReact(event, x){
                let newEvent = event.target.value;
                //console.log(x+": "+newEvent);
                let me=this;

                axios.post('/user/validacionReact',{
                    'value': newEvent,
                    'variable': x,
                }).then(function (response) {
                    var respuesta= response.data;
                    me.existeNum_documento = 0;
                    me.arrayExisteNum_documento = [];

                    if(respuesta.consulta.length >= 1){
                        me.existeNum_documento = 1;
                        //me.errorMostrarMsjReact.push({Num_documento: '(*Ya existe)'});
                        me.arrayExisteNum_documento.push("(*Ya Existe)");
                    }else{
                        console.log("no hay coincidencia");
                    }
                    
                }).catch(function (error) {
                    console.log(error);
                });
            },
            soloNumeros(event, criterioKey){
                const key = event.keyCode || event.which;
                var me = this;
                if((key >= 48 && key <= 57)) {
                    if(criterioKey == 'num_documento'){
                        if(me.tipo_documento == "DNI" && me.num_documento.length>=8){
                            event.preventDefault();
                        }else if(me.tipo_documento == "RUC" && me.num_documento.length>=11){
                            event.preventDefault();
                        }
                    }
                } else {
                    event.preventDefault();
                }
                
            },
            soloLetras(event) {//SOLO NUMEROS, Y PUNTO
                    const key = event.keyCode || event.which;
                    var tecla = String.fromCharCode(key).toString();
                    var letras = " áéíóúabcdefghijklmnñopqrstuvwxyzÁÉÍÓÚABCDEFGHIJKLMNÑOPQRSTUVWXYZ";//Se define todo el abecedario que se quiere que se muestre.
                    var especiales = [8, 37, 39, 46, 6]; //Es la validación del KeyCodes, que teclas recibe el campo de texto.

                    var tecla_especial = false
                    for(var i in especiales) {
                        if(key == especiales[i]) {
                            tecla_especial = true;
                            break;
                        }
                    }

                    if(letras.indexOf(tecla) == -1 && !tecla_especial){
                        //alert('Tecla no aceptada');
                        event.preventDefault();
                    }

            },
            validar: function(){
                var texto = $("#email").val();
                var arroba = texto.indexOf("@");
                var punto = texto.indexOf(".");
                if (texto != '' && (arroba == -1 || punto == -1)){
                    this.alto = true;
                }else{
                    this.alto = false;
                }
            },
            listarPersona (page,buscar,criterio){
                let me=this;
                var url= '/cliente?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayPersona = respuesta.personas.data;
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
                me.listarPersona(page,buscar,criterio);
            },
            registrarPersona(){
                if (this.validarPersona()){
                    return;
                }

                if (this.validar()){
                    return;
                }
                
                let me = this;

                axios.post('/cliente/registrar',{
                    'nombre': this.nombre,
                    'tipo_documento': this.tipo_documento,
                    'num_documento' : this.num_documento,
                    'direccion' : this.direccion,
                    'telefono' : this.telefono,
                    'email' : this.email
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarPersona(1,'','nombre');
                    swal({
                            type: 'success',
                            title: 'Registrado!',
                            text: 'El Cliente ha sido Registrado Correctamente!',
                    })
                }).catch(function (error) {
                    console.log(error);
                    swal({
                            type: 'error',
                            title: 'Error!',
                            text: 'El Nombre o el Número de documento ya se encuentra Registrado!',
                    })
                });
            },
            actualizarPersona(){
                if (this.validarPersona()){
                    return;
                }

                if (this.validar()){
                    return;
                }
                
                let me = this;

                axios.put('/cliente/actualizar',{
                    'nombre': this.nombre,
                    'tipo_documento': this.tipo_documento,
                    'num_documento' : this.num_documento,
                    'direccion' : this.direccion,
                    'telefono' : this.telefono,
                    'email' : this.email,
                    'id': this.persona_id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarPersona(1,'','nombre');
                    swal({
                            type: 'success',
                            title: 'Actualizado!',
                            text: 'Los Datos del Cliente ha sido Actualizado Correctamente!',
                        })
                }).catch(function (error) {
                    console.log(error);
                    swal({
                            type: 'error',
                            title: 'Error!',
                            text: 'El Nombre o el Número de documento ya se encuentra Registrado!',
                    })
                }); 
            },            
            validarPersona(){
                this.errorPersona=0;
                this.errorMostrarMsjPersona =[];

                var texto = $("#email").val();
                var arroba = texto.indexOf("@");
                var punto = texto.indexOf(".");
                var alter1;             

                if (!this.nombre) {
                    this.errorMostrarMsjPersona.push("El nombre de la persona no puede estar vacío.");
                    this.$refs.nombre.focus();
                }
                if (!this.num_documento) {
                    this.errorMostrarMsjPersona.push("El número de documento no puede estar vacío.");
                    this.$refs.numero.focus();
                }
                if (this.tipo_documento=='DNI' && this.num_documento!='' && (this.num_documento.length<8 || this.num_documento.length>8)){ 
                    this.errorMostrarMsjPersona.push("El número de DNI debe tener 8 digitos");
                    this.$refs.numero.focus();
                }
                if (this.tipo_documento=='RUC' && this.num_documento!='' && (this.num_documento.length<11 || this.num_documento.length>11)) {
                    this.errorMostrarMsjPersona.push("El número de RUC debe tener 11 digitos");
                    this.$refs.numero.focus();
                }
                if(this.existeNum_documento){
                    this.errorMostrarMsjPersona.push("El número de documento ya existe");
                    this.$refs.num_documento.focus();
                }
                /**VALIDAR CORREO */

                if (this.email != '' && this.email!=null && (arroba == -1 || punto == -1)){
                    this.alto = true;
                }else{
                    this.alto = false;
                }

                if (this.email != '' && this.email!=null && this.alto==true) {
                    this.errorMostrarMsjPersona.push("Formato de correo incorrecto.");
                    this.$refs.email.focus();
                }


                if (this.errorMostrarMsjPersona.length) this.errorPersona = 1;

                return this.errorPersona;
            },
            setFocus(){
                //this.nombre.$refs.search.focus();
                
            },

            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.nombre='';
                this.tipo_documento='DNI';
                this.num_documento='';
                this.direccion='';
                this.telefono='';
                this.email='';
                this.errorPersona=0;
                this.alto=false;
            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "persona":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Agregar Cliente';
                                this.nombre= '';
                                this.tipo_documento='DNI';
                                this.num_documento='';
                                this.direccion='';
                                this.telefono='';
                                this.email='';
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                //console.log(data);
                                this.modal=1;
                                this.tituloModal='Actualizar Cliente';
                                this.tipoAccion=2;
                                this.persona_id=data['id'];
                                this.nombre = data['nombre'];
                                this.tipo_documento = data['tipo_documento'];
                                this.num_documento = data['num_documento'];
                                this.direccion = data['direccion'];
                                this.telefono = data['telefono'];
                                this.email = data['email'];
                                break;
                            }
                        }
                    }
                }
            }
        },
        mounted() {
            this.listarPersona(1,this.buscar,this.criterio);
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
    .fijo{
        width: 16px !important;
        height: 14px !important;
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
