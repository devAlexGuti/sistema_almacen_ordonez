<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EntregaPerfectaPreTest;

class EntregaPerfectaPreTestController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $entrega_perfecta_pretest = EntregaPerfectaPreTest::select('entrega_perfecta_pretest.id',
            'entrega_perfecta_pretest.item','entrega_perfecta_pretest.fecha_consulta',
            'entrega_perfecta_pretest.ped_ep','entrega_perfecta_pretest.tot_pe','entrega_perfecta_pretest.entrega_perfecta_pretest')
            ->orderBy('entrega_perfecta_pretest.item', 'asc')->paginate(10);
        }
        else{
            $entrega_perfecta_pretest = EntregaPerfectaPreTest::select('entrega_perfecta_pretest.id',
            'entrega_perfecta_pretest.item','entrega_perfecta_pretest.fecha_consulta',
            'entrega_perfecta_pretest.ped_ep','entrega_perfecta_pretest.tot_pe','entrega_perfecta_pretest.entrega_perfecta_pretest')
            ->where('entrega_perfecta_pretest.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('entrega_perfecta_pretest.item', 'asc')->paginate(10);
        }
        

        return [
            'pagination' => [
                'total'        => $entrega_perfecta_pretest->total(),
                'current_page' => $entrega_perfecta_pretest->currentPage(),
                'per_page'     => $entrega_perfecta_pretest->perPage(),
                'last_page'    => $entrega_perfecta_pretest->lastPage(),
                'from'         => $entrega_perfecta_pretest->firstItem(),
                'to'           => $entrega_perfecta_pretest->lastItem(),
            ],
            'entrega_perfecta_pretest' => $entrega_perfecta_pretest
        ];
    }
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $entrega_perfecta_pretest = new EntregaPerfectaPreTest();
        $entrega_perfecta_pretest->item = $request->item;
        $entrega_perfecta_pretest->fecha_consulta = $request->fecha_consulta;
        $entrega_perfecta_pretest->ped_ep = $request->ped_ep;
        $entrega_perfecta_pretest->tot_pe = $request->tot_pe;
        $entrega_perfecta_pretest->entrega_perfecta_pretest = $request->entrega_perfecta_pretest;
        $entrega_perfecta_pretest->save();
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $entrega_perfecta_pretest = EntregaPerfectaPreTest::findOrFail($request->id);
        $entrega_perfecta_pretest->item = $request->item;
        $entrega_perfecta_pretest->fecha_consulta = $request->fecha_consulta;
        $entrega_perfecta_pretest->ped_ep = $request->ped_ep;
        $entrega_perfecta_pretest->tot_pe = $request->tot_pe;
        $entrega_perfecta_pretest->entrega_perfecta_pretest = $request->entrega_perfecta_pretest;
        $entrega_perfecta_pretest->save();
    }

    public function eliminar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $entrega_perfecta_pretest = EntregaPerfectaPreTest::findOrFail($request->id);
        $entrega_perfecta_pretest->delete();
    }

    public function reporteIndicador1(){
        $entrega_perfecta_pretest = EntregaPerfectaPreTest::select('entrega_perfecta_pretest.id',
        'entrega_perfecta_pretest.item','entrega_perfecta_pretest.fecha_consulta',
        'entrega_perfecta_pretest.ped_ep','entrega_perfecta_pretest.tot_pe','entrega_perfecta_pretest.entrega_perfecta_pretest')
        ->orderBy('entrega_perfecta_pretest.item', 'asc')->get();

        $cont=COUNT($entrega_perfecta_pretest);

        $pdf = \PDF::loadView('pdf.reporteIndicador1PreTest',['entrega_perfecta_pretest'=>$entrega_perfecta_pretest,'cont'=>$cont]);
        return $pdf->stream('reporteIndicador1PreTest.pdf');
    }
}
