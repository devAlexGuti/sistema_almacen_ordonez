<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Fluid Grid Master</title>


</head>
<body style="margin:0; padding:0; background-color:#F2F2F2;">
    @foreach ($msg['correo'] as $v)
    <div style="font-family:Verdana,Arial;font-weight:normal;margin:0;padding:0;text-align:left;color:#333333;background-color:#ebebeb;background:#ebebeb;font-size:12px">

        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;padding:0;margin:0">
            <tbody>
                <!--CABEZERA LOGO DE LA EMPRESA-->
                <tr>
                    <td bgcolor="#FFF" align="center" style="border-bottom:3px solid #c9c9c9;font-family:Verdana,Arial;font-weight:normal;border-collapse:collapse;vertical-align:top;padding:0;margin:0">

                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;border-collapse:collapse;padding:0;margin:0">
                            <tbody>
                                <tr>
                                    <td align="center" valign="top" style="padding:15px 0;font-family:Verdana,Arial;font-weight:normal;border-collapse:collapse;vertical-align:top;margin:0">
                                        <a href="http://www.industriasordonez.pe/" style="color:#3e3935;float:left;display:block" target="_blank">
                                            <img src="{{ asset('img/logo-ordonez.jpeg') }}" width="217" style="display:block;font-family:Helvetica,Arial,sans-serif;color:#ffffff;font-size:16px;outline:none;text-decoration:none" border="0">
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td bgcolor="#ffffff" align="center" style="padding:40px 15px 70px 15px;font-family:Verdana,Arial;font-weight:normal;border-collapse:collapse;vertical-align:top;margin:0">

                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;border-collapse:collapse;padding:0;margin:0">
                            <tbody>
                                <tr>
                                    <td style="font-family:Verdana,Arial;font-weight:normal;border-collapse:collapse;vertical-align:top;padding:0;margin:0">
                                        <table cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;padding:0;margin:0">
                                            <tbody>
                                                <tr>
                                                    <td style="font-family:Verdana,Arial;font-weight:normal;border-collapse:collapse;vertical-align:top;padding:0;margin:0">
                                                        <table cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;padding:0;margin:0">
                                                            <tbody>
                                                                <tr>
                                                                    <td colspan="2" style="font-family:Verdana,Arial;font-weight:normal;border-collapse:collapse;vertical-align:top;padding:0 1%;margin:0;text-align:center;width:58%">
                                                                        <p style="text-transform:uppercase;text-align:left;font-family:Verdana,Arial;font-weight:normal;line-height:20px;margin:1em 0">
                                                                        Hola, {{$v->nombre}}, Gracias por comprar en <strong style="font-family:Verdana,Arial;font-weight:bold">
                                                                        Industrias Ordoñez</strong>.</p>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2" style="font-family:Verdana,Arial;font-weight:normal;border-collapse:collapse;vertical-align:top;padding:0 1%;margin:0;text-align:center;width:58%">
                                                                        <p style="text-align:left;font-family:Verdana,Arial;font-weight:normal;line-height:20px;margin:1em 0">
                                                                        Tu pedido esta saliendo del almacén, rumbo al destino que nos indicaste entregar tu producto.</p>
                                                                        <p style="text-align:left;font-family:Verdana,Arial;font-weight:normal;line-height:20px;margin:1em 0">
                                                                        <br>
                                                                        Por favor ingrese este código <strong>"{{$msg['codigo']}}"</strong> cuando el Courier lo solicite (si todos sus productos
                                                                        solicitados en este pedido ha sido entregado correctamente y esta conforme).</p>
                                                                        <p style="text-align:left;font-family:Verdana,Arial;font-weight:normal;line-height:20px;margin:1em 0">
                                                                        <br>
                                                                        A continuación encontrarás la conﬁrmación de tu compra.</p>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-family:Verdana,Arial;font-weight:normal;border-collapse:collapse;vertical-align:top;padding:5px 15px;margin:0;margin-top:15px;border:5px solid #b2b0ae;text-align:center;box-sizing:content-box">
                                                        <h3 style="text-transform:uppercase;font-family:Verdana,Arial;font-weight:normal;font-size:17px;margin-bottom:15px;margin-top:15px">
                                                        Tu pedido <span><strong style="font-family:Verdana,Arial;font-weight:bold">Nº {{$v->num_pedido}}</strong></span>
                                                        </h3>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-family:Verdana,Arial;font-weight:normal;border-collapse:collapse;vertical-align:top;padding:0;margin:0">
                                                        <p style="text-align:center;font-family:Verdana,Arial;font-weight:normal">
                                                        Realizado el {{$msg['fecha_es']}}</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-family:Verdana,Arial;font-weight:normal;border-collapse:collapse;vertical-align:top;padding:0;margin:0">
                                                        <table cellspacing="0" cellpadding="0" border="0" width="650" style="border:1px solid #eaeaea;border-collapse:collapse;padding:0;margin:0">
                                                            <thead>
                                                                <tr>
                                                                    <th align="left" bgcolor="#EAEAEA" style="font-size:13px;padding:3px 9px;font-family:Verdana,Arial;font-weight:normal">
                                                                    Producto</th>
                                                                    <th align="left" bgcolor="#EAEAEA" style="font-size:13px;padding:3px 9px;font-family:Verdana,Arial;font-weight:normal">
                                                                    Unidad de mantenimiento de existencias (SKU)</th>
                                                                    <th align="center" bgcolor="#EAEAEA" style="font-size:13px;padding:3px 9px;font-family:Verdana,Arial;font-weight:normal">
                                                                    Cant.</th>
                                                                    <th align="right" bgcolor="#EAEAEA" style="font-size:13px;padding:3px 9px;font-family:Verdana,Arial;font-weight:normal">
                                                                    Subtotal</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody bgcolor="#F6F6F6">
                                                            @foreach ($msg['detalles'] as $det)
                                                                <tr>
                                                                    <td align="left" valign="top" style="font-size:11px;padding:3px 9px;border-bottom:1px dotted #cccccc;font-family:Verdana,Arial;font-weight:normal;border-collapse:collapse;vertical-align:top;margin:0">
                                                                    <strong style="font-size:11px;font-family:Verdana,Arial;font-weight:normal">{{$det->producto}}</strong>
                                                                    </td>
                                                                    <td align="left" valign="top" style="font-size:11px;padding:3px 9px;border-bottom:1px dotted #cccccc;font-family:Verdana,Arial;font-weight:normal;border-collapse:collapse;vertical-align:top;margin:0">
                                                                    UNID.</td>
                                                                    <td align="center" valign="top" style="font-size:11px;padding:3px 9px;border-bottom:1px dotted #cccccc;font-family:Verdana,Arial;font-weight:normal;border-collapse:collapse;vertical-align:top;margin:0">
                                                                    {{$det->cantidad}}</td>
                                                                    <td align="right" valign="top" style="font-size:11px;padding:3px 9px;border-bottom:1px dotted #cccccc;font-family:Verdana,Arial;font-weight:normal;border-collapse:collapse;vertical-align:top;margin:0">
                                                                    <span style="font-family:&quot;Helvetica Neue&quot;,Verdana,Arial,sans-serif">S/ {{number_format(($det->cantidad*$det->precio),2)}}</span>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                            <tbody>
                                                                <tr>
                                                                    <td colspan="3" align="right" style="padding:3px 9px;font-family:Verdana,Arial;font-weight:normal;border-collapse:collapse;vertical-align:top;margin:0">
                                                                    Subtotal </td>
                                                                    <td align="right" style="padding:3px 9px;font-family:Verdana,Arial;font-weight:normal;border-collapse:collapse;vertical-align:top;margin:0">
                                                                    <span style="font-family:&quot;Helvetica Neue&quot;,Verdana,Arial,sans-serif">S/ {{number_format(($det->cantidad*$det->precio),2)}}</span>
                                                                    </td>
                                                                </tr>
                                                                <tr style="padding-bottom:5px">
                                                                    <td colspan="3" align="right" style="padding:3px 9px;font-family:Verdana,Arial;font-weight:normal;border-collapse:collapse;vertical-align:top;margin:0">
                                                                    Cargos por manejos y envío </td>
                                                                    <td align="right" style="padding:3px 9px;font-family:Verdana,Arial;font-weight:normal;border-collapse:collapse;vertical-align:top;margin:0">
                                                                    <span style="font-family:&quot;Helvetica Neue&quot;,Verdana,Arial,sans-serif">S/ 89</span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="3" align="right" style="padding:3px 9px;font-family:Verdana,Arial;font-weight:normal;border-collapse:collapse;vertical-align:top;margin:0">
                                                                    <strong style="font-family:Verdana,Arial;font-weight:normal">Suma total</strong>
                                                                    </td>
                                                                    <td align="right" style="padding:3px 9px;font-family:Verdana,Arial;font-weight:normal;border-collapse:collapse;vertical-align:top;margin:0">
                                                                    <strong style="font-family:Verdana,Arial;font-weight:normal"><span style="font-family:&quot;Helvetica Neue&quot;,Verdana,Arial,sans-serif">S/ {{$v->total}}</span></strong>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <table cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;padding:0;margin:0">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="font-family:Verdana,Arial;font-weight:normal;border-collapse:collapse;vertical-align:top;padding:10px 10px 0;margin:0;padding-top:10px;text-align:left">
                                                                        <h6 style="font-family:Verdana,Arial;font-weight:700;font-size:12px;margin-bottom:0px;margin-top:5px;text-transform:uppercase">
                                                                        Factura a:</h6>
                                                                        <p style="font-family:Verdana,Arial;font-weight:normal;font-size:12px;line-height:18px;margin-bottom:15px;margin-top:2px">
                                                                        <span>{{$v->nombre}}<br>
                                                                        <strong style="font-family:Verdana,Arial;font-weight:normal">Ruc:</strong> -<br>
                                                                        {{$v->direccion}}<br>
                                                                        <!--Ate<br>
                                                                        LIMA - ATE, LIMA, <br>-->
                                                                        Perú<br>
                                                                        <strong style="font-family:Verdana,Arial;font-weight:normal">T: </strong>{{$v->telefono}}
                                                                        <br>
                                                                        <a href="mailto:{{$v->email}}" target="_blank">{{$v->email}}</a></span></p>
                                                                    </td>
                                                                    <td style="font-family:Verdana,Arial;font-weight:normal;border-collapse:collapse;vertical-align:top;padding:10px 10px 0;margin:0;padding-top:10px;text-align:left">
                                                                        <h6 style="font-family:Verdana,Arial;font-weight:700;font-size:12px;margin-bottom:0px;margin-top:5px;text-transform:uppercase">
                                                                        Envío a:</h6>
                                                                        <p style="font-family:Verdana,Arial;font-weight:normal;font-size:12px;line-height:18px;margin-bottom:15px;margin-top:2px">
                                                                        <span>{{$v->nombre}}<br>
                                                                        <strong style="font-family:Verdana,Arial;font-weight:normal">Ruc:</strong> -<br>
                                                                        {{$v->direccion}}<br>
                                                                        <!--Ate<br>
                                                                        LIMA - ATE, LIMA, <br>-->
                                                                        Perú<br>
                                                                        <strong style="font-family:Verdana,Arial;font-weight:normal">T: </strong>{{$v->telefono}}
                                                                        <br>
                                                                        <a href="mailto:{{$v->email}}" target="_blank">{{$v->email}}</a></span></p>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="font-family:Verdana,Arial;font-weight:normal;border-collapse:collapse;vertical-align:top;padding:10px 10px 0;margin:0;text-align:left;padding-bottom:10px">
                                                                        <h6 style="font-family:Verdana,Arial;font-weight:700;text-align:left;font-size:12px;margin-bottom:0px;margin-top:5px;text-transform:uppercase">
                                                                        Método de envío:</h6>
                                                                        <p style="font-family:Verdana,Arial;font-weight:normal;text-align:left;font-size:12px;margin-top:2px;margin-bottom:30px;line-height:18px;padding:0">
                                                                        Despacho a domicilio SMP - Despacho a LIMA - ATE</p>
                                                                    </td>
                                                                    <td style="font-family:Verdana,Arial;font-weight:normal;border-collapse:collapse;vertical-align:top;padding:10px 10px 0;margin:0;text-align:left;padding-bottom:10px">
                                                                        <h6 style="font-family:Verdana,Arial;font-weight:700;text-align:left;font-size:12px;margin-bottom:0px;margin-top:5px;text-transform:uppercase">
                                                                        Método de pago:</h6>
                                                                        <p style="font-family:Verdana,Arial;font-weight:normal;text-align:left;font-size:12px;margin-top:2px;margin-bottom:30px;line-height:18px;padding:0">
                                                                        Transferencia Bancaria</p>
                                                                        <table style="border-collapse:collapse;padding:0;margin:0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td style="font-family:Verdana,Arial;font-weight:normal;border-collapse:collapse;vertical-align:top;padding:0;margin:0">
                                                                                    Banco: BANCO DE CREDITO<br>
                                                                                    Tipo de Cuenta: Cuenta Corriente<br>
                                                                                    Cuenta N°: xxx-xxxxxxx-x-xx<br>
                                                                                    Ruc: 20392709275<br>
                                                                                    Nombre: INDUSTRIAS ORDOÑEZ S.A.C<br>
                                                                                    E-Mail: <a href="mailto:jhoanespinoza01@gmail.com" target="_blank">jhoanespinoza01@gmail.com</a>, <a href="mailto:jhoan.espinoza@infobox-peru.com" target="_blank">jhoan.espinoza@infobox-peru.com</a><br>
                                                                                    <br>
                                                                                    Una vez completada la transferencia, envíenos su comprobante en un plazo no mayor a 2 días a <a href="mailto:jhoanespinoza01@gmail.com" target="_blank">jhoanespinoza01@gmail.com</a> y <a href="mailto:jhoan.espinoza@infobox-peru.com" target="_blank">jhoan.espinoza@infobox-peru.com</a>.<br>
                                                                                    En caso haya vencido el plazo de pago, se procederá a cancelar la compra.</td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#000" align="center" style="padding:20px 0px;font-family:Verdana,Arial;font-weight:normal;border-collapse:collapse;vertical-align:top;margin:0">

                        <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="max-width:500px;border-collapse:collapse;padding:0;margin:0">
                            <tbody>
                                <tr>
                                    <td align="center" style="font-size:12px;line-height:18px;font-family:Helvetica,Arial,sans-serif;color:#ffffff;font-weight:normal;border-collapse:collapse;vertical-align:top;padding:0;margin:0">
                                        <a href="http://www.industriasordonez.pe/" style="color:#dddddd;text-decoration:none" target="_blank">IndustriasOrdoñez</a>
                                        <span style="font-family:Arial,sans-serif;font-size:12px;color:#bbbbbb">&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                                        <a href="http://www.industriasordonez.pe/ubicacion.html" style="color:#dddddd;text-decoration:none" target="_blank">
                                        Ubicación</a> <span style="font-family:Arial,sans-serif;font-size:12px;color:#bbbbbb">
                                        &nbsp;&nbsp;|&nbsp;&nbsp;</span> <a href="http://www.industriasordonez.pe/contactenos.php" style="color:#dddddd;text-decoration:none" target="_blank">
                                        Contacto</a> <br>
                                        Todos los derechos reservados, Industrias Ordoñez 2020
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>

    </div>
    @endforeach
</body>
</html>