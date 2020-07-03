<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Planilla</title>

  <style>
    .table{
        border-collapse: collapse !important;
        clear: both;
        margin-top: 6px !important;
        margin-bottom: 6px !important;
        max-width: none !important;
        /* border-collapse: separate !important; */
        border-spacing: 0;
    }
    .p-2 {
        padding: .5rem !important;
    }
    .table-secondary, .table-secondary > td, .table-secondary > th {
        background-color: #d6d8db;
    }
    .table-bordered {
        border: 1px solid #dee2e6;
    }
    .table-info, .table-info > td, .table-info > th {
        background-color: #bee5eb;
    }
    .w-100{
        width: 100% !important;
    }
  </style>
<head>
<body>
            <h2 class=""><strong>PLANILLA <?= $periodicidad?></strong>: <strong><?= $rango?></strong></h2>

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

            <h5>Detalle de planilla: <strong><?= $planilla['CODIGO']?></strong></h5>

            <table  class="table table-bordered table-hover mt-5 table-secondary table-responsive w-100" style="font-size: 0.8rem;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Empleado</th>
                        <th>Contratación</th>
                        <th>Salario Ordinario</th>
                        <th>Horas Diarias</th>
                        <th>Dias Laborados</th>
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
                            <td><?= $detalle['SEGURO_SOCIAL'] ?></td>
                            <td><?= $detalle['AFP'] ?></td>
                            <td><?= $detalle['RENTA'] ?></td>
                            <td><?= $detalle['SALARIO_LIQUIDO_DETALLE'] ?></td>
                        </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Empleado</th>
                        <th>Contratación</th>
                        <th>Salario Ordinario</th>
                        <th>Horas Diarias</th>
                        <th>Dias Laborados</th>
                        <th>Seguro Social</th>
                        <th>AFP</th>
                        <th>Renta</th>
                        <th>Salario Liquido</th>
                    </tr>
                </tfoot>
            </table>
        
</body>
