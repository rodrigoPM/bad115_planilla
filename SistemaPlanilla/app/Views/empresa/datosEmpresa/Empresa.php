<?php if ($operacion == 'guardar') : ?>
    <?php if ($exito) : ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> <?= $nombre_obj?> Guardado!</h5>
            Se ha guardado la <?= $nombre_obj?> con exito
        </div>
    <?php else : ?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-ban"></i> ERROR AL GUARDAR <?= strtoupper($nombre_obj)?>!</h5>
            Ha ocurrido un problema al guardar la <?= $nombre_obj?>
            <?= \Config\Services::validation()->listErrors(); ?>
        </div>
    <?php endif ?>
<?php endif ?>
<?php if ($operacion == 'eliminar') : ?>
    <?php if ($exito) : ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> <?= $nombre_obj?> eliminada con exito</h5>
        </div>
    <?php else : ?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-ban"></i> ERROR AL ELIMINAR LA<?= strtoupper($nombre_obj)?>!</h5>
        </div>
    <?php endif ?>
<?php endif ?>
<?php if ($operacion == 'buscar') : ?>
    <?php if ($exito) : ?>
        <div class="alert alert-primary alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> RESULTADOS DE BUSQUEDA: <?= strtoupper($termino) ?> </h5>
        </div>
    <?php else : ?>
        <div class="alert alert-warning alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h5><i class="icon fas fa-exclamation-triangle"></i> NO SE ENCONTRARON COINCIDENCIAS</h5>
    </div>
    <?php endif ?>
<?php endif ?>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h2 class="card-title"><b><?= $nombre_obj ?></b></h2>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="row mb-3">
          <!-- <div class="col-4">
            <button type="button" class="btn  btn-success col-8" data-toggle="modal" data-target="#empresaModal" onclick="limpiar()">Nuevo</button>
          </div>-->
          <div class="col-8">
            <form class="mr-0 ml-auto" action="<?= $url_buscar ?>" method="post">
              <div class="input-group input-group-md">
                <input name="termino" class="form-control form-control-navbar" type="search" placeholder="Buscar" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-secondary" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <table id="" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Nombre</th>
              <th>NIT Empresa</th>
              <th>AFP Patronal</th>
              <th>Porcentaje INSAFORP</th>
              <th>Planilla Tipo</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($empresas as $index => $empresa) : ?>
              <tr>
                <td><?= $index + 1 ?></td>

                <td><?= $empresa['NOMBRE_EMPRESA']?></td>
                <td><?= $empresa['NIT_EMPRESA']?></td>
                <td><?= $empresa['NUMERO_AFP_PATRONAL']?></td>
                <td><?= $empresa['PORCENTAJE_INSAFORP'].'% '?></td>
                <td><?= $periodicidadModel->get($empresa['ID_PERIOCIDAD'])[0]['DESC_PERIOCIDAD']?></td>

                <td class="row d-flex justify-content-around">
                   <!-- <form action="<?= $url_eliminar ?>" method="post" class=" col-5">
                    <?= csrf_field() ?>
                    <input type="hidden" name="ID_EMPRESA" value="<?= $empresa['ID_EMPRESA'] ?>">
                    <button class="btn btn-danger"><i class="icon fas fa-trash"></i></button>
                  </form>-->
                  <button class="btn btn-primary col-5" 
                  onclick="editar_estado(
                    <?= $empresa['ID_EMPRESA'] ?>,
                    '<?= $empresa['ID_TABLA'] ?>',
                    '<?= $empresa['ID_PERIOCIDAD'] ?>',
                    '<?= $empresa['NOMBRE_EMPRESA'] ?>',
                    '<?= $empresa['PORCENTAJE_ISSS'] ?>',
                    '<?= $empresa['NIT_EMPRESA'] ?>',
                    '<?= $empresa['NUMERO_AFP_PATRONAL'] ?>',
                    '<?= $empresa['PORCENTAJE_INSAFORP'] ?>',
                    '<?= $empresa['LIMITE_ISSS'] ?>',
                    '<?= $empresa['NUMERO_EMP_MAX_INSAFORP'] ?>',
                    '<?= $empresa['SALARIO_MINIMO'] ?>',
                  )" data-toggle="modal" data-target="#empresaModal">
                  <i class="icon fas fa-edit"></i></button>
                  <!-- <button class="btn btn-info col-3" 
                  onclick="" data-toggle="modal" data-target="#empleadoModal">
                  <i class="icon fas fa-eye"></i></button> -->
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
          <tfoot>
            <tr>
            <th>#</th>
            <th>Nombre</th>
              <th>NIT Empresa</th>
              <th>AFP Patronal</th>
              <th>Porcentaje INSAFORP</th>
              <th>Planilla Tipo</th>
              <th>Acciones</th>
            </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>

