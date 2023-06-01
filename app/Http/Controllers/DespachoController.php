<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailSeguimientos;
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
use App\Entrega;

use App\Notifications\NotifyAdmin;

class DespachoController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        $auth_rol = \Auth::user()->idrol;
        $sentencia = '';
        $auth_user_id = "";
        if($auth_rol == '4'){
            $condicion = '=';
            $auth_user_id = \Auth::user()->id;
            //$sentencia = "->where('despacho.idusuario','=','".$auth_user_id."')";
            //$sentencia
        }else{
            $condicion = 'like';
            $auth_user_id = '%';
        }

        if ($buscar==''){
            $pedido = Despacho::join('pedido','despacho.idpedido','pedido.id')
            ->join('users','pedido.idusuario','=','users.id')
            ->join('ventas','pedido.idventa','=','ventas.id')
            ->join('personas','ventas.idcliente','=','personas.id')
            ->join('personas as per_trans','despacho.idusuario','=','per_trans.id')
            ->select('despacho.id as iddespacho','pedido.id','pedido.num_pedido','pedido.dir_enviar','pedido.fecha_enviar','pedido.hora_enviar','despacho.descripcion',
            'despacho.created_at','despacho.estado','personas.nombre','users.usuario','despacho.updated_at','per_trans.nombre as transportista')
            ->where('despacho.idusuario', $condicion, $auth_user_id)
            ->orderBy('despacho.id', 'desc')->paginate(10);
        }
        else{
            $pedido = Despacho::join('pedido','despacho.idpedido','pedido.id')
            ->join('users','pedido.idusuario','=','users.id')
            ->join('ventas','pedido.idventa','=','ventas.id')
            ->join('personas','ventas.idcliente','=','personas.id')
            ->join('personas as per_trans','despacho.idusuario','=','per_trans.id')
            ->select('despacho.id as iddespacho','pedido.id','pedido.num_pedido','pedido.dir_enviar','pedido.fecha_enviar','pedido.hora_enviar','despacho.descripcion',
            'despacho.created_at','despacho.estado','personas.nombre','users.usuario','despacho.updated_at','per_trans.nombre as transportista')
            ->where('despacho.idusuario', $condicion, $auth_user_id)
            ->where('pedido.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('despacho.id', 'desc')->paginate(10);
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
    public function obtenerCodigo(Request $request)
    {
        $obtenerCodigo = Codigo::join('pedido','codigo.idpedido','pedido.id')
        ->select('pedido.id','codigo.numcodigo','codigo.condicion')
        ->where('codigo.idpedido','=',$request->id)
        ->orderBy('pedido.id', 'desc')->take(1)->get();

        return ['obtenerCodigo' => $obtenerCodigo];
    }

    public function activarEntrega(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $mytime= Carbon::now('America/Lima');
        $fecha = $mytime->toFormattedDateString();
        $hora = $mytime->toTimeString(); 
        $id = $request->id;
        
        $despacho = Despacho::findOrFail($request->iddespacho);
        $despacho->estado = 'Entregado';
        $despacho->save();

        $entrega = new Entrega();
        $entrega->iddespacho = $request->iddespacho;
        $entrega->PEP = $request->PEP;
        $entrega->estado = 'Entregado';
        $entrega->motivo = $request->motivo;
        $entrega->save();

        if($request->PEP == 'no'){
            $correo = Pedido::join('users','pedido.idusuario','=','users.id')
            ->join('ventas','pedido.idventa','=','ventas.id')
            ->join('personas','ventas.idcliente','=','personas.id')
            ->select('personas.email','pedido.id','pedido.num_pedido','pedido.dir_enviar','pedido.fecha_enviar','pedido.hora_enviar','pedido.descripcion',
            'pedido.created_at','pedido.estado','personas.nombre','personas.tipo_documento','personas.num_documento',
            'personas.direccion','personas.telefono','users.usuario','ventas.total','ventas.tipo_comprobante', 'ventas.serie_comprobante','ventas.num_comprobante')
            ->where('pedido.id','=',$id)
            ->orderBy('pedido.id', 'desc')->take(1)->get();

            $data = array(
                'correo' => $correo,
                //'detalles' =>$detallescorreo,
                'pedido' => $correo[0]["num_pedido"],
                'PEP'    => $request->PEP,
                'estado' => 'Entregado',
                'motivo' => $request->motivo,
                'fecha'  => $fecha,
                'hora'   => $hora,
            );
            //return ['data' => $data];
            Mail::to("industriasordonez9@gmail.com")->send(new EmailSeguimientos($data));
        }
    }
}
