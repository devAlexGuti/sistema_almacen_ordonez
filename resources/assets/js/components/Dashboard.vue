<template>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row" v-for="totales in arrayTotales" :key="totales.id">
          <div class="col-lg-4 col-12">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>S/. <span v-text="totales.totalventa" ></span></h3>

                <p>Ventas</p>
              </div>
              <div class="icon">
                <i class="ion ion-social-usd"></i>
              </div>
              <a href="#" class="small-box-footer"><strong>Fecha: {{since()}}</strong></a>
            </div>
          </div>
          <!-- ./col -->
          <!--
          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3>S/. <span v-text="totales.totalcompra"></span></h3>

                <p>Compras</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer"><strong>Fecha: {{since()}}</strong></a>
            </div>
          </div>
          -->
          <!-- ./col -->
          <div class="col-lg-4 col-12">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><span v-text="totales.totalclientes"></span></h3>

                <p>Clientes Registrados</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer"><strong>Fecha: {{since()}}</strong></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-12">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><span v-text="totales.totalproductos" ></span></h3>

                <p>Productos</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-cart"></i>
              </div>
              <a href="#" class="small-box-footer"><strong>Fecha: {{since()}}</strong></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <div class="col-lg-12 connectedSortable">
                <!-- Custom tabs (Charts with tabs)-->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                        <i class="fas fa-chart-pie mr-1"></i>
                        Gráfico de Ventas
                        </h3>
                        <!-- card tools -->
                        <div class="card-tools">
                        <button type="button"
                                class="btn btn-primary btn-sm"
                                data-card-widget="collapse"
                                data-toggle="tooltip"
                                title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        </div>
                        <!-- /.card-tools -->
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content p-0">
                            <div class="box-body border-radius-none nuevoGraficoVentas">
                                <canvas class="chart" id="ventasDia" style="height: 250px;"></canvas>
                            </div>
                        </div>
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
        <div class="row">
            <!-- Main row -->
            <div class="col-lg-6 connectedSortable">
                <!-- Custom tabs (Charts with tabs)-->
                <div class="card">
                    <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-pie mr-1"></i>
                        Productos Más Vendidos
                    </h3>
                    <!-- card tools -->
                    <div class="card-tools">
                        <button type="button"
                                class="btn btn-primary btn-sm"
                                data-card-widget="collapse"
                                data-toggle="tooltip"
                                title="Collapse">
                        <i class="fas fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                    </div><!-- /.card-header -->
                    <div class="card-body">
                    <div class="tab-content p-0">
                        <div class="chart-wrapper">
                            <canvas id="loMasVendidos" style="height:230px"></canvas>
                        </div> 
                    </div>
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

                        <div class="col-lg-6 connectedSortable">
                <!-- Custom tabs (Charts with tabs)-->
                <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                    <i class="fas fa-chart-pie mr-1"></i>
                    Ventas de los últimos 12 Meses
                    </h3>
                    <!-- card tools -->
                    <div class="card-tools">
                    <button type="button"
                            class="btn btn-primary btn-sm"
                            data-card-widget="collapse"
                            data-toggle="tooltip"
                            title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    </div>
                    <!-- /.card-tools -->
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content p-0">
                        <div class="chart">
                            <canvas id="ventas" style="height:230px">                                                
                            </canvas>
                        </div>
                    </div>
                </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

            <!--
            <div class="col-lg-6 connectedSortable">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                        <i class="fas fa-chart-pie mr-1"></i>
                        Clientes con más Compras
                        </h3>
                        <div class="card-tools">
                            <button type="button"
                                    class="btn btn-primary btn-sm"
                                    data-card-widget="collapse"
                                    data-toggle="tooltip"
                                    title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content p-0">
                            <div class="chart-wrapper">
                                <canvas id="clientesCompradores" style="height:230px"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            -->
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->

        <!-- /.row (main row) -->
        <div class="row">
            <!--
            <div class="col-lg-6 connectedSortable">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-chart-pie mr-1"></i>
                            Compras de los últimos 12 Meses
                        </h3>
                        <div class="card-tools">
                            <button type="button"
                                    class="btn btn-primary btn-sm"
                                    data-card-widget="collapse"
                                    data-toggle="tooltip"
                                    title="Collapse">
                            <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content p-0">
                            <div class="chart">
                                <canvas id="compras" style="height:230px">                                                
                                </canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            -->


          <!-- right col -->
        </div>
        <!-- /.row (main row) -->

        <!-- /.row (main row) -->
        <div class="row">
            <!-- Main row -->
            <div class="col-lg-6 connectedSortable">
                <!-- Custom tabs (Charts with tabs)-->
                <div class="card">
                    <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-pie mr-1"></i>
                        Entregas Perfectas "Pre-Test"
                    </h3>
                    <!-- card tools -->
                    <div class="card-tools">
                        <button type="button"
                                class="btn btn-primary btn-sm"
                                data-card-widget="collapse"
                                data-toggle="tooltip"
                                title="Collapse">
                        <i class="fas fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                    </div><!-- /.card-header -->
                    <div class="card-body">
                    <div class="tab-content p-0">
                        <div class="chart-wrapper">
                            <canvas id="indicador1" style="height:230px"></canvas>
                        </div>
                    </div>
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-lg-6 connectedSortable">
                <!-- Custom tabs (Charts with tabs)-->
                <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                    <i class="fas fa-chart-pie mr-1"></i>
                    Entregas Perfectas "Pos-Test"
                    </h3>
                    <!-- card tools -->
                    <div class="card-tools">
                    <button type="button"
                            class="btn btn-primary btn-sm"
                            data-card-widget="collapse"
                            data-toggle="tooltip"
                            title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    </div>
                    <!-- /.card-tools -->
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content p-0">
                        <div class="chart-wrapper">
                            <canvas id="indicador1_postest" style="height:230px"></canvas>
                        </div>
                    </div>
                </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

          <!-- right col -->
        </div>
        <!-- /.row (main row) -->

        <!-- /.row (main row) -->
        <div class="row">
            <!-- Main row -->
            <div class="col-lg-6 connectedSortable">
                <!-- Custom tabs (Charts with tabs)-->
                <div class="card">
                    <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-pie mr-1"></i>
                        Entregas a Tiempo "Pre-Test"
                    </h3>
                    <!-- card tools -->
                    <div class="card-tools">
                        <button type="button"
                                class="btn btn-primary btn-sm"
                                data-card-widget="collapse"
                                data-toggle="tooltip"
                                title="Collapse">
                        <i class="fas fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                    </div><!-- /.card-header -->
                    <div class="card-body">
                    <div class="tab-content p-0">
                        <div class="chart-wrapper">
                            <canvas id="indicador2" style="height:230px"></canvas>
                        </div>
                    </div>
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-lg-6 connectedSortable">
                <!-- Custom tabs (Charts with tabs)-->
                <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                    <i class="fas fa-chart-pie mr-1"></i>
                    Indicador Entregas a Tiempo "Pos-Test"
                    </h3>
                    <!-- card tools -->
                    <div class="card-tools">
                    <button type="button"
                            class="btn btn-primary btn-sm"
                            data-card-widget="collapse"
                            data-toggle="tooltip"
                            title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    </div>
                    <!-- /.card-tools -->
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content p-0">
                        <div class="chart-wrapper">
                            <canvas id="indicador2_postest" style="height:230px"></canvas>
                        </div>
                    </div>
                </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div>
    </section>
