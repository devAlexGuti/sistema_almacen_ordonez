<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailClientes;
use Carbon\Carbon;
use App\Pedido;
use App\DetallePedido;
use App\User;
use App\Producto;
use App\estdevpedido;
use App\Codigo;
use App\Vehiculo;
use App\Persona;
use App\Despacho;
use App\Notifications\NotifyAdmin;
class PedidoController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $pedido = Pedido::join('users','pedido.idusuario','=','users.id')
            ->join('ventas','pedido.idventa','=','ventas.id')
            ->join('personas','ventas.idcliente','=','personas.id')
            ->select('pedido.id','pedido.num_pedido','pedido.dir_enviar','pedido.fecha_enviar','pedido.hora_enviar','pedido.descripcion',
            'pedido.created_at','pedido.estado','personas.nombre','users.usuario','pedido.updated_at')
            ->orderBy('pedido.id', 'desc')->paginate(10);
        }
        else{
            $pedido = Pedido::join('users','pedido.idusuario','=','users.id')
            ->join('ventas','pedido.idventa','=','ventas.id')
            ->join('personas','ventas.idcliente','=','personas.id')
            ->select('pedido.id','pedido.num_pedido','pedido.dir_enviar','pedido.fecha_enviar','pedido.hora_enviar','pedido.descripcion',
            'pedido.created_at','pedido.estado','personas.nombre','users.usuario','pedido.updated_at')
            ->where('pedido.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('pedido.id', 'desc')->paginate(10);
        }
        
        return [
            'pagination' => [
                'total'        => $pedido->total(),
                'current_page' => $pedido->currentPage(),
                'per_page'     => $pedido->perPage(),
                'last_page'    => $pedido->lastPage(),
                'from'         => $pedido->firstItem(),
                'to'           => $pedido->lastItem(),
            ],
            'pedido' => $pedido
        ];
    }
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();

            $mytime= Carbon::now('America/Lima');

            $pedido = new Pedido();
            $pedido->idcliente = $request->idcliente;
            $pedido->idusuario = \Auth::user()->id;

            $pedido->num_pedido = $request->num_pedido;
            $pedido->dir_enviar = $request->dir_enviar;
            $pedido->fecha_enviar = $request->fecha_enviar;
            $pedido->hora_enviar = $request->hora_enviar;
            $pedido->descripcion = $request->descripcion;
            $pedido->fecha_hora = $mytime;
            $pedido->total = $request->total;
            $pedido->estado = 'Pendiente';
            $pedido->save();

            $detalles = $request->data;//Array de detalles
            //Recorro todos los elementos

            foreach($detalles as $ep=>$det)
            {
                $detalle = new DetallePedido();
                $detalle->idpedido = $pedido->id;
                $detalle->idproducto = $det['idproducto'];
                $detalle->cantidad = $det['cantidad'];
                $detalle->precio = $det['precio'];
                $detalle->save();
            }
            $edp = new estdevpedido();
            $edp->idpedido = $pedido->id;
            $edp->estado = 'desactivado';
            $edp->save();          

            $fechaActual= date('Y-m-d');
            $numPedidos = DB::table('pedidos')->whereDate('created_at', $fechaActual)->count(); 
            $numCompras = DB::table('compras')->whereDate('created_at',$fechaActual)->count(); 

            $arregloDatos = [ 
            'pedidos' => [ 
                        'numero' => $numPedidos, 
                        'msj' => 'Pedidos' 
                    ], 
            'compras' => [ 
                        'numero' => $numCompras, 
                        'msj' => 'Compras' 
                    ] 
            ];                
            $allUsers = User::all();

            foreach ($allUsers as $notificar) { 
                User::findOrFail($notificar->id)->notify(new NotifyAdmin($arregloDatos)); 
            }

            DB::commit();
            return [
                'id' => $pedido->id
            ];
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $pedido = Pedido::findOrFail($request->id);
        $pedido->estado = 'Anulado';
        $pedido->save();
    }

    public function eliminar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $pedido = Pedido::findOrFail($request->id);
        $pedido->delete();
    }

    public function activarEntrega(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $pedido = Pedido::findOrFail($request->id);
        $pedido->estado = 'Entregado';
        $pedido->save();

        $despacho = new Despacho();
        $despacho->idpedido = $request->id;
        $despacho->idusuario = $request->idtransportista;
        $despacho->idvehiculo = $request->idvehiculo;
        $despacho->estado = 'Pendiente';
        $despacho->descripcion = $request->descripcion;
        $despacho->save();
    }

    public function obtenerCabecera(Request $request){
        if (!$request->ajax()) return redirect('/');

        $id = $request->id;
        $pedido = Pedido::join('users','pedido.idusuario','=','users.id')
        ->join('ventas','pedido.idventa','=','ventas.id')
        ->join('personas','ventas.idcliente','=','personas.id')
        ->select('pedido.id','pedido.num_pedido','pedido.dir_enviar','pedido.fecha_enviar','pedido.hora_enviar','pedido.descripcion',
        'pedido.created_at','pedido.estado','personas.nombre','users.usuario')
        ->where('pedido.id','=',$id)
        ->orderBy('pedido.id', 'desc')->take(1)->get();
        
        return ['pedido' => $pedido];
    }

    public function obtenerDetalles(Request $request){
        //if (!$request->ajax()) return redirect('/');

        $id = $request->id;
        $detalles = Pedido::join('ventas','pedido.idventa','=','ventas.id')
        ->join('detalle_ventas','ventas.id','=','detalle_ventas.idventa')
        ->join('productos','detalle_ventas.idproducto','=','productos.id')
        ->select('productos.nombre as producto','detalle_ventas.precio','detalle_ventas.cantidad',
        'ventas.total')
        ->where('pedido.id','=',$id)
        ->orderBy('pedido.id', 'asc')->get();
        
        return ['detalles' => $detalles];
    }
    public function cambiarEstado(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $estdevpedido = estdevpedido::findOrFail($request->idestdevpedido);
        $estdevpedido->estado = 'activado';
        $estdevpedido->save();
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $producto = Producto::findOrFail($request->idproducto);
        $producto->stock = $producto->stock + $request->cantidad_exac;
        $producto->save();

        $pedido = Pedido::findOrFail($request->idpedido);
        $pedido->total = $pedido->total - $request->total;
        $pedido->save();

        $detalle_pedido = DetallePedido::findOrFail($request->iddetalle_pedido);
        $detalle_pedido->cantidad = $request->cantidad;
        $detalle_pedido->save();

        $estdevpedido = estdevpedido::findOrFail($request->idestdevpedido);
        $estdevpedido->estado = 'desactivado';
        $estdevpedido->save();
    }

    public function pdf(Request $request,$id){
        $pedido = Pedido::join('users','pedido.idusuario','=','users.id')
        ->join('ventas','pedido.idventa','=','ventas.id')
        ->join('personas','ventas.idcliente','=','personas.id')
        ->select('pedido.id','pedido.num_pedido','pedido.dir_enviar','pedido.fecha_enviar','pedido.hora_enviar','pedido.descripcion',
        'pedido.created_at','pedido.estado','personas.nombre','personas.tipo_documento','personas.num_documento',
        'personas.direccion','personas.telefono','users.usuario','ventas.total','ventas.tipo_comprobante')
        ->where('pedido.id','=',$id)
        ->orderBy('pedido.id', 'desc')->take(1)->get();

        $detalles = Pedido::join('ventas','pedido.idventa','=','ventas.id')
        ->join('detalle_ventas','ventas.id','=','detalle_ventas.idventa')
        ->join('productos','detalle_ventas.idproducto','=','productos.id')
        ->select('productos.nombre as producto','detalle_ventas.precio','detalle_ventas.cantidad')
        ->where('pedido.id','=',$id)
        ->orderBy('pedido.id', 'asc')->get();

        $numpedido=Pedido::select('num_pedido')->where('id',$id)->get();

        $pdf = \PDF::loadView('pdf.pedido',['pedido'=>$pedido,'detalles'=>$detalles]);
        return $pdf->stream('pedido-'.$numpedido[0]->num_pedido.'.pdf');
    }

    public function pdfguia(Request $request,$id){
        
        $pedido = Pedido::join('users','pedido.idusuario','=','users.id')
        ->join('ventas','pedido.idventa','=','ventas.id')
        ->join('personas','ventas.idcliente','=','personas.id')
        ->select('pedido.id','pedido.num_pedido','pedido.dir_enviar','pedido.fecha_enviar','pedido.hora_enviar','pedido.descripcion',
        'pedido.created_at','pedido.estado','personas.nombre','personas.tipo_documento','personas.num_documento',
        'personas.direccion','personas.telefono','users.usuario','ventas.total','ventas.tipo_comprobante', 
        'ventas.serie_comprobante','ventas.num_comprobante')
        ->where('pedido.id','=',$id)
        ->orderBy('pedido.id', 'desc')->take(1)->get();

        $detalles = Pedido::join('ventas','pedido.idventa','=','ventas.id')
        ->join('detalle_ventas','ventas.id','=','detalle_ventas.idventa')
        ->join('productos','detalle_ventas.idproducto','=','productos.id')
        ->select('productos.nombre as producto','detalle_ventas.precio','detalle_ventas.cantidad')
        ->where('pedido.id','=',$id)
        ->orderBy('pedido.id', 'asc')->get();

        $despacho = Despacho::join('vehiculo','despacho.idvehiculo','=','vehiculo.id')
        ->join('personas','despacho.idusuario','=','personas.id')
        ->select('vehiculo.marca','vehiculo.placa','personas.nombre','personas.brevete','personas.num_documento')
        ->where('despacho.idpedido','=',$id)
        ->orderBy('despacho.idpedido', 'asc')->get();

        $numpedido=Pedido::select('num_pedido')->where('id',$id)->get();

        //return ['pedido' => $pedido, 'detalles'=>$detalles];
        
        $pdf = \PDF::loadView('pdf.guia',['pedido'=>$pedido,'detalles'=>$detalles,'despacho'=>$despacho]);
        return $pdf->stream('pedido-'.$numpedido[0]->num_pedido.'.pdf');
    }

    public function sendEmail(Request $request){
        if (!$request->ajax()) return redirect('/');
        $id = $request->id;

        $codigo = time().mt_rand(1,100);
        /**********REGISTRAR CODIGO***********/
        $categoria = new Codigo();
        $categoria->idpedido = $id;
        $categoria->numcodigo = $codigo;
        $categoria->condicion = '0';
        $categoria->save();

        //select p.email from pedido inner join ventas v on pedido.idventa = v.id inner join personas p on p.id = v.idcliente where pedido.id = 9
        $correo = Pedido::join('users','pedido.idusuario','=','users.id')
        ->join('ventas','pedido.idventa','=','ventas.id')
        ->join('personas','ventas.idcliente','=','personas.id')
        ->select('personas.email','pedido.id','pedido.num_pedido','pedido.dir_enviar','pedido.fecha_enviar','pedido.hora_enviar','pedido.descripcion',
        'pedido.created_at','pedido.estado','personas.nombre','personas.tipo_documento','personas.num_documento',
        'personas.direccion','personas.telefono','users.usuario','ventas.total','ventas.tipo_comprobante', 'ventas.serie_comprobante','ventas.num_comprobante',
        'ventas.created_at as fecha_venta')
        ->where('pedido.id','=',$id)
        ->orderBy('pedido.id', 'desc')->take(1)->get();

        $detallescorreo = Pedido::join('ventas','pedido.idventa','=','ventas.id')
        ->join('detalle_ventas','ventas.id','=','detalle_ventas.idventa')
        ->join('productos','detalle_ventas.idproducto','=','productos.id')
        ->select('productos.nombre as producto','detalle_ventas.precio','detalle_ventas.cantidad')
        ->where('pedido.id','=',$id)
        ->orderBy('pedido.id', 'asc')->get();
        //$nombre = "jhoanespinoza04@gmail.com";
        
        $fecha_es = self::fechaCastellano($correo[0]["fecha_venta"]);

        $data = array(
            'correo' => $correo,
            'detalles' =>$detallescorreo,
            'pedido' => $correo[0]["num_pedido"],
            'codigo' => $codigo,
            'fecha_es' => $fecha_es
        );
        
        Mail::to($correo[0]["email"])->send(new EmailClientes($data));
    }

    public function selectVehiculo(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $vehiculo = Vehiculo::select('id','marca','placa')
        ->orderBy('id', 'asc')->get();

        return ['vehiculo' => $vehiculo];
    }

    public function selectTransportista(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $transportista = User::join('personas','users.id','=','personas.id')
        ->select('users.id','users.idrol','personas.nombre','personas.num_documento')
        ->where('users.idrol','=','4')
        ->orderBy('id', 'asc')->get();

        return ['transportista' => $transportista];
    }
    
    public function fechaCastellano($fecha) {
        $fecha_cas = substr($fecha, 0, 10);
        $numeroDia = date('d', strtotime($fecha_cas));
        $dia = date('l', strtotime($fecha_cas));
        $mes = date('F', strtotime($fecha_cas));
        $anio = date('Y', strtotime($fecha_cas));
        $hora = date("g:i a",strtotime($fecha));
        $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
        $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
        $nombredia = str_replace($dias_EN, $dias_ES, $dia);
        $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
        $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
        return $nombredia." ".$numeroDia." de ".$nombreMes." de ".$anio." a las ".$hora;
    }
}
