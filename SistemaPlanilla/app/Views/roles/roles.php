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
                        <button type="button" class="btn  btn-success col-8" data-toggle="modal" data-target="#rolesModel" onclick="limpiar()">Nuevo</button>
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
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($roles as $index => $roles) : ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= $roles['NOMBRE_ROL'] ?></td>
                                <td class="row d-flex justify-content-around">
                                <button type="button" onclick="eliminar(<?= $roles['ID_ROL'] ?>)" class="btn btn-danger col-5" data-toggle="modal" data-target="#eliminarModal">
                                <i class="icon fas fa-trash"></i></button>
                                <button class="btn btn-primary col-5 btn-sm" onclick="editar_estado(<?= $roles['ID_ROL'] ?>, '<?= $roles['NOMBRE_ROL'] ?>')" data-toggle="modal" data-target="#rolesModel">Editar</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
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
<div class="modal" id="rolesModel" tabindex="-1" role="dialog" aria-labelledby="rolesModelLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rolesModelLabel"><?= $nombre_obj ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= $url_guardar ?>" method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" name="ID_ROL" id="ID_ROL">
                    <div class="form-group">
                        <label for="">Nombre de <?= $nombre_obj ?></label>
                        <input name="NOMBRE_ROL" id="NOMBRE_ROL" onkeyup="validar_nombre(this)" onblur="validar_nombre(this)" type="text" class="form-control" id="" placeholder="Nombre de <?= $nombre_obj ?>">
                        <div class="invalid-feedback" style="display:none">
                            El nombre no debe comenzar con números ni caracteres especiales
                        </div>
                    </div>


                  <label for="">Menús</label>
                    <?php foreach ($menus as $index => $menus) : ?>
                      <div class="card card-body" id="">
                      <div class="form-group card-header">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="menu-padre" name="menu[]" value="<?= $menus["ID_MENU"] ?>">
                          <label class="form-check-label"><strong><?= $menus["NOMBRE_MENU"] ?></strong></label>
                        </div>
                      </div>
                      <br>
                      <div class="row">
                      <?php foreach ($menus['submenus'] as $submenu): ?>
                        <div class="form-group col-lg-6 col-6">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="menu[]" id="menu-hijo" value="<?= $submenu["ID_MENU"] ?>">
                            <label class="form-check-label"><?= $submenu["NOMBRE_MENU"] ?></label>
                          </div>
                        </div>
                      <?php endforeach ?>
                      </div>
                      </div>
                      <br><br>
                    <?php endforeach ?>


                    <button id="btn_submit" disabled type="submit" class="btn btn-success btn-block">Guardar</button>
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
      <h4>¿Esta seguro que desea eliminar  <?= $nombre_obj ?> seleccionado?</h4>
      <form action="<?= $url_eliminar ?>" method="post" class="mt-4 row d-flex justify-content-around">
          <?= csrf_field() ?>
          <input type="hidden" id="id_eliminar" name="ID_ROL">
          <button type="button" class="btn btn-outline-light col-4" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-outline-light col-4" >
          Eliminar
          </button>
      </form>
      </div>
    </div>
  </div>
</div>


<!--
<script>


let num = document.getElementById("cantMenus").value;
document.getElementById("res").value = num;

/*
  $(".padre"+i).change(function(){
  $(".hijo"+i).prop("checked", $(this).prop("checked"))
})
let cl = $($('.nav').find('a.current')).parent().attr('class');
/*

</script>
-->