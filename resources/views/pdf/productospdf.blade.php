<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Productos</title>
    <style>
        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            font-size: 0.875rem;
            font-weight: normal;
            line-height: 1.5;
            color: #151b1e;           
        }
        .table {
            display: table;
            width: 100%;
            max-width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
            border-collapse: collapse;
        }
        .table-bordered {
            border: 1px solid #c2cfd6;
        }
        thead {
            display: table-header-group;
            vertical-align: middle;
            border-color: inherit;
        }
        tr {
            display: table-row;
            vertical-align: inherit;
            border-color: inherit;
        }
        .table th, .table td {
            /*padding relleno de la tabla*/
            padding: 0.55rem;
            vertical-align: top;
            border-top: 1px solid #c2cfd6;
        }
        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #c2cfd6;
        }
        .table-bordered thead th, .table-bordered thead td {
            border-bottom-width: 2px;
        }
        .table-bordered th, .table-bordered td {
            border: 1px solid #c2cfd6;
        }
        th, td {
            display: table-cell;
            vertical-align: inherit;
        }
        th {
            font-weight: bold;
            text-align: -internal-center;
            text-align: left;
        }
        tbody {
            display: table-row-group;
            vertical-align: middle;
            border-color: inherit;
        }
        tr {
            display: table-row;
            vertical-align: inherit;
            border-color: inherit;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }
        .izquierda{
            float:left;
        }
        .derecha{
            float:right;
        }
    </style>
</head>
<body>
    <div>
        <h3>Lista de Productos <span class="derecha">{{now()}}</span></h3>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-sm" cellpadding="0" cellspacing="0" >
            <thead>
                <tr>
                    <th width="20%" class="center">Código</th>
                    <th width="20%" class="center">Nombre</th>
                    <th width="20%" class="center">Unidad Medida</th>
                    <th width="20%" class="center">Categoría</th>
                    <th width="20%" class="center">Precio Venta</th>
                    <th width="20%" class="center">Stock</th>
                    <th width="20%" class="center">Descripción</th>
                    <th width="20%" class="center">Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $p)
                <tr>
                    <td>{{$p->codigo}}</td>
                    <td>{{$p->nombre}}</td>
                    <td>{{$p->nombre_unidad_medida}}</td>
                    <td>{{$p->nombre_categoria}}</td>
                    <td>{{$p->precio_venta}}</td>
                    <td>{{$p->stock}}</td>
                    <td>{{$p->descripcion}}</td>
                    <td>{{$p->condicion?'Activo':'Desactivado'}}</td>
                </tr>
                @endforeach                                
            </tbody>
        </table>
    </div>
    <div class="izquierda">
        <p><strong>Total de registros: </strong>{{$cont}}</p>
    </div>    
</body>
</html>