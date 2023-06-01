<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EntregaPerfectaPosTestController extends Controller
{
    public function index(Request $request){
        if (!$request->ajax()) return redirect('/');    

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        if($buscar==''){
            $entrega=DB::table('entrega as e')
            ->select(
            DB::raw('DATE_FORMAT(e.created_at, "%Y-%m-%d") as dia'),
            DB::raw('COUNT(*) AS cont_tpe'),
            DB::raw('COUNT(IF(e.PEP = "si",e.id,null)) AS cont_pep'))
            ->where('e.estado','Entregado')
            ->groupBy(DB::raw('DATE_FORMAT(e.created_at, "%Y-%m-%d")'))
            ->orderBy(DB::raw('DATE_FORMAT(e.created_at, "%Y-%m-%d")','asc'))
            ->paginate(10);
        }
        else{
            $entrega=DB::table('entrega as e')
            ->select(
            DB::raw('DATE_FORMAT(e.created_at, "%Y-%m-%d") as dia'),
            DB::raw('COUNT(*) AS cont_tpe'),
            DB::raw('COUNT(IF(e.PEP = "si",e.id,null)) AS cont_pep'))
            ->where('e.estado','Entregado')
            ->where('e.'.$criterio, 'like', '%'. $buscar . '%')
            ->groupBy(DB::raw('DATE_FORMAT(e.created_at, "%Y-%m-%d")'))
            ->orderBy(DB::raw('DATE_FORMAT(e.created_at, "%Y-%m-%d")','asc'))
            ->paginate(10);
        }

        return [
            'pagination' => [
                'total'        => $entrega->total(),
                'current_page' => $entrega->currentPage(),
                'per_page'     => $entrega->perPage(),
                'last_page'    => $entrega->lastPage(),
                'from'         => $entrega->firstItem(),
                'to'           => $entrega->lastItem(),
            ],
            'entrega' => $entrega
        ];
    }

    public function reporteIndicador1(){
        $i1=DB::table('entrega as e')
        ->select(
        DB::raw('DATE_FORMAT(e.created_at, "%Y-%m-%d") as dia'),
        DB::raw('COUNT(*) AS cont_tpe'),
        DB::raw('COUNT(IF(e.PEP = "si",e.id,null)) AS cont_pep'))
        ->where('e.estado','Entregado')
        ->groupBy(DB::raw('DATE_FORMAT(e.created_at, "%Y-%m-%d")'))
        ->orderBy(DB::raw('DATE_FORMAT(e.created_at, "%Y-%m-%d")','asc'))->get();

        $cont=count($i1);
        $pdf = \PDF::loadView('pdf.reporteEntregaPerfectaPosTest',['i1'=>$i1,'cont'=>$cont]);
        return $pdf->stream('reporteEntregaPerfectaPosTest.pdf');

        //return ['indicador 1' => $i1];
    }
}
