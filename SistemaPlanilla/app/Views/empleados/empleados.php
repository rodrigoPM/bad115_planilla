<?php if ($operacion == 'guardar') : ?>
  <?php if ($exito) : ?>
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h5><i class="icon fas fa-check"></i> <?= $nombre_obj ?> Guardado!</h5>
      Se ha guardado el <?= $nombre_obj ?> con exito
    </div>
  <?php else : ?>
    <div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h5><i class="icon fas fa-ban"></i> ERROR AL GUARDAR <?= strtoupper($nombre_obj) ?>!</h5>
      Ha ocurrido un problema al guardar <?= $nombre_obj ?>
      <?= \Config\Services::validation()->listErrors(); ?>
    </div>
  <?php endif ?>
<?php endif ?>
<?php if ($operacion == 'eliminar') : ?>
  <?php if ($exito) : ?>
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h5><i class="icon fas fa-check"></i> <?= $nombre_obj ?> eliminado con exito</h5>
    </div>
  <?php else : ?>
    <div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h5><i class="icon fas fa-ban"></i> ERROR AL ELIMINAR <?= strtoupper($nombre_obj) ?>!</h5>
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
          <div class="col-4">
            <button type="button" class="btn  btn-success col-8" data-toggle="modal" data-target="#empleadoModal" onclick="limpiar()">Nuevo</button>
          </div>
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
              <th>Nombres</th>
              <th>Apellido</th>
              <th>Salario</th>
              <th>Correos</th>
              <!-- <th>Telefonos</th> -->
              <th>Puesto</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($empleados as $index => $empleado) : ?>
              <tr>
                <td><?= $index + 1 ?></td>


                <td><?= $empleado['NOMBRE_PRIMERO']?> <br> <?=$empleado['NOMBRE_SEGUNDO']?></td>
                <td><?= $empleado['APELLIDO_PATERNO']?> <br> <?=$empleado['APELLIDO_MATERNO']?></td>
                <td><?= '$ '.$empleado['SALARIO']?></td>
                <td><?= $empleado['CORREO_ELECTRONICO_PERSONAL']?> <br><?= $empleado['CORREO_ELECTRONICO_INSTITUCIONAL']?></td>
                
                <td><?= $puestoModel->get($empleado['ID_PUESTO'])[0]['DESCRIPCION_PUESTO']?></td>

                <td class="row d-flex justify-content-around">
                    <button type="button" onclick="eliminar(<?= $empleado['ID_EMPLEADO'] ?>)" class="btn btn-danger col-5" data-toggle="modal" data-target="#eliminarModal">
                    <i class="icon fas fa-trash"></i>
                    </button>
                  <button class="btn btn-primary col-5" 
                  onclick="editar_estado(
                    <?= $empleado['ID_EMPLEADO'] ?>,
                    '<?= $empleado['CODIGO_EMPLEADO'] ?>',
                    '<?= $empleado['NOMBRE_PRIMERO'] ?>',
                    '<?= $empleado['NOMBRE_SEGUNDO'] ?>',
                    '<?= $empleado['APELLIDO_PATERNO'] ?>',
                    '<?= $empleado['APELLIDO_MATERNO'] ?>',
                    '<?= $empleado['FECHA_NACIMIENTO'] ?>',
                    
                    '<?= $empleado['NUMERO_DOCUMENTO'] ?>',
                    '<?= $empleado['FECHA_EXPEDICION'] ?>',
                    '<?= $empleado['NIT'] ?>',
                    '<?= $empleado['NUP'] ?>',
                    '<?= $empleado['NUMERO_ISSS'] ?>',
                    '<?= $empleado['FECHA_INGRESO'] ?>',
                    '<?= $empleado['FECHA_CONTRATACION'] ?>',
                    <?= $empleado['SALARIO'] ?>,
                    '<?= $empleado['CORREO_ELECTRONICO_INSTITUCIONAL'] ?>',
                    '<?= $empleado['CORREO_ELECTRONICO_PERSONAL'] ?>',
                    
                    '<?= $empleado['HORARIO_TRABAJO'] ?>',
                    <?= $empleado['ID_PUESTO'] ?>,
                    <?= $empleado['ID_PROFESION_OFICIO'] ?>,
                    <?= $empleado['ID_ESTADO_CIVIL'] ?>,
                    <?= $empleado['ID_GENERO'] ?>,
                    <?= $empleado['ID_SUB_SECCION'] ?>,
                    <?= $empleado['ID_TIPO_CONTRATACION'] ?>,
                    <?= $empleado['ID_AFP'] ?>,
                    <?= $empleado['ID_ESTADO'] ?>,
                    <?= $empleado['ID_MUNICIPIO'] ?>,
                    <?= $empleado['ID_EMPLEADO_JEFE'] ?>,
                  )" data-toggle="modal" data-target="#empleadoModal">
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
              <th>Nombres</th>
              <th>Apellido</th>
              <th>Salario</th>
              <th>Correos</th>
              <!-- <th>Telefonos</th> -->
              <th>Puesto</th>
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
<div class="modal " id="empleadoModal" tabindex="-1" role="dialog" aria-labelledby="empleadoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="empleadoModalLabel"><?= $nombre_obj ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      <!-- form start -->
    <form role="form" action="<?= $url_guardar ?>" method="post">
        <?= csrf_field() ?>
        <input type="hidden" name="ID_EMPLEADO" id="ID_EMPLEADO">
        <div class="card-body row">
            <div class="col-md-6 ">
                
                    <input name="CODIGO_EMPLEADO"  type="hidden" class="form-control is-valid" id="CODIGO_EMPLEADO" placeholder="" value="<?= $cod_empleado ?>" >
                
                <div class="form-group">
                    <label for="">Primer Nombre *</label>
                    <input name="NOMBRE_PRIMERO" onkeyup="validar_nombre(this)" onblur="validar_nombre(this)" type="text" class="form-control" id="NOMBRE_PRIMERO" placeholder="Primer nombre">
                    <div class="invalid-feedback" style="display:none">
                        Nombre invalido: <strong>Primer Nombre debe comenzar con letras</strong>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Segundo Nombre</label>
                    <input name="NOMBRE_SEGUNDO"  type="text" class="form-control" id="NOMBRE_SEGUNDO" placeholder="Segundo nombre">
                </div>
                <div class="form-group">
                    <label for="">Primer Apellido *</label>
                    <input name="APELLIDO_PATERNO" onkeyup="validar_nombre(this)" onblur="validar_nombre(this)" type="text" class="form-control" id="APELLIDO_PATERNO" placeholder="Primer apellido">
                    <div class="invalid-feedback" style="display:none">
                        Apellido invalido: <strong>Primer Apellido debe comenzar con letras</strong>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Segundo Apellido *</label>
                    <input name="APELLIDO_MATERNO" onkeyup="validar_nombre(this)" onblur="validar_nombre(this)" type="text" class="form-control" id="APELLIDO_MATERNO" placeholder="Segundo apellido">
                    <div class="invalid-feedback" style="display:none">
                        Apellido invalido: <strong>Segundo Apellido debe comenzar con letras</strong>
                    </div>
                </div>
                <div class="form-group">
                    <label>Fecha Nacimiento *:</label>
                    <div class="input-group date" id="nacimientodate" data-target-input="nearest">
                        <input name="FECHA_NACIMIENTO" id="FECHA_NACIMIENTO" onkeyup="validar_string_formato(this, '2020-10-04', '-')" onblur="validar_string_formato(this, '2020-10-04', '-')"  type="text" class="form-control datetimepicker-input" data-target="#nacimientodate" placeholder="aaaa-mm-dd">
                        <div class="invalid-feedback" style="display:none">
                            Fecha invalida: <strong>Fecha llevar el formato: aaaa-mm-dd</strong>
                        </div>
                        <div class="input-group-append" data-target="#nacimientodate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>

                </div>
                <!-- <div class="form-group">
                    <label for="">Dirección *</label>
                    <input name="DIRECCION" onkeyup="validar_string_con_longitud(this, 15)" onblur="validar_string_con_longitud(this, 15)" type="text" class="form-control" id="DIRECCION" placeholder="Calle ## pasaje tal casa ##">
                    <div class="invalid-feedback" style="display:none">
                            Direccion invalida: <strong>La direccion es muy corta</strong>
                    </div>
                </div> -->
                <div class="form-group">
                    <label for="">DUI</label>
                    <input name="NUMERO_DOCUMENTO" onkeyup="validar_string_formato(this, '00000000-0', '-')" onblur="validar_string_formato(this, '00000000-0', '-')" type="text" class="form-control" id="NUMERO_DOCUMENTO" placeholder="00000000-0">
                    <div class="invalid-feedback" style="display:none">
                    DUI invalido: <strong>Formato de DUI: 00000000-0</strong>
                    </div>
                </div>
                <div class="form-group">
                    <label>Fecha Expedición:</label>
                    <div class="input-group date" id="expediciondate" data-target-input="nearest">
                        <input name="FECHA_EXPEDICION" id="FECHA_EXPEDICION"  type="text" onkeyup="validar_string_formato(this, '2020-10-04', '-')" onblur="validar_string_formato(this, '2020-10-04', '-')" class="form-control datetimepicker-input" data-target="#expediciondate" placeholder="aaaa-mm-dd">
                        <div class="invalid-feedback" style="display:none">
                            Fecha invalida: <strong>Fecha llevar el formato: aaaa-mm-dd</strong>
                        </div>
                        <div class="input-group-append" data-target="#expediciondate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">NIT</label>
                    <input name="NIT" onkeyup="validar_string_formato(this, '0000-000000-000-0', '-')" onblur="validar_string_formato(this, '0000-000000-000-0', '-')" type="text" class="form-control" id="NIT" placeholder="0000-000000-000-0">
                    <div class="invalid-feedback" style="display:none">
                    NIT invalido: <strong>Formato de NIT: 0000-000000-000-0</strong>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">NUP</label>
                    <input name="NUP" onkeyup="validar_string_con_longitud(this, 12, true)" onblur="validar_string_con_longitud(this, 12, true)" type="text" class="form-control" id="NUP" placeholder="123456789012">
                    <div class="invalid-feedback" style="display:none">
                    NUP invalido: <strong>Formato de NIT: 123456789012</strong>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Numero ISS</label>
                    <input name="NUMERO_ISSS" onkeyup="validar_string_con_longitud(this, 9, true)" onblur="validar_string_con_longitud(this, 9, true)" type="text" class="form-control" id="NUMERO_ISSS" placeholder="123456789">
                    <div class="invalid-feedback" style="display:none">
                    Numero ISSS invalido: <strong>Formato de Numero ISS: 123456789</strong>
                    </div>
                </div>
                <div class="form-group">
                    <label>Fecha Ingreso:</label>
                    <div class="input-group date" id="ingresodate" data-target-input="nearest">
                        <input name="FECHA_INGRESO" id="FECHA_INGRESO" onkeyup="validar_string_formato(this, '2020-10-04', '-')" onblur="validar_string_formato(this, '2020-10-04', '-')"  type="text" class="form-control datetimepicker-input" data-target="#ingresodate" placeholder="aaaa-mm-dd">
                        <div class="invalid-feedback" style="display:none">
                            Fecha invalida: <strong>Fecha llevar el formato: aaaa-mm-dd</strong>
                        </div>
                        <div class="input-group-append" data-target="#ingresodate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Fecha Contratacion:</label>
                    <div class="input-group date" id="contrataciondate" data-target-input="nearest">
                        <input name="FECHA_CONTRATACION" id="FECHA_CONTRATACION"   type="text" onkeyup="validar_string_formato(this, '2020-10-04', '-')" onblur="validar_string_formato(this, '2020-10-04', '-')" class="form-control datetimepicker-input" data-target="#contrataciondate" placeholder="aaaa-mm-dd">
                        <div class="invalid-feedback" style="display:none">
                            Fecha invalida: <strong>Fecha llevar el formato: aaaa-mm-dd</strong>
                        </div>
                        <div class="input-group-append" data-target="#contrataciondate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Salario</label>
                    <input name="SALARIO" step="0.01" min="300" onkeyup="validar_numero(this, 300)" onblur="validar_numero(this, 300)" type="number" class="form-control" id="SALARIO" placeholder="300">
                    <div class="invalid-feedback" style="display:none">
                    Salario invalido: <strong>Salario debe ser mayor que el minimo: 300</strong>
                    </div>
                </div>
            </div>
            <div class="col-md-6">


                <div class="form-group">
                    <label>Sub Seccion</label>
                    <select required name="ID_SUB_SECCION" id="ID_SUB_SECCION"  class="form-control select2 " style="width: 100%;">
                        <?php foreach ($sub_secciones as $index => $sub_seccion) : ?>
                            <option value="<?= $sub_seccion['ID_SUB_SECCION'] ?>"><?= $sub_seccion['NOMBRE_SUB_SECCION'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Estado</label>
                    <select required name="ID_ESTADO" id="ID_ESTADO" class="form-control select2 " style="width: 100%;">
                        <?php foreach ($estado_empleados as $index => $estado) : ?>
                            <option value="<?= $estado['ID_ESTADO'] ?>"><?= $estado['NOMBRE_ESTADO'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Estado Civil</label>
                    <select required name="ID_ESTADO_CIVIL" id="ID_ESTADO_CIVIL" class="form-control select2 " style="width: 100%;">
                        <?php foreach ($estados_civil as $index => $estado) : ?>
                            <option value="<?= $estado['ID_ESTADO_CIVIL'] ?>"><?= $estado['NOMBRE_ESTADO_CIVIL'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>AFP</label>
                    <select required name="ID_AFP" id="ID_AFP" class="form-control select2 " style="width: 100%;">
                        <?php foreach ($afps as $index => $afp) : ?>
                            <option value="<?= $afp['ID_AFP'] ?>"><?= $afp['NOMBRE_AFP'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>puesto</label>
                    <select required name="ID_PUESTO" id="ID_PUESTO" class="form-control select2 " style="width: 100%;">
                        <?php foreach ($puestos_trabajo as $index => $puesto) : ?>
                            <option value="<?= $puesto['ID_PUESTO'] ?>"><?= $puesto['DESCRIPCION_PUESTO'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Genero</label>
                    <select required name="ID_GENERO" id="ID_GENERO" class="form-control select2 " style="width: 100%;">
                        <?php foreach ($generos as $index => $genero) : ?>
                            <option value="<?= $genero['ID_GENERO'] ?>"><?= $genero['DESCRIPCION_GENERO'] ?></option>
                        <?php endforeach ?>
                    </select>
                    </select>
                </div>
                <div class="form-group">
                    <label>Tipo Contratacion</label>
                    <select required name="ID_TIPO_CONTRATACION" id="ID_TIPO_CONTRATACION" class="form-control select2 " style="width: 100%;">
                        <?php foreach ($tipos_contratacion as $index => $contratacion) : ?>
                            <option value="<?= $contratacion['ID_TIPO_CONTRATACION'] ?>"><?= $contratacion['NOMBRE_CONTRATACION'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Muncipio</label>
                    <select required name="ID_MUNICIPIO" id="ID_MUNICIPIO" class="form-control select2 " style="width: 100%;">
                        <?php foreach ($municipios as $index => $municipio) : ?>
                            <option value="<?= $municipio['ID_MUNICIPIO'] ?>"><?= $municipio['NOMBRE_MUNICIPIO'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Profesion u Oficio</label>
                    <select required name="ID_PROFESION_OFICIO" id="ID_PROFESION_OFICIO" class="form-control select2 " style="width: 100%;">
                        <?php foreach ($profesiones as $index => $profesion) : ?>
                            <option value="<?= $profesion['ID_PROFESION_OFICIO'] ?>"><?= $profesion['NOMBRE_PROFESION'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Correo Electronico Personal</label>
                    <input name="CORREO_ELECTRONICO_PERSONAL" onkeyup="validar_correo(this)" onblur="validar_correo(this)" type="email" class="form-control" id="CORREO_ELECTRONICO_PERSONAL" placeholder="example@example.com">
                    <div class="invalid-feedback" style="display:none">
                    Correo invalido: <strong>Por favor ingresar un correo valido: example@example.com</strong>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Correo Electronico Intitucional</label>
                    <input name="CORREO_ELECTRONICO_INSTITUCIONAL" onkeyup="validar_correo(this)" onblur="validar_correo(this)" type="email" class="form-control" id="CORREO_ELECTRONICO_INSTITUCIONAL" placeholder="example@example.com">
                    <div class="invalid-feedback" style="display:none">
                    Correo invalido: <strong>Por favor ingresar un correo valido: example@example.com</strong>
                    </div>
                </div>
               <!--  <div class="form-group">
                    <label for="">Telefono Celular</label>
                    <input name="TELEFONO_MOVIL" onkeyup="validar_numero(this, 60000000, 79999999)" onblur="validar_numero(this, 60000000, 79999999)" type="text" class="form-control" id="TELEFONO_MOVIL" placeholder="77777777">
                    <div class="invalid-feedback" style="display:none">
                    Telefono Celular invalido: <strong>Telefono valido ejemplo: 77777777</strong>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Telefono fijo</label>
                    <input name="TELEFONO"  onkeyup="validar_numero(this, 20000000, 29999999)" onblur="validar_numero(this, 20000000, 29999999)" type="text" class="form-control" id="TELEFONO" placeholder="22222222">
                    <div class="invalid-feedback" style="display:none">
                    Telefono Celular invalido: <strong>Telefono valido ejemplo: 22222222</strong>
                    </div>
                </div> -->
                <div class="form-group">
                    <label for="">Horario de trabajo</label>
                    <input name="HORARIO_TRABAJO" type="text" class="form-control" id="HORARIO_TRABAJO" placeholder="6 AM - 6 PM">
                </div>
                <div class="form-group">
                    <label>Jefe De Empleado</label>
                    <select name="ID_EMPLEADO_JEFE" id="ID_EMPLEADO_JEFE" class="form-control select2 " style="width: 100%;">
                        <?php foreach ($empleados as $index => $empleado) : ?>
                            <option value="<?= $empleado['ID_EMPLEADO'] ?>">
                                <?= $empleado['APELLIDO_PATERNO'] . ' ' . $empleado['APELLIDO_MATERNO'] . ',' . $empleado['NOMBRE_PRIMERO'] . ' ' . $empleado['NOMBRE_SEGUNDO'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button id="btn_submit" type="submit" class="btn btn-primary col-10 offset-1" disabled >Crear Empleado</button>
        </div>
    </form>
      </div>
    </div>
  </div>
</div>




<!-- Modal Eliminar -->
<div class="modal" id="eliminarModal" tabindex="-1" role="dialog" aria-labelledby="eliminarModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content  bg-danger">
      <div class="modal-header">
        <h5 class="modal-title" id="eliminarModalLabel">Eliminar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <h4>¿Esta seguro que desea eliminar <?= $nombre_obj ?> seleccionado?</h4>
      <form action="<?= $url_eliminar ?>" method="post" class="mt-4 row d-flex justify-content-around">
          <?= csrf_field() ?>
          <input type="hidden" id="id_eliminar" name="ID_EMPLEADO">
          <button type="button" class="btn btn-outline-light col-4" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-outline-light col-4" >
          Eliminar
          </button>
      </form>
      </div>
    </div>
  </div>
</div>




