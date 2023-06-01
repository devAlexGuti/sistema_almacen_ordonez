<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte del Indicador Entregas a Tiempo "Post - Test"</title>
    <style>
        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            font-size: 0.775rem;
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
            padding: 0.75rem;
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
            text-align: center;
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
        <h3>Reporte del Indicador Entregas a Tiempo "Post - Test"<span class="derecha">{{now()}}</span></h3>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-sm">
            <thead>
                <tr>
                    <th class="center">ITEM</th>
                    <th class="center">FECHA DE ENTREGA</th>
                    <th class="center">PEDIDOS ENTREGADOS A TIEMPO</th>
                    <th class="center">TOTAL PEDIDO ENTREGADOS</th>
                    <th class="center">ENTREGAS A TIEMPO</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($i2 as $i)
                <tr>
                    <td align="center" scope="row">{{ $loop->iteration}}</td>
                    <td align="center">{{$i->dia_registro_ent}}</td>
                    <td align="center">{{$i->cont_tpet}}</td>
                    <td align="center">{{$i->cont_tpe}}</td>
                    <td align="center">{{number_format(((($i->cont_tpet)/($i->cont_tpe))*100),2)}} %</td>
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