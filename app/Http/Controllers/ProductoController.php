<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use App\Unidad_medida;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $productos = Producto::join('categorias','productos.idcategoria','=','categorias.id')
            ->join('unidad_medida','productos.idunidad_medida','=','unidad_medida.id')
            ->select('productos.id','productos.idcategoria','productos.idunidad_medida','productos.codigo','productos.nombre',
            'productos.fecha_vencimiento','categorias.nombre as nombre_categoria','unidad_medida.nombre as nombre_unidad_medida',
            'productos.precio_venta','productos.stock',
            'productos.descripcion','productos.condicion')
            /* paginate me muestra la data de 10 en 10 */
            ->orderBy('categorias.nombre', 'asc')->paginate(10);
        }
        else{
            $productos = Producto::join('categorias','productos.idcategoria','=','categorias.id')
            ->join('unidad_medida','productos.idunidad_medida','=','unidad_medida.id')
            ->select('productos.id','productos.idcategoria','productos.idunidad_medida','productos.codigo','productos.nombre',
            'productos.fecha_vencimiento','categorias.nombre as nombre_categoria','unidad_medida.nombre as nombre_unidad_medida',
            'productos.precio_venta','productos.stock','productos.descripcion','productos.condicion')
            ->where('productos.'.$criterio, 'like', '%'. $buscar . '%')
            ->orwhere('categorias.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('productos.nombre', 'asc')->paginate(10);
        }
        

        return [
            'pagination' => [
                'total'        => $productos->total(),
                'current_page' => $productos->currentPage(),
                'per_page'     => $productos->perPage(),
                'last_page'    => $productos->lastPage(),
                'from'         => $productos->firstItem(),
                'to'           => $productos->lastItem(),
            ],
            'productos' => $productos
        ];
    }

    //LISTAR PRODUCTO PARA COMPRAS
    public function listarProducto(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $productos = Producto::join('categorias','productos.idcategoria','=','categorias.id')
            ->select('productos.id','productos.idcategoria','productos.codigo','productos.nombre','categorias.nombre as nombre_categoria',
            'productos.fecha_vencimiento','productos.precio_venta','productos.stock','productos.descripcion','productos.condicion')
            ->orderBy('categorias.nombre', 'asc')->paginate(10);
        }
        else{
            $productos = Producto::join('categorias','productos.idcategoria','=','categorias.id')
            ->select('productos.id','productos.idcategoria','productos.codigo','productos.nombre','categorias.nombre as nombre_categoria',
            'productos.fecha_vencimiento','productos.precio_venta','productos.stock','productos.descripcion','productos.condicion')
            ->where('productos.'.$criterio, 'like', '%'. $buscar . '%')
            ->orwhere('categorias.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('productos.nombre', 'asc')->paginate(10);
        }
        

        return ['productos' => $productos];
    }
    
     //LISTAR PRODUCTO PARA VENTAS
    public function listarProductoVenta(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $productos = Producto::join('categorias','productos.idcategoria','=','categorias.id')
            ->join('unidad_medida','productos.idunidad_medida','=','unidad_medida.id')
            ->select('productos.id','productos.idcategoria','productos.codigo','productos.nombre','categorias.nombre as nombre_categoria',
            'productos.fecha_vencimiento','productos.precio_venta','productos.stock','productos.descripcion','productos.condicion',
            'unidad_medida.nombre as unidad_medida')
            ->where('productos.stock','>','0')
            ->where('productos.condicion','=','1')
            ->orderBy('categorias.nombre', 'asc')->paginate(10);
        }
        else{
            $productos = Producto::join('categorias','productos.idcategoria','=','categorias.id')
            ->select('productos.id','productos.idcategoria','productos.codigo','productos.nombre','categorias.nombre as nombre_categoria',
            'productos.fecha_vencimiento','productos.precio_venta','productos.stock','productos.descripcion','productos.condicion')
            ->where('productos.'.$criterio, 'like', '%'. $buscar . '%')
            ->where('productos.stock','>','0')
            ->where('productos.condicion','=','1')
            //->orwhere('categorias.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('productos.nombre', 'asc')->paginate(10);
        }
        

        return ['productos' => $productos];
    }
    public function selectProductoStock(Request $request){
        if (!$request->ajax()) return redirect('/');

        $productos = Producto::where('condicion','=','1')
        ->select('id','nombre','stock')->orderBy('nombre', 'asc')->get();
        return ['productos' => $productos];
    }

    public function listarPdf(){
        $productos = Producto::join('categorias','productos.idcategoria','=','categorias.id')
            ->join('unidad_medida','productos.idunidad_medida','=','unidad_medida.id')
            ->select('productos.id','productos.idcategoria','productos.codigo','productos.nombre',
            'categorias.nombre as nombre_categoria', 'unidad_medida.nombre as nombre_unidad_medida','productos.precio_venta','productos.stock',
            'productos.descripcion','productos.condicion')
            ->orderBy('categorias.nombre', 'asc')->get();

        $cont=Producto::count();
            /* pasamos dos arreglos productos y cont (total de registros)*/
        $pdf = \PDF::loadView('pdf.productospdf',['productos'=>$productos,'cont'=>$cont]);
        /* método stream para que se abra en otra pestaña*/
        return $pdf->stream('productos.pdf');
    }
    
    public function buscarProducto(Request $request){
        if (!$request->ajax()) return redirect('/');

        $filtro = $request->filtro;
        $productos = Producto::where('codigo','=', $filtro)
        ->select('id','nombre')->orderBy('nombre', 'asc')->take(1)->get();

        return ['productos' => $productos];
    }

    public function buscarProductoVenta(Request $request){
        if (!$request->ajax()) return redirect('/');

        $filtro = $request->filtro;
        $productos = Producto::where('codigo','=', $filtro)
        ->select('id','nombre','stock','precio_venta')
        ->where('stock','>','0')
        ->orderBy('nombre', 'asc')
        ->take(1)->get();

        return ['productos' => $productos];
    }
    
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $producto = new Producto();
        $producto->idcategoria = $request->idcategoria;
        $producto->idunidad_medida = $request->idunidad_medida;
        $producto->codigo = $request->codigo;
        $producto->nombre = $request->nombre;
        $producto->fecha_vencimiento = $request->fecha_vencimiento;
        $producto->precio_venta = $request->precio_venta;
        $producto->stock = $request->stock;
        $producto->descripcion = $request->descripcion;
        $producto->condicion = '1';
        $producto->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $producto = Producto::findOrFail($request->id);
        $producto->idcategoria = $request->idcategoria;
        $producto->idunidad_medida = $request->idunidad_medida;
        $producto->codigo = $request->codigo;
        $producto->nombre = $request->nombre;
        $producto->precio_venta = $request->precio_venta;
        $producto->stock = $request->stock;
        $producto->descripcion = $request->descripcion;
        $producto->fecha_vencimiento = $request->fecha_vencimiento;
        $producto->condicion = '1';
        $producto->save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $producto = Producto::findOrFail($request->id);
        $producto->condicion = '0';
        $producto->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $producto = Producto::findOrFail($request->id);
        $producto->condicion = '1';
        $producto->save();
    }

    public function validacionReact(Request $request){
        if (!$request->ajax()) return redirect('/');
        $value = $request->value;
        $variable = $request->variable;

        $consulta = Producto::where($variable,'=',$value)
        ->select('id','codigo','nombre')->orderBy('nombre', 'asc')->get();
        $info = ['consulta' => $consulta];
        return array_add($info, 'variable', $variable);
    }

    public function selectUnidad_medida(Request $request){
        if (!$request->ajax()) return redirect('/');
        $unidad_medida = Unidad_medida::where('estado','=','1')
        ->select('id','nombre','prefijo')->orderBy('nombre', 'asc')->get();
        return ['unidad_medida' => $unidad_medida];
    }

}
