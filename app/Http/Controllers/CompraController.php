<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Compra;
use App\DetalleCompra;
use App\User; 
use App\Notifications\NotifyAdmin;

class CompraController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $compras = Compra::join('personas','compras.idproveedor','=','personas.id')
            ->join('users','compras.idusuario','=','users.id')
            ->select('compras.id','compras.tipo_comprobante','compras.serie_comprobante',
            'compras.num_comprobante','compras.fecha_hora','compras.impuesto','compras.total',
            'compras.estado','personas.nombre','users.usuario')
            ->orderBy('compras.id', 'desc')->paginate(10);
        }
        else{
            $compras = Compra::join('personas','compras.idproveedor','=','personas.id')
            ->join('users','compras.idusuario','=','users.id')
            ->select('compras.id','compras.tipo_comprobante','compras.serie_comprobante',
            'compras.num_comprobante','compras.fecha_hora','compras.impuesto','compras.total',
            'compras.estado','personas.nombre','users.usuario')
            ->where('compras.'.$criterio, 'like', '%'. $buscar . '%')->orderBy('compras.id', 'desc')->paginate(10);
        }
        
        return [
            'pagination' => [
                'total'        => $compras->total(),
                'current_page' => $compras->currentPage(),
                'per_page'     => $compras->perPage(),
                'last_page'    => $compras->lastPage(),
                'from'         => $compras->firstItem(),
                'to'           => $compras->lastItem(),
            ],
            'compras' => $compras
        ];
    }
    public function obtenerCabecera(Request $request){
        if (!$request->ajax()) return redirect('/');

        $id = $request->id;
        $compra = Compra::join('personas','compras.idproveedor','=','personas.id')
        ->join('users','compras.idusuario','=','users.id')
        ->select('compras.id','compras.tipo_comprobante','compras.serie_comprobante',
        'compras.num_comprobante','compras.fecha_hora','compras.impuesto','compras.total',
        'compras.estado','personas.nombre','users.usuario')
        ->where('compras.id','=',$id)
        ->orderBy('compras.id', 'asc')->take(1)->get();
        
        return ['compra' => $compra];
    }
    public function obtenerDetalles(Request $request){
        if (!$request->ajax()) return redirect('/');

        $id = $request->id;
        $detalles = DetalleCompra::join('productos','detalle_compras.idproducto','=','productos.id')
        ->select('detalle_compras.cantidad','detalle_compras.precio','productos.nombre as producto')
        ->where('detalle_compras.idcompra','=',$id)
        ->orderBy('detalle_compras.id', 'asc')->get();
        
        return ['detalles' => $detalles];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();

            $mytime= Carbon::now('America/Lima');

            $compra = new Compra();
            $compra->idproveedor = $request->idproveedor;
            $compra->idusuario = \Auth::user()->id;
            $compra->tipo_comprobante = $request->tipo_comprobante;
            $compra->serie_comprobante = $request->serie_comprobante;
            $compra->num_comprobante = $request->num_comprobante;
            $compra->fecha_hora = $mytime;
            $compra->impuesto = $request->impuesto;
            $compra->total = $request->total;
            $compra->estado = 'Registrado';
            $compra->save();

            $detalles = $request->data;//Array de detalles
            //Recorro todos los elementos

            foreach($detalles as $ep=>$det)
            {
                $detalle = new DetalleCompra();
                $detalle->idcompra = $compra->id;
                $detalle->idproducto = $det['idproducto'];
                $detalle->cantidad = $det['cantidad'];
                $detalle->precio = $det['precio'];          
                $detalle->save();
            }          

            $fechaActual= date('Y-m-d');
            $numVentas = DB::table('ventas')->whereDate('created_at', $fechaActual)->count(); 
            $numCompras = DB::table('compras')->whereDate('created_at',$fechaActual)->count(); 

            $arregloDatos = [ 
            'ventas' => [ 
                        'numero' => $numVentas, 
                        'msj' => 'ventas' 
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
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function desactivar(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
        $compra = Compra::findOrFail($request->id);
        $compra->estado = 'Anulado';
        $compra->save();
    }
}
