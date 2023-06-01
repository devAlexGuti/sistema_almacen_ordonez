<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EntregasTiempoPreTest;

class EntregasTiempoPreTestController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $entregas_tiempo_pretest = EntregasTiempoPreTest::select('entrega_tiempo_pretest.id',
            'entrega_tiempo_pretest.item','entrega_tiempo_pretest.fecha_consulta',
            'entrega_tiempo_pretest.ped_et','entrega_tiempo_pretest.tot_pe','entrega_tiempo_pretest.entrega_tiempo_pretest')
            ->orderBy('entrega_tiempo_pretest.item', 'asc')->paginate(10);
        }
        else{
            $entregas_tiempo_pretest = EntregasTiempoPreTest::select('entrega_tiempo_pretest.id',
            'entrega_tiempo_pretest.item','entrega_tiempo_pretest.fecha_consulta',
            'entrega_tiempo_pretest.ped_et','entrega_tiempo_pretest.tot_pe','entrega_tiempo_pretest.entrega_tiempo_pretest')
            ->where('entrega_tiempo_pretest.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('entrega_tiempo_pretest.item', 'asc')->paginate(10);
        }
        

        return [
            'pagination' => [
                'total'        => $entregas_tiempo_pretest->total(),
                'current_page' => $entregas_tiempo_pretest->currentPage(),
                'per_page'     => $entregas_tiempo_pretest->perPage(),
                'last_page'    => $entregas_tiempo_pretest->lastPage(),
                'from'         => $entregas_tiempo_pretest->firstItem(),
                'to'           => $entregas_tiempo_pretest->lastItem(),
            ],
            'entregas_tiempo_pretest' => $entregas_tiempo_pretest
        ];
    }
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $entregas_tiempo_pretest = new EntregasTiempoPreTest();
        $entregas_tiempo_pretest->item = $request->item;
        $entregas_tiempo_pretest->fecha_consulta = $request->fecha_consulta;
        $entregas_tiempo_pretest->ped_et = $request->ped_et;
        $entregas_tiempo_pretest->tot_pe = $request->tot_pe;
        $entregas_tiempo_pretest->entrega_tiempo_pretest = $request->entregas_tiempo_pretest;
        $entregas_tiempo_pretest->save();
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $entregas_tiempo_pretest = EntregasTiempoPreTest::findOrFail($request->id);
        $entregas_tiempo_pretest->item = $request->item;
        $entregas_tiempo_pretest->fecha_consulta = $request->fecha_consulta;
        $entregas_tiempo_pretest->ped_et = $request->ped_et;
        $entregas_tiempo_pretest->tot_pe = $request->tot_pe;
        $entregas_tiempo_pretest->entrega_tiempo_pretest = $request->entregas_tiempo_pretest;
        $entregas_tiempo_pretest->save();
    }

    public function eliminar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $entregas_tiempo_pretest = EntregasTiempoPreTest::findOrFail($request->id);
        $entregas_tiempo_pretest->delete();
    }

    public function reporteIndicador2(){
        $entregas_tiempo_pretest = EntregasTiempoPreTest::select('entrega_tiempo_pretest.id',
        'entrega_tiempo_pretest.item','entrega_tiempo_pretest.fecha_consulta',
        'entrega_tiempo_pretest.ped_et','entrega_tiempo_pretest.tot_pe','entrega_tiempo_pretest.entrega_tiempo_pretest')
        ->orderBy('entrega_tiempo_pretest.item', 'asc')->get();

        $cont=COUNT($entregas_tiempo_pretest);

        $pdf = \PDF::loadView('pdf.reporteIndicador2PreTest',['entregas_tiempo_pretest'=>$entregas_tiempo_pretest,'cont'=>$cont]);
        return $pdf->stream('reporteIndicador2PreTest.pdf');
    }
}
