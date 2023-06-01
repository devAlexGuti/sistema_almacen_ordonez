<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Producto;
use App\Categoria;
use App\Compra;
use App\Venta;
use App\DetalleVenta;
use App\DetalleCompra;
use App\EntregasTiempoPreTest;
use App\EntregaPerfectaPreTest;

class DashboardController extends Controller
{
    
    public function __invoke(Request $request)
    {
        
        //$anio=date('Y');
        $anio='2020';
        $compras=DB::table('compras as i')
        ->select(DB::raw('MONTHNAME(i.fecha_hora) as mes'),
        DB::raw('YEAR(i.fecha_hora) as anio'),
        DB::raw('SUM(i.total) as total'))
        ->whereYear('i.fecha_hora',$anio)
        ->where('i.estado','Registrado')
        ->groupBy(DB::raw('MONTHNAME(i.fecha_hora)'),DB::raw('YEAR(i.fecha_hora)'))
        ->orderBy(DB::raw('MONTHNAME(i.fecha_hora)', 'desc limit 12'))
        ->get();

        $ventas=DB::table('ventas as v')
        ->select(DB::raw('MONTHNAME(v.fecha_hora) as mes'),
        DB::raw('YEAR(v.fecha_hora) as anio'),
        DB::raw('SUM(v.total) as total'))
        ->whereYear('v.fecha_hora',$anio)
        ->where('v.estado','Registrado')
        ->groupBy(DB::raw('MONTHNAME(v.fecha_hora)'),DB::raw('YEAR(v.fecha_hora)'))
        ->orderBy(DB::raw('MONTHNAME(v.fecha_hora)', 'desc limit 12'))
        ->get();
 

        return ['compras'=>$compras,'ventas'=>$ventas,'anio'=>$anio];      

    }

    public function reporteIndicador1(Request $request){
        $mes=date('Y-M');

        $indicador1_pretest = EntregaPerfectaPreTest::select('entrega_perfecta_pretest.id',
        'entrega_perfecta_pretest.item',DB::raw('DATE_FORMAT(entrega_perfecta_pretest.fecha_consulta, "%d-%m-%Y") as dia'),
        'entrega_perfecta_pretest.ped_ep','entrega_perfecta_pretest.tot_pe','entrega_perfecta_pretest.entrega_perfecta_pretest')
        ->orderBy('entrega_perfecta_pretest.item', 'asc')->get();

        $cont=COUNT($indicador1_pretest);

        return['indicador1_pretest'=>$indicador1_pretest,'cont'=>$cont];
    }

    public function reporteIndicador1_postest(Request $request){
        $mes=date('Y-M');

        $indicador1_postest=DB::table('pedido as p')
        ->select(
        DB::raw('DATE_FORMAT(p.created_at, "%Y-%m-%d") as dia'),
        DB::raw('COUNT(IF(p.estado="Pendiente" OR p.estado="Entregado",p.id,null)) AS cont_ntdr'),
        DB::raw('COUNT(IF(p.updated_at < concat_ws(" ",p.fecha_enviar, p.hora_enviar) AND p.estado="Entregado",p.id,null)) AS cont_ndct'),
        DB::raw('round((COUNT(IF(p.updated_at < concat_ws(" ",p.fecha_enviar, p.hora_enviar) AND p.estado="Entregado",p.id,null))/COUNT(IF(p.estado="Pendiente" OR p.estado="Entregado",p.id,null)))*100,2) as nivel_cumplimiento_despachos_postest'))
        ->groupBy(DB::raw('DATE_FORMAT(p.created_at, "%Y-%m-%d")'))
        ->orderBy(DB::raw('DATE_FORMAT(p.created_at, "%Y-%m-%d")','asc'))
        ->get();

        $cont=count($indicador1_postest);

        return['indicador1_postest'=>$indicador1_postest,'cont'=>$cont];
    }
    public function reporteIndicador2(Request $request){

        $indicador2_pretest = EntregasTiempoPreTest::select('entrega_tiempo_pretest.id',
        'entrega_tiempo_pretest.item',DB::raw('DATE_FORMAT(entrega_tiempo_pretest.fecha_consulta, "%d-%m-%Y") as dia'),
        'entrega_tiempo_pretest.ped_et','entrega_tiempo_pretest.tot_pe','entrega_tiempo_pretest.entrega_tiempo_pretest')
        ->orderBy('entrega_tiempo_pretest.item', 'asc')->get();

        $cont=COUNT($indicador2_pretest);

        return['indicador2_pretest'=>$indicador2_pretest,'cont'=>$cont];
    }

