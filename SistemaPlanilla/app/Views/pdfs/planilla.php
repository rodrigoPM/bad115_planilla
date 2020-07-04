<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <center>
    <img class="navbar-brand-full" src="img/sin_backup.png"  alt="encabezado" text-align:center>
    </center>
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

            text-align: center;
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
        #pie {
        position: fixed;
        width: 100%;
        height: 100px;
        top: auto;
        right: 0;
        bottom: 0px;
        left: 0;

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
        <h3 style="text-align: right;">Generación de Planilla. <span >Fecha:<?= date('d/m/Y') ?></span></h3>
        <br>
        <h2 class=""><strong>PLANILLA <?= $periodicidad?></strong>: <strong><?= $rango?></strong></h2>
    </div>
            

            <table id="" class="table table-bordered table-hover w-100 my-3 table-info" style="text-align:left">
                <thead >
                    <tr>
                        <th class="p-2" >#</th>
                        <th class="p-2" >Codigo Planilla</th>
                        <th class="p-2">Fecha Inicio</th>
                        <th class="p-2">Fecha Fin</th>
                        <th class="p-2">Estado</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td class="p-2">1</td>
                            <td class="p-2"><?= $planilla['CODIGO']?></td>
                            <td class="p-2"><?= $planilla['DESDE_FECHA']?></td>
                            <td class="p-2" ><?= $planilla['HASTA_FECHA']?></td>
                            <td class="p-2"><?= $estatus ?></td>
                        </tr>
                </tbody>
            </table>

            <h3>Detalle de planilla: <strong><?= $planilla['CODIGO']?></strong></h3>

            <table  class="table table-bordered table-hover mt-5 table-secondary table-responsive w-100" style="font-size: 0.8rem;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Empleado</th>
                        <th>Contratación</th>
                        <th>Salario Ordinario</th>
                        <th>Horas Diarias</th>
                        <th>Dias Laborados</th>
                        <th>Salario</th>
                        <th>Seguro Social</th>
                        <th>AFP</th>
                        <th>Renta</th>
                        <th>Salario Liquido</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($detalles_planillas as $index => $detalle) : ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= $empleadosModel->get_nombre_compleado($detalle['ID_EMPLEADO'])?></td>
                            <td><?= $contratacionModel->get_nombre($detalle['ID_TIPO_CONTRATACION_DETALLE'])?></td>
                            <td><?= $detalle['SALARIO_ORDINARIO_DETALLE']?></td>
                            <td><?= $detalle['HORAS_DIARIAS']?></td>
                            <td><?= $detalle['DIAS_LABORADOS'] ?></td>
                            <td><?= $detalle['SALARIOS'] ?></td>
                            <td><?= $detalle['SEGURO_SOCIAL'] ?></td>
                            <td><?= $detalle['AFP'] ?></td>
                            <td><?= $detalle['RENTA'] ?></td>
                            <td><?= $detalle['SALARIO_LIQUIDO_DETALLE'] ?></td>
                        </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        
</body>
