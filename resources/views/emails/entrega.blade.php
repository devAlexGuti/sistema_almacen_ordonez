<!-- lenguaje de etiquetado cuando te llega al correo del cliente -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body style="margin:0; padding:0; background-color:#F2F2F2;">
@foreach ($msg['correo'] as $e)
  <div class="">
  <!---<div class="aHl"></div>
  <div id=":1b5" tabindex="-1"></div>-->

  <div id=":1a2" class="ii gt">
  
  <div id=":1a3" class="a3s aXjCH ">
  
  <p>Este correo fue enviado por "Industrias Ordoñez" por el Indicador Entregas Perfectas.</p>

  <p>Nuestro cliente {{$e->nombre}} con número de identificación {{$e->num_documento}}.</p>

  <p>Alerta generada el {{$msg['fecha']}} a las {{$msg['hora']}}.</p>

  <p>Cliente no está conforme con la entrega de su pedido Nº: {{$e->num_pedido}}</p>


  <p>Problemas Criticos:</p>
  <p>* {{$msg['motivo']}}</p>

    <p>NOTA: Revisa el caso cuidadosamente lo más antes posible, ten en cuenta lo siguiente:</p>
    
    <ul>
      <li>Revisar desde el módulo de ventas, fijar la fecha y hora de envió.</li>
      <li>Revisar el lugar o sitio de entrega.</li>
      <li>Si la entrega de pedido fue a otro país.</li>
      <li>Tomar nota del usuario que registró la venta.</li>
      <li>Revisar el módulo de pedido, despacho.</li>
      <li>Tomar nota del usuario del almacén que gestionó el pedido.</li>
      <li>Tomar nota del transportista que llevó el pedido.</li>
      <li>Tomar nota de los estados, si están en entregado.</li>
      <li>De acuerdo a lo analizado, y si hay responsables, conversarlo con ellos y enviar notificación a los superiores.</li>
      <li>Finalmente, comunicarse con el cliente inmediatamente, ofreciendole las disculpas del caso, y solucionar el inconveniente lo antes posible.</li>
    </ul>

    <p>Para ingresar al sistema y realizar el seguimiento, hacer click al siguiente enlace:<br><a href="http://oindustrias.com" target="_blank"> http://oindustrias.com</a></p>

  <p>no lográ ver este correo? <a href="mailto:alexfus8@gmail.com">Click aquí</a> para envíar un correo al equipo de soporte.</p>
  <!--<div class="yj6qo"></div>
  
  <div class="adL"></div>-->

  </div>
  </div>
  <!--<div id=":1ba" class="ii gt" style="display:none"><div id=":1b9" class="a3s aXjCH undefined"></div></div><div class="hi"></div></div>-->
@endforeach
</body>
</html>