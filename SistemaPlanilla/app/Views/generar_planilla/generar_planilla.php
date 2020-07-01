<hr>

<?php if ($operacion == 'planilla_existe') : ?>
    <div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-check"></i> PLANILLA! </h5>
    </div>
<?php endif ?>
<?php if ($operacion == 'calcular') : ?>
    <?php if ($exito) : ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> EXITO: PLANILLA CREADA  SIN ERRORES!</h5>
        </div>
    <?php else : ?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-ban"></i> ERROR AL GENERAR PLANILLA!</h5>
        </div>
    <?php endif ?>
<?php endif ?>
<?php if ($operacion == 'cerrar') : ?>
    <?php if ($exito) : ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> PLANILLA CERRADA CON EXITO </h5>
        </div>
    <?php else : ?>
        <div class="alert alert-warning alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h5><i class="icon fas fa-exclamation-triangle"></i> NO SE PUDO CERRA PLANILLA</h5>
    </div>
    <?php endif ?>
<?php endif ?>

<!---->
<?php if ($exito) : ?> 

    <div class="card">
        <div class="card-header">
            <h2 class="card-title"><strong>PLANILLA <?= $periodicidad?></strong>: <strong><?= $rango?></strong></h2>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-6">
                <?php if ($estatus != 'CERRADA') : ?>
                    <form action="<?= $url_cerrar ?>" method="post">
                        <?= csrf_field() ?>
                        <button type="submit" class="btn  btn-warning btn-block" data-toggle="modal" data-target="#domicilioModel" onclick="">
                        <strong>Cerrar Planilla</strong></button>
                    </form>
                <?php endif ?>
                </div>
                <div class="col-6">
                    <button type="button" class="btn  btn-primary btn-block" data-toggle="modal" data-target="#domicilioModel" onclick="">
                    <strong>Imprimir Planilla</strong></button>
                </div>
            </div>

            <table id="t_planilla" class="table-bordered table-hover w-100 my-3 table-info" style="">
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

            <table  class="table table-bordered table-hover mt-5 table-secondary table-responsive" style="font-size: 0.8rem;">
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
                            <td><?= $detalle['SEGURO_SOCIAL'] ?></td>
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
        </div>
    </div>

   
<?php else : ?>
    <div class="row">
        <h4 class="col-12">Planilla a generar: <strong>Planilla <?= $periodicidad?></strong></h4>
        <br>
        <h4 class="col-12">Mes: <strong><?= $rango?></strong></h4>
    </div>
    <form action="<?= $url_calcular ?>" class="mt-4" method="post">
    <?= csrf_field() ?>
    <input type="submit" value="Generar Planilla" class="btn btn-primary btn-block">
    </form>
<?php endif ?>


<hr>






