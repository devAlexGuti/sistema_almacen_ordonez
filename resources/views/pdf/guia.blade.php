<!DOCTYPE>
<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de venta</title>
    <style>
        body {
        /*position: relative;*/
        /*width: 16cm;  */
        /*height: 29.7cm; */
        /*margin: 0 auto; */
        /*color: #555555;*/
        /*background: #000000; */
        font-family: Arial, sans-serif; 
        font-size: 0.775rem;
        /*font-family: SourceSansPro;*/
        }

        #logo{
        float: left;
        margin-top: 1%;
        margin-left: 0%;
        margin-right: 0%;
        }

        #imagen{
        width: 100px;
        height: 85px;
        }

        #datos{
        float: left;
        margin-top: -2%;
        /*margin-left: 2%;
        margin-right: 2%;*/
        /*text-align: justify;*/
        }

        #encabezado{
        text-align: center;
        /*margin-left: 1%;*/
        margin-right: 40%;
        font-size: 12px;
        }
        #encabezado b{
        font-size: 16px;
        }

        #fact{
        /*position: absolute;*/
        width:191px;
        float: right;
        margin-top: 0%;
        margin-left: 0%;
        margin-right: 0%;

        /*border-style: solid; 
        border-color: #f39c12;*/

        }
        .hermano1{
            border-radius:10px;
            border-width: 2px; 
            border-style: solid; 
            border-color: rgb(0, 0, 0);
            background-color: rgb(82, 86, 89,0.2); 
            padding: 5px 5px 5px 5px;
            text-align:center;
            font-size:16px;
        }
        .hermano2{
            border-radius:10px; 
            margin-top:10px;
            border-width: 2px; 
            border-style: solid; 
            border-color: rgb(0, 0, 0);
            padding-top:5px; 
            padding-bottom:5px;
            text-align:center;
            font-size:16px;
        }

        .hermano3{
            font-size:12px !important;
        }

        .cabezote{
            border-radius:10px;
            border-width: 2px; 
            border-style: solid; 
            border-color: rgb(0, 0, 0);
            background-color: rgb(82, 86, 89,0.2); 
            padding: 5px 5px 5px 5px;
            text-align:center;
            font-size:12px;
        }

        section{
        clear: left;
        }

        #cliente{
        text-align: left;
        margin: 2px 2px 2px 2px;
        }

        #usuario{
        text-align: left;
        margin: 2px 2px 2px 2px;
        }

        #facliente{
        width: 49%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }

        #fausuario{
        width: 49%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }

        #facliente2{
        width: 29%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }

        #fausuario2{
        width: 70%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }

        #tableTotales{
        width: 40%;
        margin-bottom: 15px;
        border-spacing: 0;
        border: 1px solid #000000;
        border-radius: 10px;
        text-align:center;
        }

        #fac, #fv, #fa{
        color: #000000;
        font-size: 15px;
        
        }

        #facliente thead{
        padding: 20px;
        background: rgb(82, 86, 89,0.2);
        text-align: center;
          
        }

        #fausuario thead{
        padding: 20px;
        background: rgb(82, 86, 89,0.2);
        text-align: center;
          
        }
        
        #facproducto{
        width: 100%;
        margin-bottom: 15px;
        border-collapse: collapse;
        border-spacing: 0;
        border: 1px solid #000000;
        }

        #facproducto thead{
        background: rgb(82, 86, 89,0.2);
        text-align: center;
        border: 1px solid #000000;
        }
        #fa th{
            border: 1px solid #000000;  
        }

        #gracias{
        text-align: center; 
        }
        #identificador{
        margin: 0px 0px 0px 0px;
        }

        .nobold{
            font-weight: normal;
        }

        #tablefoot1{
        width: 39%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }

        #tablefoot2{
        width: 18%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        margin-left: 10px;
        }

        #tablefoot3{
        width: 41%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }


    </style>
    <body id="identificador">
        @foreach ($pedido as $v)
        <header>
            <div id="logo">
                <img src="img/logo-guty.jpeg" alt="" id="imagen">
            </div>
            
            <div id="datos">
                <p id="encabezado">
                    <b>INDUSTRIAS ORDOÑEZ S.A.C</b><br>
                    Importación - Fabricación y Comercialización de Productos de Fierros y Plásticos<br>
                    Tiradores curvos chico y grande en diversos colores<br>
                    Tiradores curvos cromado y dorado - Perillas Cromadas y dorados chico y grande</br>
                    Tiradores pato - tiradores acrilicos MB 131 - 132 - 135 - 136<br>
                    Perillas Pelotitas y flores - Pasacable chico y grande en diversos colores<br>
                    Tapa tornillo en diversos colores - Porta cd y dvd armable y plano<br>
                    Soporte PIN Transparentes - Cornenflex doble y simple en diversos colores<br>
                    Tarugos fisher #6 #8 #10 #12 - Tarugos Drywall<br>
                    Desarrollamos Proyectos Completos para la Fabricación de Productos Plásticos<br>
                    Av. Urubamba Nº 493 Coop. 27 de Abril - Ate - Lima - Lima / Cel: 946-379-860<br>
                    <br>
                </p>
            </div>
            <div id="fact">
                <div class="hermano1">
                    <b>R.U.C. 20392709275 </b>
                </div>
                <div class="hermano2">
                    <div style="padding-bottom: 5px;">
                        <b>GUIA DE REMISION- REMITENTE</b>
                    </div>
                    <div style="border-top:solid 2px grey; padding-top: 5px;">
                        <b>{{$v->serie_comprobante}} - N° {{$v->num_pedido}}</b>
                    </div>
                </div>
                <div class="hermano2 hermano3">
                    <div>
                        <b>FECHA DE EMISIÓN</b>
                    </div>
                    <div style="border-top:solid 2px grey; padding-top: 5px;">
                        <b><?php $now = new \DateTime();
                            echo $now->format('d-m-Y H:i:s');
                        ?>
                        </b>
                    </div>
                </div>
            </div>
        </header>
        <br>
        <!-------------------PARA GUIA DE REMISION---------------------------------->
        <section style="padding-top: 8px;">
            <div style="width: 100%;">
                <div style="float: left;">
                    <table id="facliente" width="100%">
                        <thead>                        
                            <tr>
                                <th id="fac">DESTINARIO</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th><p id="cliente">Nombre o Razón Social:&nbsp;&nbsp;&nbsp;<span class="nobold">{{$v->nombre}}</span><br>
                                {{$v->tipo_documento}}:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="nobold">{{$v->num_documento}}</span><br>
                                </p>
                                </th><br>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div style="float: right;">
                    <table id="fausuario" width="100%">
                        <thead>                        
                            <tr>
                                <th id="fac">UNIDAD DE TRANSPORTE / CONDUCTOR</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach ($despacho as $d)
                                <th><p id="usuario">Marca del Vehiculo: <span class="nobold">{{$d->marca}}&nbsp;&nbsp;&nbsp;</span>Placa Nº: <span class="nobold">{{$d->placa}}</span><br>
                                Chofer: <span class="nobold">{{$d->nombre}}</span><br>
                                Certificado de Inscr Nº:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CONP. VEHIC:<br>                 
                                Brevete Nº: <span class="nobold">{{$d->brevete}}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DNI: <span class="nobold">{{$d->num_documento}}</span></p></th>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <br>
        <section>
            <div style="width: 100%;">
                <div style="float: left;">
                    <table id="facliente2" style="border-collapse:separate !important;" width="100%">
                        <tbody>
                            <tr>
                                <th>
                                    <div class="cabezote" style="border-radius: 10px 10px 0px 0px !important;">CONDICIONES DE PAGO</div>
                                    <div class="cabezote" style="border-radius: 0px 0px 10px 10px !important; background-color:transparent !important;">CONTADO</div>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <div class="cabezote" style="border-radius: 10px 10px 0px 0px !important;">FECHA DE INICIO DE TRASLADO</div>
                                    <?php $fecha = new \DateTime($v->fecha_enviar);?>
                                    <div class="cabezote" style="border-radius: 0px 0px 10px 10px !important; background-color:transparent !important;">{{$fecha->format('d-m-Y')}}</div>
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div style="float: right;">
                    <table id="fausuario2" width="100%">
                        <tbody>
                            <tr>
                                <th>
                                    <div class="cabezote" style="border-radius: 10px 10px 10px 10px !important; height:101px; background-color:transparent !important;">
                                        <div style="text-align:left !important;">
                                            <p>PUNTO DE PARTIDA: Av. Urubamba Nº 493 Coop. 27 de Abril - Ate - Lima</p>
                                        </div>
                                        <div style="text-align:left !important;">
                                            <p>PUNTO DE LLEGADA: {{$v->dir_enviar}}</p>
                                        </div>
                                    </div>
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <section>
            <div>
                <table id="facproducto">
                    <thead>
                        <tr id="fa">
                            <th>PESO</th>
                            <th>CANTIDAD</th>
                            <th>UNID. DE MEDIDA</th>
                            <th>DESCRIPCION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detalles as $det)
                            <tr>
                                <td style="border-right:1px solid #000000;" align="center"></td>
                                <td style="border-right:1px solid #000000;" align="center">{{$det->cantidad}}</td>
                                <td style="border-right:1px solid #000000;" align="center"> UNID.</td>
                                <td style="border-right:1px solid #000000;" align="center">{{$det->producto}}</td>
                            </tr>
                        @endforeach
                        @for ($i = count($detalles); $i <= 100; $i++)
                            <tr>
                                <td style="border-right:1px solid #000000;" >
                                </td>
                                <td style="border-right:1px solid #000000;" >
                                </td>
                                <td style="border-right:1px solid #000000;" >
                                </td>
                                <td style="border-right:1px solid #000000;" >
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </section>
        <div style="width: 100%;">
            <div style="float: left;">
                <table id="tablefoot1" width="100%">
                        <tr>
                            <th>
                                <div class="cabezote" style="border-radius: 10px 10px 0px 0px !important;">TRANSPORTISTA</div>
                                <div class="cabezote" style="border-radius: 0px 0px 10px 10px !important; background-color:transparent !important; text-align:left !important;">
                                NOMBRE: <br>
                                R.U.C.:  
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <div class="cabezote" style="border-radius: 10px 10px 0px 0px !important;">COMPROBANTE DE PAGO</div>
                                <div class="cabezote" style="border-radius: 0px 0px 10px 10px !important; background-color:transparent !important; text-align:left !important;">
                                TIPO: {{$v->serie_comprobante}} - {{$v->num_comprobante}}
                                </div>
                            </th>
                        </tr>
                </table>
            </div>
            <div style="float: left;">
                <table id="tablefoot2" width="100%">
                        <tr>
                            <th>
                                <div class="cabezote" style="border-radius: 10px 10px 0px 0px !important;">DESPACHADO POR</div>
                                <div class="cabezote" style="border-radius: 0px 0px 10px 10px !important; background-color:transparent !important; text-align:left !important;height:74px">
                                {{$v->usuario}}
                                </div>
                            </th>
                        </tr>
                </table>
            </div>
            <div style="float: right;">
                <table id="tablefoot3" width="100%">
                    <tbody>
                        <tr>
                            <th>
                                <div class="cabezote" style="border-radius: 10px 10px 0px 0px !important;">
                                    MOTIVO DE TRASLADO
                                </div>
                                <div class="cabezote" style="font-size:9px !important; text-align: left !important; border-radius: 0px 0px 10px 10px !important; background-color:transparent !important; height:89px;">
                                    <div style="float:left; width:50%;">
                                        <div style="margin-bottom: 5px;">1. COMPRA/VENTA <span style="margin-left:14px; border: 2px solid rgb(0, 0, 0);padding: 5px;">x</span></div>
                                        <div style="margin-bottom: 5px;">2. TRANSFORMACION <span style="border: 2px solid rgb(0, 0, 0);padding: 5px;">x</span></div>
                                        <div style="margin-bottom: 5px;">3. CONCILIACION <span style="margin-left:20px; border: 2px solid rgb(0, 0, 0);padding: 5px;">x</span></div>
                                        4. TRASLADO ENTRE ESTABLECIMIENTOS DE UNA MISMA EMPRESA<span style="margin-left:21px; border: 2px solid rgb(0, 0, 0);padding: 5px;">x</span>
                                    </div>
                                    <div style="float:right; width:50%;">
                                        <div style="margin-bottom: 5px;">5. TRASLADO POR EMISOR REMITENTE EN COMPROBANTE DE PAGO <span style="margin-left:1px; border: 2px solid rgb(0, 0, 0);padding: 5px;">x</span></div>
                                        <div style="margin-bottom: 5px;">6. DEVOLUCION <span style="margin-left:46px; border: 2px solid rgb(0, 0, 0);padding: 5px;">x</span></div>
                                        <div style="margin-bottom: 5px;">7. OTROS <span style="margin-left:74px; border: 2px solid rgb(0, 0, 0);padding: 5px;">x</span></div>

                                    </div>
                                </div>
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-------------------FIN GUIA DE REMISION------------------------------------->

        @endforeach
    </body>
</html>