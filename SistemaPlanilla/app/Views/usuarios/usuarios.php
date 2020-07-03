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
      <h5><i class="icon fas fa-check"></i> <?= $nombre_obj ?> activado/desactivado con exito</h5>
    </div>
  <?php else : ?>
    <div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h5><i class="icon fas fa-ban"></i> ERROR AL ACTIVAR/DESACTIVAR <?= strtoupper($nombre_obj) ?>!</h5>
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
            <button type="button" class="btn  btn-success col-8" data-toggle="modal" data-target="#usuarioModal" onclick="limpiar()">Nuevo</button>
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
                <th>Usuario</th>
                <th>Rol</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Creado</th>
                <th>Activo</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($usuarios as $index => $usuario) : ?>
                <?php if($usuario['ID_USUARIO'] != 1): ?>
                <tr>
                  <td><?= $index ?></td>

                  <td><?= $usuario['USUARIO'] ?></td>
                  <td><?= $rolesModel->get($usuario['ID_ROL'])[0]['NOMBRE_ROL'] ?></td>
                  <td><?= $usuario['NOMBRES'] ?></td>
                  <td><?= $usuario['APELLIDOS'] ?></td>
                  <td><?= $usuario['FECHA_HORA_CREACION'] ?></td>
                  <td><?= ($usuario['ACTIVO'] == 1) ? "ACTIVO" : "INACTIVO" ?></td>
                  <td class="row d-flex justify-content-around">
                    <form action="<?= $url_eliminar ?>" method="post" class="col-5">
                      <?= csrf_field() ?>
                      <input type="hidden" name="ID_USUARIO" value="<?= $usuario['ID_USUARIO'] ?>">
                      <?php if ($usuario['ACTIVO'] == 1) : ?>
                        <button class="btn btn-danger"><i class="icon fas fa-user-slash"></i></button>
                      <?php else: ?>
                        <button class="btn btn-success"><i class="icon fas fa-user-check"></i></button>
                      <?php endif ?>
                    </form>
                    <button class="btn btn-primary col-5"
                      onclick="editar_estado(
                        <?= $usuario['ID_USUARIO'] ?>,
                        '<?= $usuario['USUARIO'] ?>',
                        <?= $usuario['ID_ROL'] ?>,
                        '<?= $usuario['NOMBRES'] ?>',
                        '<?= $usuario['APELLIDOS'] ?>'
                        )"
                      data-toggle="modal" data-target="#usuarioModal"><i class="icon fas fa-edit"></i>
                    </button>
                  </td>
                </tr>
              <?php endif ?>
              <?php endforeach ?>
            </tbody>
            <tfoot>
              <tr>
                <th>#</th>
                <th>Usuario</th>
                <th>Rol</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Creado</th>
                <th>Activo</th>
                <th>Acciones</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>

<!-- MODALS -->
<div class="modal" id="usuarioModal" tabindex="-1" role="dialog" aria-labelledby="usuarioModalLabel" aria-hidden ="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="usuarioModalLabel"><?= $nombre_obj ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- FORM -->
        <form role="form" action="<?= $url_guardar ?>" method="post">
          <?= csrf_field() ?>
          <input type="hidden" name="ID_USUARIO" id="ID_USUARIO">
          <div class="card-body row">
            <div class="col-md-6">
              <!-- CAMPOS -->

              <div class="form-group">
                <label for="">Nombres *</label>
                <input name="NOMBRES" onkeyup="validar_nombre(this)" onblur="validar_nombre(this)" type="text" class="form-control" id="NOMBRES" placeholder="Nombre">
                <div class="invalid-feedback" style="display:none">
                  Nombre no válido: <strong>El nombre debe empezar con letras</strong>
                </div>
              </div>
              <div class="form-group">
                <label for="">Apellidos *</label>
                <input name="APELLIDOS" onkeyup="validar_nombre(this)" onblur="validar_nombre(this)" type="text" class="form-control" id="APELLIDOS" placeholder="Nombre">
                <div class="invalid-feedback" style="display:none">
                  Apellido no válido: <strong>El apellido debe empezar con letras</strong>
                </div>
              </div>
        
              <div class="form-group">
                <label>Rol</label>
                <select required name="ID_ROL" id="ID_ROL" class="form-control select2">
                  <?php foreach ($roles as $index => $rol) : ?>
                    <option value="<?= $rol['ID_ROL'] ?>"><?= $rol['NOMBRE_ROL'] ?></option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Usuario *</label>
                <input name="USUARIO" onkeyup="validar_nombre(this)" onblur="validar_nombre(this)" type="text" class="form-control" id="USUARIO" placeholder="Usuario">
                <div class="invalid-feedback" style="display:none">
                  Usuario no válido: <strong>Debe tener</strong>
                </div>
              </div>
              <div class="form-group">
                <label for="">Contraseña *</label>
                <input name="CONTRASENIA" onkeyup="validar_contrasenia(this)" onblur="validar_contrasenia(this)" type="password" class="form-control" id="CONTRASENIA" placeholder="Contraseña">
                <div class="invalid-feedback" style="display:none">
                  Contraseña no válida: <strong>Debe ser de 8 a 15 caracteres y contener al menos 1 mayúscula y 1 caracter especial</strong>
                </div>
              </div>
              <div class="form-group">
                <label for="">Confirmar Contraseña *</label>
                <input name="CONFIRMAR_CONTRASENIA" onkeyup="confirmar_contrasenia(this)" onblur="confirmar_contrasenia(this)" oninput="confirmar_contrasenia(this)" type="password" class="form-control" id="CONFIRMAR_CONTRASENIA" placeholder="Confirmar Contraseña">
                <div class="invalid-feedback" style="display:none">
                  Contraseña no válida: <strong>Las Contraseñas no coinciden</strong>
                </div>
              </div>
            </div>
          </div>

          <div class="card-footer">
            <button id="btn-submit" type="submit" class="btn btn-primary col-10 offset-1">Guardar Usuario</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>