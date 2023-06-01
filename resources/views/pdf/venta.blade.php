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
        @foreach ($venta as $v)
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
                        <b>{{$v->tipo_comprobante}} @if ($v->tipo_comprobante=='GUIA DE REMISION') - REMITENTE @endif</b>
                    </div>
                    <div style="border-top:solid 2px grey; padding-top: 5px;">
                        <b>{{$v->serie_comprobante}} - N° {{$v->num_comprobante}}</b>
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
        @if ($v->tipo_comprobante=='GUIA DE REMISION')

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
                            <th><p id="usuario">Marca del Vehiculo: <span class="nobold">HYUNDAI&nbsp;&nbsp;&nbsp;</span>Placa Nº:<br>
                            Chofer: <br>
                            Certificado de Inscr Nº:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CONP. VEHIC:<br>                 
                            Brevete Nº: <span class="nobold">Q09842063</span>&nbsp;&nbsp;&nbsp;DNI:</p></th>
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
                                        <p>PUNTO DE PARTIDA:</p>
                                    </div>
                                    <div style="text-align:left !important;">
                                        <p>PUNTO DE LLEGADA:</p>
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
                                TIPO:
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
        </section>
        <!-------------------FIN GUIA DE REMISION------------------------------------->

        <!-------------------PARA BOLETAS O FACTURAS---------------------------------->
        @else

        <section>
        <div style="width: 100%;">
            <div style="float: left;">
                <table id="facliente" width="100%">
                    <thead>                        
                        <tr>
                            <th id="fac">Cliente</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th><p id="cliente">Sr(a).:&nbsp;&nbsp;&nbsp;{{$v->nombre}}<br>
                            {{$v->tipo_documento}}:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$v->num_documento}}<br>
                            Direc.:&nbsp;&nbsp;{{$v->direccion}}
                            </p>
                            </th><br>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!---<div style="float: right;">
                <table id="fausuario" width="100%">
                    <thead>                        
                        <tr>
                            <th id="fac">Vendedor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th><p id="usuario">Usuario:&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;{{$v->usuario}}<br>
                            Fecha Emisión:&nbsp;&nbsp;&nbsp;&nbsp;{{$v->created_at}}</p></th>
                        </tr>
                    </tbody>
                </table>
            </div>-->
        </div>
        </section>
        <br>

        <br>
        <section>
            <div>
                <table id="facproducto">
                    <thead>
                        <tr id="fa">
                            <th>DESCRIPCION</th>
                            <th>CANTIDAD</th>
                            <th>UNID. DE MEDIDA</th>
                            <th>PRECIO UNITARIO</th>
                            <th>SUBTOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detalles as $det)
                            <tr>
                                <td style="border-right:1px solid #000000;" align="center">{{$det->producto}}</td>
                                <td style="border-right:1px solid #000000;" align="center">{{$det->cantidad}}</td>
                                <td style="border-right:1px solid #000000;" align="center"> UNID.</td>
                                <td style="border-right:1px solid #000000;" align="center">{{$det->precio}}</td>
                                <td style="border-right:1px solid #000000;" align="center">{{number_format(($det->cantidad*$det->precio),2)}}</td>
                            </tr>
                        @endforeach
                        @for ($i = count($detalles); $i <= 150; $i++)
                            <tr>
                                <td style="border-right:1px solid #000000;" >
                                </td>
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
        <br>
        <br>
        <div style="width: 100%;">
            <div style="float: left;">

            </div>
            <div style="float: right;">
                <table id="tableTotales" width="100%">
                    <thead>                        
                        <tr>
                            <th></th>
                            <th style="font-size:12px;border-bottom: 1px solid #000000; border-left: 1px solid #000000;">TOTALES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th style="margin-bottom:5px !important;font-size:10px;">SUBTOTAL</th>
                            @if ($v->tipo_comprobante=='FACTURA')
                            <th style="font-size:10px; border-left: 1px solid #000000;">S/. {{round($v->total/1.18,2)}}</th>
                            @else
                            <th style="font-size:10px; border-left: 1px solid #000000;">S/. {{number_format($v->total,2)}}</th>
                            @endif
                        </tr>
                        <tr>
                            <th style="margin-bottom:5px !important;font-size:10px;">IGV
                            @if ($v->tipo_comprobante=='FACTURA')
                            <span>0.18 %</span>
                            @else
                            <span>0.00 %</span>
                            @endif
                            </th>
                            @if ($v->tipo_comprobante=='FACTURA')
                            <th style="font-size:10px; border-left: 1px solid #000000;">S/. {{round($v->total-($v->total/1.18),2)}}</th>
                            @else
                            <th style="font-size:10px; border-left: 1px solid #000000;">S/. 0.00</th>
                            @endif
                        </tr>
                        <tr>
                            <th style="margin-bottom:5px !important;font-size:10px;">TOTAL A PAGAR</th>
                            <th style="font-size:10px; border-left: 1px solid #000000;">S/. {{$v->total}}</th>
                        </tr>
                        
                    
                    </tbody>
                </table>
            </div>
        </div>
        </section>
        <!--------------------------FIN BOLETAS O FACTURAS---------------------------------->
        @endif


        @endforeach
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

        <footer>
            <div id="gracias">
                <p><b>Gracias por su Preferencia..!</b></p>
            </div>
        </footer>
    </body>
</html>