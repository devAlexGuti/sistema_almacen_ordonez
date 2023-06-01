<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Entrega;

class EntregasTiempoPosTestController extends Controller
{
    public function index(Request $request){
        if (!$request->ajax()) return redirect('/');    

        $buscar = $request->buscar;
        $criterio = $request->criterio;


        if($buscar==''){
            $pedidos=Entrega::join('despacho','entrega.iddespacho','=','despacho.id')
            ->join('pedido','despacho.idpedido','=','pedido.id')
            ->select(
            DB::raw('DATE_FORMAT(pedido.created_at, "%Y-%m-%d") as dia_registro_ped'),
            DB::raw('COUNT(IF(entrega.updated_at < concat_ws(" ",pedido.fecha_enviar, pedido.hora_enviar),pedido.id,null)) AS cont_tpet'),
            DB::raw('COUNT(*) AS cont_tpe'))
            ->where('entrega.estado','Entregado')
            ->groupBy(DB::raw('DATE_FORMAT(entrega.created_at, "%Y-%m-%d")'))
            ->orderBy(DB::raw('DATE_FORMAT(entrega.created_at, "%Y-%m-%d")','asc'))
            ->paginate(10);
        }
        else{
            $pedidos=Entrega::join('despacho','entrega.iddespacho','=','despacho.id')
            ->join('pedido','despacho.idpedido','=','pedido.id')
            ->select(
            DB::raw('DATE_FORMAT(pedido.created_at, "%Y-%m-%d") as dia_registro_ped'),
            DB::raw('COUNT(IF(entrega.updated_at < concat_ws(" ",pedido.fecha_enviar, pedido.hora_enviar),pedido.id,null)) AS cont_tpet'),
            DB::raw('COUNT(*) AS cont_tpe'))
            ->where('entrega.estado','Entregado')
            ->where('entrega.'.$criterio, 'like', '%'. $buscar . '%')
            ->groupBy(DB::raw('DATE_FORMAT(entrega.created_at, "%Y-%m-%d")'))
            ->orderBy(DB::raw('DATE_FORMAT(entrega.created_at, "%Y-%m-%d")','asc'))
            ->paginate(10);
        }

        return [
            'pagination' => [
                'total'        => $pedidos->total(),
                'current_page' => $pedidos->currentPage(),
                'per_page'     => $pedidos->perPage(),
                'last_page'    => $pedidos->lastPage(),
                'from'         => $pedidos->firstItem(),
                'to'           => $pedidos->lastItem(),
            ],
            'pedidos' => $pedidos
        ];
    }



    public function reporteIndicador2(){
        $i2=Entrega::join('despacho','entrega.iddespacho','=','despacho.id')
        ->join('pedido','despacho.idpedido','=','pedido.id')
        ->select(
        DB::raw('DATE_FORMAT(entrega.created_at, "%Y-%m-%d") as dia_registro_ent'),
        DB::raw('COUNT(IF(entrega.updated_at < concat_ws(" ",pedido.fecha_enviar, pedido.hora_enviar),pedido.id,null)) AS cont_tpet'),
        DB::raw('COUNT(*) AS cont_tpe'))
        ->where('entrega.estado','Entregado')
        ->groupBy(DB::raw('DATE_FORMAT(entrega.created_at, "%Y-%m-%d")'))
        ->orderBy(DB::raw('DATE_FORMAT(entrega.created_at, "%Y-%m-%d")','asc'))->get();

        $cont=count($i2);
        $pdf = \PDF::loadView('pdf.reporteEntregasTiempoPosTest',['i2'=>$i2,'cont'=>$cont]);
        return $pdf->stream('reporteEntregasTiempoPosTest.pdf');
    }
}