    public function reporteIndicador2_postest(Request $request){
        $mes=date('Y-M');

        $indicador2_postest=DB::table('pedido as p')
        ->select(
        DB::raw('DATE_FORMAT(p.created_at, "%Y-%m-%d") as dia'),
        DB::raw('COUNT(*) AS cont_tpe'),
        DB::raw('COUNT(IF(p.updated_at < concat_ws(" ",p.fecha_enviar, p.hora_enviar),p.id,null)) AS cont_tpet'),
        DB::raw('round((COUNT(IF(p.updated_at < concat_ws(" ",p.fecha_enviar, p.hora_enviar),p.id,null))/COUNT(*))*100,2) as entregastiempo_postest'))
        ->where('p.estado','Entregado')
        ->groupBy(DB::raw('DATE_FORMAT(p.created_at, "%Y-%m-%d")'))
        ->orderBy(DB::raw('DATE_FORMAT(p.created_at, "%Y-%m-%d")','asc'))
        ->get();

        $cont=count($indicador2_postest);

        return['indicador2_postest'=>$indicador2_postest,'cont'=>$cont];
    }
    

    public function obtenerDatos(Request $request){
        $date= Carbon::now('America/Lima');
        //$date = $date->toDateTimeString();
        $date = $date->format('Y-m-d');
        //$date = $date->format('Y-m-d');
        /*$mytime->toDateTimeString();
        $totales=DB::table('compras as i')
        ->select(DB::raw('SUM(i.total) as total'))
        ->whereDate('i.fecha_hora',$mytime)
        ->where('i.estado','Registrado')
        ->get();*/
        
        $totales=DB::select("SELECT 
        (select ifnull(sum(i.total),0) from compras i where DATE(i.fecha_hora)='$date' and i.estado='Registrado') as totalcompra, 
        (select ifnull(sum(v.total),0) from ventas v where DATE(v.fecha_hora)='$date' and v.estado='Registrado') as totalventa,
        (select IFNULL(COUNT(*), 0) from personas p where p.tipo_persona='Cliente') as totalclientes,
        (select IFNULL(COUNT(*), 0) from productos pr) as totalproductos");
        
        

        return ['totales'=>$totales]; 
    }

    public function productosVendidos(Request $request){
        $productosvendidos=DB::select('SELECT a.nombre as producto,sum(dv.cantidad) as cantidad from productos a 
        inner join detalle_ventas dv on a.id=dv.idproducto inner join ventas v 
        on dv.idventa=v.id where (v.estado="Registrado") and (year(v.fecha_hora)=2019 or year(v.fecha_hora)=year(curdate()))
        group by a.nombre order by sum(dv.cantidad) desc limit 10');

        return ['productosvendidos'=>$productosvendidos];
    }

    public function ventasDia(Request $request){
        $ventasdia=DB::select('SELECT DATE_FORMAT(v.fecha_hora,"%d-%m-%Y") as dia, sum(v.total) as totaldia from ventas v 
        where v.estado="Registrado" group by v.fecha_hora order by day(v.fecha_hora) desc limit 18');
        /* */
        return['ventasdia'=>$ventasdia];
    }

    public function clientesCompradores(Request $request){
        $clientescompradores=DB::select('SELECT p.nombre as nombre_producto, sum(v.total) as total_venta FROM ventas v 
        INNER JOIN personas p ON p.id=v.idcliente GROUP BY p.nombre ORDER BY sum(v.total) desc limit 10');

        return ['clientescompradores'=>$clientescompradores];
    }
    
   
}
