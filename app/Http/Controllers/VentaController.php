<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Venta;
use App\Pedido;
use App\DetalleVenta;
use App\User;
use App\Notifications\NotifyAdmin;

class VentaController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $ventas = Venta::join('personas','ventas.idcliente','=','personas.id')
            ->join('users','ventas.idusuario','=','users.id')
            ->select('ventas.id','ventas.tipo_comprobante','ventas.serie_comprobante',
            'ventas.num_comprobante','ventas.fecha_hora','ventas.impuesto','ventas.total',
            'ventas.estado','personas.nombre','users.usuario')
            ->orderBy('ventas.id', 'desc')->paginate(10);
        }
        else{
            $ventas = Venta::join('personas','ventas.idcliente','=','personas.id')
            ->join('users','ventas.idusuario','=','users.id')
            ->select('ventas.id','ventas.tipo_comprobante','ventas.serie_comprobante',
            'ventas.num_comprobante','ventas.fecha_hora','ventas.impuesto','ventas.total',
            'ventas.estado','personas.nombre','users.usuario')
            ->where('ventas.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('ventas.id', 'desc')->paginate(10);
        }
        
        return [
            'pagination' => [
                'total'        => $ventas->total(),
                'current_page' => $ventas->currentPage(),
                'per_page'     => $ventas->perPage(),
                'last_page'    => $ventas->lastPage(),
                'from'         => $ventas->firstItem(),
                'to'           => $ventas->lastItem(),
            ],
            'ventas' => $ventas
        ];
    }
    public function obtenerCabecera(Request $request){
        if (!$request->ajax()) return redirect('/');

        $id = $request->id;
        $venta = Venta::join('personas','ventas.idcliente','=','personas.id')
        ->join('users','ventas.idusuario','=','users.id')
        ->select('ventas.id','ventas.tipo_comprobante','ventas.serie_comprobante',
        'ventas.num_comprobante','ventas.fecha_hora','ventas.impuesto','ventas.total',
        'ventas.estado','personas.nombre','users.usuario')
        ->where('ventas.id','=',$id)
        ->orderBy('ventas.id', 'desc')->take(1)->get();
        
        return ['venta' => $venta];
    }
    public function obtenerDetalles(Request $request){
        if (!$request->ajax()) return redirect('/');

        $id = $request->id;
        $detalles = DetalleVenta::join('productos','detalle_ventas.idproducto','=','productos.id')
        ->select('detalle_ventas.cantidad','detalle_ventas.precio','detalle_ventas.descuento',
        'productos.nombre as producto')
        ->where('detalle_ventas.idventa','=',$id)
        ->orderBy('detalle_ventas.id', 'asc')->get();
        
        return ['detalles' => $detalles];
    }
    public function obtenerNumComprobante(request $request){

        //if (!$request->ajax()) return redirect('/');

        $numventa1=DB::table('ventas as v')
        ->select(DB::raw('v.num_comprobante'))
        ->where('v.tipo_comprobante', '=', 'BOLETA DE VENTA')
        ->get();

        $numventa2=DB::table('ventas as v')
        ->select(DB::raw('v.num_comprobante'))
        ->where('v.tipo_comprobante', '=', 'FACTURA')
        ->get();

        $numventa3=DB::table('ventas as v')
        ->select(DB::raw('v.num_comprobante'))
        ->where('v.tipo_comprobante', '=', 'GUIA DE REMISION')
        ->get();

        //Para BOLETAS
        $ultimoAgregado1 = $numventa1->last();
        if(is_null($ultimoAgregado1)){
            $ultimoAgregadoNum1 = "BOLETA VACIA";
        }
        else{
            $ultimoAgregadoNum1 = $ultimoAgregado1->num_comprobante+1;
        
            if($ultimoAgregadoNum1<=9){
                $ultimoAgregadoNum1= "0000".$ultimoAgregadoNum1;
            }
            elseif($ultimoAgregadoNum1<=99){
                $ultimoAgregadoNum1= "000".$ultimoAgregadoNum1;
            }
            elseif($ultimoAgregadoNum1<=999){
                $ultimoAgregadoNum1= "00".$ultimoAgregadoNum1;
            }
            elseif($ultimoAgregadoNum1<=9999){
                $ultimoAgregadoNum1= "0".$ultimoAgregadoNum1;
            }
        }
        //Para FACTURAS
        $ultimoAgregado2 = $numventa2->last();
        if(is_null($ultimoAgregado2)){
            $ultimoAgregadoNum2 = "FACTURA VACIA";
        }
        else{
            $ultimoAgregadoNum2 = $ultimoAgregado2->num_comprobante+1;

            if($ultimoAgregadoNum2<=9){
                $ultimoAgregadoNum2= "0000".$ultimoAgregadoNum2;
            }
            elseif($ultimoAgregadoNum2<=99){
                $ultimoAgregadoNum2= "000".$ultimoAgregadoNum2;
            }
            elseif($ultimoAgregadoNum2<=999){
                $ultimoAgregadoNum2= "00".$ultimoAgregadoNum2;
            }
            elseif($ultimoAgregadoNum2<=9999){
                $ultimoAgregadoNum2= "0".$ultimoAgregadoNum2;
            }
        }

        //Para GUIA DE REMISION
        $ultimoAgregado3 = $numventa3->last();
        if(is_null($ultimoAgregado3)){
            $ultimoAgregadoNum3 = "GUIA DE REMISION VACIA";
        }
        else{
            $ultimoAgregadoNum3 = $ultimoAgregado3->num_comprobante+1;

            if($ultimoAgregadoNum3<=9){
                $ultimoAgregadoNum3= "0000".$ultimoAgregadoNum3;
            }
            elseif($ultimoAgregadoNum3<=99){
                $ultimoAgregadoNum3= "000".$ultimoAgregadoNum3;
            }
            elseif($ultimoAgregadoNum3<=999){
                $ultimoAgregadoNum3= "00".$ultimoAgregadoNum3;
            }
            elseif($ultimoAgregadoNum3<=9999){
                $ultimoAgregadoNum3= "0".$ultimoAgregadoNum3;
            }
        }

        return ['ventas'=>[['numboletas'=>$ultimoAgregadoNum1,'numfacturas'=>$ultimoAgregadoNum2, 'numguia'=>$ultimoAgregadoNum3]
        ]];

        //OPCION DOS CON SUMA
        /*$ventas=DB::table('ventas as v')
        ->select(
        DB::raw('SUM(v.tipo_comprobante = "BOLETA DE VENTA")+1 as numboletas'),
        DB::raw('SUM(v.tipo_comprobante = "BOLETA DE VENTA")+1 as numboletas'),
        DB::raw('SUM(v.tipo_comprobante = "FACTURA")+1 as numfacturas'))
        ->get();

        $cont=Venta::count();
        return['ventas'=>$ventas,'cont'=>$cont];*/
    }
    public function pdf(Request $request,$id){
        $venta = Venta::join('personas','ventas.idcliente','=','personas.id')
        ->join('users','ventas.idusuario','=','users.id')
        ->join('pedido','ventas.id','=','pedido.idventa')
        ->select('ventas.id','ventas.tipo_comprobante','ventas.serie_comprobante',
        'ventas.num_comprobante','ventas.created_at','ventas.impuesto','ventas.total',
        'ventas.estado','personas.nombre','personas.tipo_documento','personas.num_documento',
        'personas.direccion','personas.email','personas.telefono','users.usuario',
        'pedido.dir_enviar','pedido.fecha_enviar','pedido.hora_enviar')
        ->where('ventas.id','=',$id)
        ->orderBy('ventas.id', 'desc')->take(1)->get();

        $detalles = DetalleVenta::join('productos','detalle_ventas.idproducto','=','productos.id')
        ->select('detalle_ventas.cantidad','detalle_ventas.precio','detalle_ventas.descuento',
        'productos.nombre as producto')
        ->where('detalle_ventas.idventa','=',$id)
        ->orderBy('detalle_ventas.id', 'asc')->get();

        $numventa=Venta::select('num_comprobante')->where('id',$id)->get();

        $pdf = \PDF::loadView('pdf.venta',['venta'=>$venta,'detalles'=>$detalles]);
        return $pdf->stream('venta-'.$numventa[0]->num_comprobante.'.pdf');
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();

            $mytime= Carbon::now('America/Lima');

            $venta = new Venta();
            $venta->idcliente = $request->idcliente;
            $venta->idusuario = \Auth::user()->id;
            $venta->tipo_comprobante = $request->tipo_comprobante;
            $venta->serie_comprobante = $request->serie_comprobante;
            $venta->num_comprobante = $request->num_comprobante;
            $venta->fecha_hora = $mytime;
            $venta->impuesto = $request->impuesto;
            $venta->total = $request->total;
            $venta->estado = 'Registrado';
            $venta->save();

            $detalles = $request->data;//Array de detalles
            //Recorro todos los elementos

            foreach($detalles as $ep=>$det)
            {
                $detalle = new DetalleVenta();
                $detalle->idventa = $venta->id;
                $detalle->idproducto = $det['idproducto'];
                $detalle->cantidad = $det['cantidad'];
                $detalle->precio = $det['precio'];
                $detalle->descuento = $det['descuento'];         
                $detalle->save();
            }
            if($request->tipo_comprobante == 'FACTURA'){
                $vart = 'PF-';
            }elseif($request->tipo_comprobante == 'BOLETA DE VENTA'){
                $vart = 'PB-';
            }
            elseif($request->tipo_comprobante == 'GUIA DE REMISION'){
                $vart = 'PG-';
            }
            //Registrar tabla pedido
            $pedido = new Pedido();
            $pedido->idventa = $venta->id;
            $pedido->idusuario = \Auth::user()->id;
            //$pedido->num_pedido = $vart.$request->num_comprobante;
            /*====================OBTENER EL ULTIMO NUMERO DE PEDIDO================================*/
            $obnumpedido=DB::table('pedido as p')
            ->select(DB::raw('p.num_pedido'))
            ->get();

            $ultimoAgregado = $obnumpedido->last();
            if(is_null($ultimoAgregado)){
                $ultimoAgregadoNum = "00001";
            }
            else{
                $ultimoAgregadoNum = $ultimoAgregado->num_pedido+1;

                if($ultimoAgregadoNum<=9){
                    $ultimoAgregadoNum= "0000".$ultimoAgregadoNum;
                }
                elseif($ultimoAgregadoNum<=99){
                    $ultimoAgregadoNum= "000".$ultimoAgregadoNum;
                }
                elseif($ultimoAgregadoNum<=999){
                    $ultimoAgregadoNum= "00".$ultimoAgregadoNum;
                }
                elseif($ultimoAgregadoNum<=9999){
                    $ultimoAgregadoNum= "0".$ultimoAgregadoNum;
                }
            }
            $pedido->num_pedido = $ultimoAgregadoNum;
            $pedido->dir_enviar = $request->dir_enviar;
            $pedido->fecha_enviar = $request->fecha_enviar;
            $pedido->hora_enviar = $request->hora_enviar;
            $pedido->descripcion = $request->descripcion;
            $pedido->estado = 'Pendiente';
            $pedido->save();

            $fechaActual= date('Y-m-d');
            $numVentas = DB::table('ventas')->whereDate('created_at', $fechaActual)->count(); 
            $numCompras = DB::table('compras')->whereDate('created_at',$fechaActual)->count(); 

            $arregloDatos = [ 
            'ventas' => [ 
                        'numero' => $numVentas, 
                        'msj' => 'Ventas' 
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
                'id' => $venta->id
            ];
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $venta = Venta::findOrFail($request->id);
        $venta->estado = 'Anulado';
        $venta->save();

        $pedido = Pedido::where('idventa', $request->id)->firstOrFail();
        $pedido->estado = 'Anulado';
        $pedido->save();        
    }
}