</div>
</template>
<script>
    import moment from 'moment'
    
    export default {
        data (){
            return {
                totales_id: 0,
                arrayTotales: [],
                varCompra:null,
                charCompra:null,
                compras:[],
                varTotalCompra:[],
                varMesCompra:[], 
                
                varVenta:null,
                charVenta:null,
                ventas:[],
                varTotalVenta:[],
                varMesVenta:[],

                varVentaDia:null,
                charVentaDia:null,
                ventasDia:[],
                varArrayVentaDia:[],
                varArrayTotalDia:[],

                varLoMasVendido:null,
                charLoMasVendido:null,
                cantidades:[],
                totalcantidad:[],
                producto:[],

                varClientesComprador:null,
                charClientesComprador:null,
                arrayCLientesComprador:[],
                totalVenta:[],
                nombreProducto:[],

                varIndicador1:null,
                charIndicador1:null,
                dia:[],
                entrega_perfecta_pretest:[],
                arrayProducto:[],
                nivel_cumplimiento_despachos_postest:[],

                varIndicador1_postest:null,
                charIndicador1_postest:null,
                arrayProducto1_postest:[],
                indicador1_dia_postest:[],
                
                varIndicador2:null,
                charIndicador2:null,
                dia_pretest:[],
                entrega_tiempo_pretest:[],
                arrayProducto2:[],
                entregastiempo_postest:[],
                
                varIndicador2_postest:null,
                charIndicador2_postest:null,
                arrayProducto2_postest:[],
                dia_postest:[]

            }
        },
        methods : {
            since: function(){
                // What time is it in Perú? (time zone: UTC-5) .format('MM/DD/YYYY HH:mm')
                return   moment.utc().add('hours',-5).format('DD/MM/YYYY');
            },
            getTotales(){
                let me=this;
                var url= '/dashboard/obtenerDatos';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayTotales = respuesta.totales;
                    //cargamos los datos del chart
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            getCompras(){
                let me=this;
                var url= '/dashboard';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.compras = respuesta.compras;
                    //cargamos los datos del chart
                    me.loadCompras();
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            getVentas(){
                let me=this;
                var url= '/dashboard';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.ventas = respuesta.ventas;
                    //cargamos los datos del chart
                    me.loadVentas();
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            loadCompras(){
                let me=this;
                me.compras.map(function(x){
                    me.varMesCompra.push(x.mes);
                    me.varTotalCompra.push(x.total);
                });
                me.varCompra=document.getElementById('compras').getContext('2d');

                me.charCompra = new Chart(me.varCompra, {
                    type: 'bar',
                    data: {
                        labels: me.varMesCompra,
                        datasets: [{
                            label: "# Compras en S/. de los últimos 12 meses",
                            data: me.varTotalCompra,
                            backgroundColor: [
                                'rgba(39, 174, 96, 0.3)',
                                'rgba(54, 162, 235, 0.3)',
                                'rgba(255, 206, 86, 0.3)',
                                'rgba(75, 192, 192, 0.3)',
                                'rgba(153, 102, 255, 0.3)',
                                'rgba(255, 99, 132, 0.3)'
                            ],
                            borderColor: [
                                'rgba(39, 174, 96, 2)',
                                'rgba(54, 162, 235, 2)',
                                'rgba(255, 206, 86, 2)',
                                'rgba(75, 192, 192, 2)',
                                'rgba(153, 102, 255, 2)',
                                'rgba(255,99,132,2)'
                            ],
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true
                    }
                });
            },
            loadVentas(){
                let me=this;
                me.ventas.map(function(x){
                    me.varMesVenta.push(x.mes);
                    me.varTotalVenta.push(x.total);
                });
                me.varVenta=document.getElementById('ventas').getContext('2d');

                me.charVenta = new Chart(me.varVenta, {
                    type: 'bar',
                    data: {
                        labels: me.varMesVenta,
                        datasets: [{
                            label: '# Ventas en S/. de los últimos 12 meses',
                            data: me.varTotalVenta,
                            backgroundColor: 'rgba(75, 192, 192, 0.3)',
                            borderColor: 'rgba(75, 192, 192, 2)',
                            pointBackgroundColor: 'rgba(75, 192, 192, 2)',
                            pointBorderColor: '#fff',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });
            },
            getIndicador1(){
               let me=this;
                var url= '/dashboard/reporteIndicador1';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayProducto = respuesta.indicador1_pretest;
                    //cargamos los datos del chart
                    me.loadIndicador1();
                })
                .catch(function (error) {
                    console.log(error);
                }); 
            },
            loadIndicador1(){
                let me=this;
                me.arrayProducto.map(function(x){
                    me.dia.push(x.dia);
                    me.entrega_perfecta_pretest.push(x.entrega_perfecta_pretest);
                });
                me.varIndicador1=document.getElementById('indicador1').getContext('2d');
                me.charIndicador1 = new Chart(me.varIndicador1, {
                    type: 'bar',
                    data: {
                        labels: me.dia,
                        datasets: [{
                        label: 'Pre - Test',
                        backgroundColor: 'rgba(233, 150, 122, 0.3)',
                        borderColor: 'rgba(233, 150, 122, 2)',
                        highlightFill: 'rgba(233, 150, 122, 2)',
                        highlightStroke: 'rgba(233, 150, 122, 2)',
                        borderWidth: 2,
                        data: me.entrega_perfecta_pretest,
                        }]
                    },
                    options: {
                        responsive: true
                        }
                    });
            },
            getIndicador1_postest(){
               let me=this;
                var url= '/dashboard/reporteIndicador1_postest';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayProducto1_postest = respuesta.indicador1_postest;
                    //cargamos los datos del chart y mostrarlo
                    me.loadIndicador1_postest();
                })
                .catch(function (error) {
                    console.log(error);
                }); 
            },
            loadIndicador1_postest(){
                let me=this;
                me.arrayProducto1_postest.map(function(x){
                    me.indicador1_dia_postest.push(x.dia);
                    me.nivel_cumplimiento_despachos_postest.push(x.nivel_cumplimiento_despachos_postest);
                });
                me.varIndicador1_postest=document.getElementById('indicador1_postest').getContext('2d');
                me.charIndicador1_postest = new Chart(me.varIndicador1_postest, {
                    type: 'bar',
                    data: {
                        labels: me.indicador1_dia_postest,
                        datasets: [{
                        label: 'Post - Test',
                        backgroundColor: 'rgba(52, 152, 219, 0.3)',
                        borderColor: 'rgba(52, 152, 219, 2)',
                        highlightFill: 'rgba(52, 152, 219, 2)',
                        highlightStroke: 'rgba(52, 152, 219, 2)',
                        borderWidth: 2,
                        data: me.nivel_cumplimiento_despachos_postest
                        }]
                    },
                    options: {
                        responsive: true
                    }
                    });
            },
            getIndicador2(){
               let me=this;
                var url= '/dashboard/reporteIndicador2';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayProducto2 = respuesta.indicador2_pretest;
                    //cargamos los datos del chart
                    me.loadIndicador2();
                })
                .catch(function (error) {
                    console.log(error);
                }); 
            },
            loadIndicador2(){
                let me=this;
                me.arrayProducto2.map(function(x){
                    me.dia_pretest.push(x.dia);
                    me.entrega_tiempo_pretest.push(x.entrega_tiempo_pretest);
                });
                me.varIndicador2=document.getElementById('indicador2').getContext('2d');
                me.charIndicador2 = new Chart(me.varIndicador2, {
                    type: 'bar',
                    data: {
                        labels: me.dia_pretest,
                        datasets: [{
                        label: 'Pre - Test',
                        backgroundColor: 'rgba(225, 219, 19, 0.3)',
                        borderColor: 'rgba(225, 219, 19, 2)',
                        highlightFill: 'rgba(225, 219, 19, 2)',
                        highlightStroke: 'rgba(225, 219, 19, 2)',
                        borderWidth: 2,
                        data: me.entrega_tiempo_pretest
                        }]
                    },
                    options: {
                        responsive: true
                    }
                    });
            },

            getIndicador2_postest(){
               let me=this;
                var url= '/dashboard/reporteIndicador2_postest';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayProducto2_postest = respuesta.indicador2_postest;
                    //cargamos los datos del chart y mostrarlo
                    me.loadIndicador2_postest();
                })
                .catch(function (error) {
                    console.log(error);
                }); 
            },
            loadIndicador2_postest(){
                let me=this;
                me.arrayProducto2_postest.map(function(x){
                    me.dia_postest.push(x.dia);
                    me.entregastiempo_postest.push(x.entregastiempo_postest);
                });
                me.varIndicador2_postest=document.getElementById('indicador2_postest').getContext('2d');
                me.charIndicador2_postest = new Chart(me.varIndicador2_postest, {
                    type: 'bar',
                    data: {
                        labels: me.dia_postest,
                        datasets: [{
                        label: 'Post - Test',
                        backgroundColor: 'rgba(32, 58, 97, 0.3)',
                        borderColor: 'rgba(32, 58, 97, 2)',
                        highlightFill: 'rgba(32, 58, 97, 2)',
                        highlightStroke: 'rgba(32, 58, 97, 2)',
                        borderWidth: 2,
                        data: me.entregastiempo_postest
                        }]
                    },
                    options: {
                        responsive: true
                    }
                    });
            },

            getLoMasVendidos(){
               let me=this;
                var url= '/dashboard/productosVendidos';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.cantidades = respuesta.productosvendidos;
                    //cargamos los datos del chart
                    me.loadLoMasVendidos();
                })
                .catch(function (error) {
                    console.log(error);
                }); 
            },
            loadLoMasVendidos(){
                let me=this;
                me.cantidades.map(function(x){
                    me.producto.push(x.producto);
                    me.totalcantidad.push(x.cantidad);
                });
                me.varLoMasVendido=document.getElementById('loMasVendidos').getContext('2d');
                me.charLoMasVendido = new Chart(me.varLoMasVendido, {
                type: 'doughnut',
                data: {
                    labels: me.producto,
                    datasets: [{
                        label: me.producto,
                        fill: false,
                        data: me.totalcantidad,
                        backgroundColor: ['#FFA07A', '#F0EB37','#00a65a','#FF6384','#f56954','#f39c12',
                        '#00c0ef','#3c8dbc','#d2d6de','#8B008B'],
                        hoverBackgroundColor: ['#FFA07A', '#F0EB37','#00a65a','#FF6384','#f56954','#f39c12',
                        '#00c0ef','#3c8dbc','#d2d6de','#8B008B']
                    }]
                },
                options: {
                    responsive: true,
                    legend: {
                        display: true,
                        position: 'bottom'
                    },
                    tooltips: {
                        callbacks: { 
                            label: function(tooltipItems, data) { 
                                return data['labels'][tooltipItems['index']]+': ' + data['datasets'][0]['data'][tooltipItems['index']];
                                //chart js v2
                            },
                            afterLabel: function(tooltipItems, data) {
                            var dataset = data['datasets'][0];
                            var percent = Math.round((dataset['data'][tooltipItems['index']] / dataset._meta[Object.keys(dataset._meta)[0]].total) * 100)
                            return '(' + percent + '%)';
                            } 
                        },

                    }
                }
                });
            },
            /*
            getClientesCompradores(){
               let me=this;
                var url= '/dashboard/clientesCompradores';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayCLientesComprador = respuesta.clientescompradores;
                    //cargamos los datos del chart
                    me.loadClientesCompradores();
                })
                .catch(function (error) {
                    console.log(error);
                }); 
            },
            loadClientesCompradores(){
                let me=this;
                me.arrayCLientesComprador.map(function(x){
                    me.nombreProducto.push(x.nombre_producto);
                    me.totalVenta.push(x.total_venta);
                });
                me.varLoMasVendido=document.getElementById('clientesCompradores').getContext('2d');
                me.charLoMasVendido = new Chart(me.varLoMasVendido, {
                type: 'pie',
                data: {
                    labels: me.nombreProducto,
                    datasets: [{
                    label: me.nombreProducto,
                    fill: false,
                    data: me.totalVenta,
                    backgroundColor: ['#dd4b39','#00c0ef','#3c8dbc','#d2d6de','#8B008B',
                     '#F0EB37','#00a65a','#FF6384','#f56954','#f39c12',
                    ],
                    hoverBackgroundColor: ['#dd4b39','#00c0ef','#3c8dbc','#d2d6de','#8B008B',
                     '#F0EB37','#00a65a','#FF6384','#f56954','#f39c12',
                    ]
                    }]
                },
                options: {
                    responsive: true,
                    legend: {
                        display: true,
                        position: 'bottom'
                    },
                    tooltips: {
                        callbacks: { 
                            label: function(tooltipItems, data) { 
                                return data['labels'][tooltipItems['index']]+': S/. ' + data['datasets'][0]['data'][tooltipItems['index']];
                                //chart js v2
                            },
                            afterLabel: function(tooltipItems, data) {
                            var dataset = data['datasets'][0];
                            var percent = Math.round((dataset['data'][tooltipItems['index']] / dataset._meta[Object.keys(dataset._meta)[0]].total) * 100)
                            return '(' + percent + '%)';
                            } 
                        },

                    }
                }
                });
            },*/
            getVentasDia(){
                let me=this;
                var url= '/dashboard/ventasDia';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.ventasDia = respuesta.ventasdia;
                    //cargamos los datos del chart
                    me.loadVentasDia();
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            loadVentasDia(){
                let me=this;
                me.ventasDia.map(function(x){
                    me.varArrayVentaDia.push(x.dia);
                    me.varArrayTotalDia.push(x.totaldia);
                });
                me.varVentaDia=document.getElementById('ventasDia').getContext('2d');
                me.charVentaDia = new Chart(me.varVentaDia, {
                    type: 'line',
                    data: {
                        labels: me.varArrayVentaDia,
                        datasets: [{
                            label: "Ventas Del Día",
                            fill: false,
                            data: me.varArrayTotalDia,
                            backgroundColor: [
                                'rgba(54, 162, 235, 0.8)',
                                'rgba(239,239,239, 0.8)',
                                'rgba(255,165,0, 0.8)',
                                'rgba(218,165,32, 0.8)',
                                'rgba(250,250,210, 0.8)',
                                'rgba(255,127,80, 0.8)',
                                'rgba(240,230,140, 0.8)',
                                'rgba(75, 192, 192, 0.8)',
                                'rgba(153, 102, 255, 0.8)',
                                'rgba(255, 99, 132, 0.8)',
                                
                                'rgba(255, 206, 86, 0.8)',
                                'rgba(255, 159, 64, 0.8)',
                                'rgba(112,128,144, 0.8)',
                                'rgba(245,255,250, 0.8)',
                                'rgba(255,218,185, 0.8)',
                                'rgba(210,180,140, 0.8)',
                                'rgba(244,164,96, 0.8)',
                                
                                
                                'rgba(173,255,47, 0.8)'
                            ],
                            borderColor: [
                                'rgba(54, 162, 235, 1)',
                                'rgba(239,239,239, 1)',
                                'rgba(255,165,0, 1)',
                                'rgba(218,165,32, 1)',
                                'rgba(250,250,210, 1)',
                                'rgba(255,127,80, 1)',
                                'rgba(240,230,140, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255,99,132,1)',
                                
                                'rgba(255, 206, 86, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(112,128,144, 1)',
                                'rgba(245,255,250, 1)',
                                'rgba(255,218,185, 1)',
                                'rgba(210,180,140, 1)',
                                'rgba(244,164,96, 1)',
                                
                                
                                'rgba(173,255,47, 1)'
                            ],
                            highlightFill: 'rgba(54, 162, 235, 2)',
                            highlightStroke: 'rgba(54, 162, 235, 2)',
                            borderWidth: 3
                        }]
                    },
                    options: {
                        responsive: true,
                        tooltips: {
                        /*tooltips: { 
                        callbacks: { 
                        label: function(tooltipItems, data) { 
                            return data.datasets[tooltipItems.datasetIndex].label +': S/. ' + tooltipItems.yLabel + ' €'; 
                        } 
                        } 
                        } */
                        callbacks: { 
                            label: function(tooltipItems, data) { 
                                return data.datasets[tooltipItems.datasetIndex].label +': S/. ' + tooltipItems.yLabel; 
                            } 
                        } 

                        }
                    }
                    });
            }
        },
        mounted() {
            this.getCompras();
            this.getVentas();
            this.getTotales();
            this.getVentasDia();
            this.getLoMasVendidos();
            /*this.getClientesCompradores();*/
            this.getIndicador1();
            this.getIndicador1_postest();
            this.getIndicador2();
            this.getIndicador2_postest();
        }
    }
</script>
<style>
 
</style>