<!-- MODALES -->
<div class="modal" id="empresaModal" tabindex="-1" role="dialog" aria-labelledby="empresaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="empresaModalLabel"><?= $nombre_obj?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= $url_guardar ?>" method="post">
                     <?= csrf_field() ?>
                    <input type="hidden" name="ID_EMPRESA" id="ID_EMPRESA">

                    <div class="form-group">
                    <label for="">Nombre Empresa *</label>
                    <input name="NOMBRE_EMPRESA" onkeyup="validar_nombre(this)" onblur="validar_nombre(this)" type="text" class="form-control" id="NOMBRE_EMPRESA" placeholder="Empresa S.A. de C.V.">
                    <div class="invalid-feedback" style="display:none">
                        Nombre invalido: <strong>Nombre debe comenzar con letras</strong>
                    </div>
                    </div>

                    <div class="form-group">
                    <label>Tabla Renta *</label>

                    <select name="ID_TABLA" id="ID_TABLA" class="form-control select2 " style="width: 100%;">
                        <?php foreach ($tablas as $index => $tabla) : ?>
                            <option value="<?= $tabla['ID_TABLA'] ?>"><?= $tabla['NOMBRE_TABLA'] ?></option>
                        <?php endforeach ?>
                    </select>
                    </div>
                    
                    <div class="form-group">
                    <label>Periodicidad de Planilla *</label>
                    <select name="ID_PERIOCIDAD" id="ID_PERIOCIDAD" class="form-control select2 " style="width: 100%;">
                        <?php foreach ($periodicidades as $index => $periodicidad) : ?>
                            <option value="<?= $periodicidad['ID_PERIOCIDAD'] ?>"><?= $periodicidad['DESC_PERIOCIDAD'] ?></option>
                        <?php endforeach ?>
                    </select>
                    </div>

                    <div class="form-group">
                        <label for="">Porcentaje ISSS Patronal *</label>
                        <input name="PORCENTAJE_ISSS" id="PORCENTAJE_ISSS" onkeyup="validar_numero(this, 1,100)" onblur="validar_numero(this, 1,100)" type="number" class="form-control" step="0.01" placeholder="0.01">
                        <div class="invalid-feedback" style="display:none">
                        Porcentaje invalido: <strong>Porcentaje debe ser mayor 1 y menor a 100</strong>
                        </div>
                    </div>

                    <div class="form-group">
                    <label for="">NIT Empresa *</label>
                    <input name="NIT_EMPRESA" onkeyup="validar_string_formato(this, '0000-000000-000-0', '-')" onblur="validar_string_formato(this, '0000-000000-000-0', '-')" type="text" class="form-control" id="NIT_EMPRESA" placeholder="0000-000000-000-0">
                    <div class="invalid-feedback" style="display:none">
                    NIT invalido: <strong>Formato de NIT: 0000-000000-000-0</strong>
                    </div>
                    </div>

                    <div class="form-group">
                    <label for="">AFP Patronal</label>
                    <input name="NUMERO_AFP_PATRONAL" onkeyup="validar_string_con_longitud(this, 9, true)" onblur="validar_string_con_longitud(this, 9, true)" type="text" class="form-control" id="NUMERO_AFP_PATRONAL" placeholder="123456789">
                    <div class="invalid-feedback" style="display:none">
                    NUP invalido: <strong>Formato de NIT: 123456789012</strong>
                    </div>
                    </div>

                    <div class="form-group">
                        <label for="">Porcentaje INSAFORP *</label>
                        <input name="PORCENTAJE_INSAFORP" id="PORCENTAJE_INSAFORP" onkeyup="validar_numero(this, 1,100)" onblur="validar_numero(this, 1,100)" type="number" class="form-control" step="0.01" placeholder="0.01">
                        <div class="invalid-feedback" style="display:none">
                        Porcentaje invalido: <strong>Porcentaje debe ser mayor a 1 y menor a 100</strong>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Limite ISSS *</label>
                        <input name="LIMITE_ISSS" id="LIMITE_ISSS" onkeyup="validar_numero(this, 1)" onblur="validar_numero(this, 1)" type="number" class="form-control" step="0.01" placeholder="1.00">
                        <div class="invalid-feedback" style="display:none">
                        Monto invalido: <strong>Monto debe ser mayor 1.00</strong>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Numero Máximo INSAFORP *</label>
                        <input name="NUMERO_EMP_MAX_INSAFORP" id="NUMERO_EMP_MAX_INSAFORP"  onkeyup="validar_numero(this, 1)" onblur="validar_numero(this, 1)" type="number" class="form-control" placeholder="1">
                        <div class="invalid-feedback" style="display:none">
                        Número invalido: <strong>debe ser mayor a 1</strong>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Salario mínimo *</label>
                        <input name="SALARIO_MINIMO" id="SALARIO_MINIMO" onkeyup="validar_numero(this, 1)" onblur="validar_numero(this, 1)" type="number" class="form-control" step="0.01" placeholder="1.00">
                        <div class="invalid-feedback" style="display:none">
                        Monto invalido: <strong>Monto debe ser mayor 1.00</strong>
                        </div>
                    </div>

                    <button id="btn_submit" disabled type="submit" class="btn btn-success btn-block">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>