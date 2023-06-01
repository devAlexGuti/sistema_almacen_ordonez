<!DOCTYPE>
<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Pedido</title>
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
            font-size:12px !important;
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
        width: 40%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }

        #fausuario{
        width: 40%;
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

        #fapedido{
        width: 100%;
        margin-bottom: 15px;
        border-collapse: collapse;
        border-spacing: 0;
        border: 1px solid #000000;
        }

        #fapedido thead{
        background: rgb(82, 86, 89,0.2);
        text-align: center;
        border: 1px solid #000000;  
        }

        #ped{
        color: #000000;
        font-size: 15px;
        padding: 6px 12px !important;
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

    </style>
    <body id="identificador">
        @foreach ($pedido as $p)
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
                <div class="hermano2 hermano1">
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
                <div class="hermano2">
                    <div >
                        <b>PEDIDO</b>
                    </div>
                    <div style="border-top:solid 1px grey;">
                        <b>N° {{$p->num_pedido}}</b>
                    </div>
                </div>
            </div>
        </header>
        <br>
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
                            <th><p id="cliente">Sr(a).:&nbsp;&nbsp;&nbsp;{{$p->nombre}}<br>
                            {{$p->tipo_documento}}:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$p->num_documento}}<br>
                            Direc.:&nbsp;&nbsp;{{$p->direccion}}</p></th>
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
                            &nbsp;&nbsp;{{$p->usuario}}<br>
                            Fecha Emisión:&nbsp;&nbsp;&nbsp;&nbsp;{{$p->created_at}}</p></th>
                        </tr>
                    </tbody>
                </table>
            </div>-->
        </div>
        </section>
        <section>
        <div style="width: 100%;">
            <div style="">
                <table id="fapedido" width="100%">
                    <thead>                        
                        <tr>
                            <th colspan="2" id="ped">ORDEN DEL PEDIDO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="border: 1px solid #000000; background-color:white; width:50%; text-align:left; padding: 5px 10px;">Cliente: {{$p->nombre}}</td>
                            <td style="border: 1px solid #000000; background-color:white; width:50%; text-align:left; padding: 5px 10px;">Dirección de Envió: {{$p->dir_enviar}}</td>

                        </tr>
                        <tr>
                            <td style="border: 1px solid #000000; background-color:white; width:50%; text-align:left; padding: 5px 10px;">Dni: {{$p->num_documento}}</td>
                            <td style="border: 1px solid #000000; background-color:white; width:50%; text-align:left; padding: 5px 10px;">Fecha de Envió: {{$p->fecha_enviar}}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000000; background-color:white; width:50%; text-align:left; padding: 5px 10px;">Teléfono: {{$p->telefono}}</td>
                            <td style="border: 1px solid #000000; background-color:white; width:50%; text-align:left; padding: 5px 10px;">Hora de Envió: {{$p->hora_enviar}}</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="border: 1px solid #000000; background-color:white; width:50%; text-align:left; padding: 5px 10px;">Descripción: {{$p->descripcion}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        </section>
        @endforeach
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
                            @foreach($pedido as $p)
                            <tr>
                                <td style="border-right:1px solid #000000;" align="center">{{$det->producto}}</td>
                                <td style="border-right:1px solid #000000;" align="center">{{$det->cantidad}}</td>
                                <td style="border-right:1px solid #000000;" align="center"> UNID.</td>
                                <td style="border-right:1px solid #000000;" align="center">{{$det->precio}}</td>
                                <td style="border-right:1px solid #000000;" align="center">{{number_format(($det->cantidad*$det->precio),2)}}</td>
                            </tr>
                            @endforeach
                        @endforeach
                        @for ($i = count($detalles); $i <= 80; $i++)
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
                    @foreach ($pedido as $p)
                        <tr>
                            <th style="margin-bottom:5px !important;font-size:10px;">SUBTOTAL</th>
                            @if ($p->tipo_comprobante=='FACTURA')
                            <th style="font-size:10px; border-left: 1px solid #000000;">S/. {{round($p->total/1.18,2)}}</th>
                            @else
                            <th style="font-size:10px; border-left: 1px solid #000000;">S/. {{number_format($p->total,2)}}</th>
                            @endif
                        </tr>
                        <tr>
                            <th style="margin-bottom:5px !important;font-size:10px;">IGV
                            @if ($p->tipo_comprobante=='FACTURA')
                            <span>0.18 %</span>
                            @else
                            <span>0.00 %</span>
                            @endif
                            </th>
                            @if ($p->tipo_comprobante=='FACTURA')
                            <th style="font-size:10px; border-left: 1px solid #000000;">S/. {{round($p->total-($p->total/1.18),2)}}</th>
                            @else
                            <th style="font-size:10px; border-left: 1px solid #000000;">S/. 0.00</th>
                            @endif
                        </tr>
                        <tr>
                            <th style="margin-bottom:5px !important;font-size:10px;">TOTAL A PAGAR</th>
                            <th style="font-size:10px; border-left: 1px solid #000000;">S/. {{$p->total}}</th>
                        </tr>
                        
                    @endforeach
                    
                    </tbody>
                </table>
            </div>
        </div>
        </section>
    </body>
</html>