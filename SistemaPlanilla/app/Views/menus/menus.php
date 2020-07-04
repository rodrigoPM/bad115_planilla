<?php if ($operacion == 'guardar') : ?>
    <?php if ($exito) : ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> <?= $nombre_obj?> Guardado!</h5>
            Se ha guardado el <?= $nombre_obj?> con exito
        </div>
    <?php else : ?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-ban"></i> ERROR AL GUARDAR <?= strtoupper($nombre_obj)?>!</h5>
            Ha ocurrido un problema al guardar <?= $nombre_obj?>
            <?= \Config\Services::validation()->listErrors(); ?>
        </div>
    <?php endif ?>
<?php endif ?>
<?php if ($operacion == 'eliminar') : ?>
    <?php if ($exito) : ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> <?= $nombre_obj?> eliminado con exito</h5>
        </div>
    <?php else : ?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-ban"></i> ERROR AL ELIMINAR <?= strtoupper($nombre_obj)?>!</h5>
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
                <h2 class="card-title"><b><?= $nombre_obj?></b></h2>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-4">
                        <button type="button" class="btn  btn-success col-8" data-toggle="modal" data-target="#menusModal" onclick="limpiar()">Nuevo</button>
                    </div>
                    <div class="col-8">
                        <form class="mr-0 ml-auto" action="<?= $url_buscar?>" method="post">
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
                            <th>Menu Padre</th>
                            <th>Ruta</th>
                            <th>Icono</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($menus as $index => $menus) : ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= $menus['NOMBRE_MENU'] . ' ' ?></td>

                                <?php if($menus['ID_MENU_PADRE'] != NULL) :?>
                                    <td><?= $menusModel->get($menus['ID_MENU_PADRE'])[0]['NOMBRE_MENU'] ?></td>
                                    <td><?= $menus['RUTA_MENU'] . ' ' ?></td>
                                <?php else :?>
                                    <td>NINGUNO</td>
                                    <td>NO APLICA</td>
                                <?php endif; ?>
                                <td><i class="<?= $iconosModel->get($menus['ID_ICONO'])[0]['NOMBRE_ICONO'] ?>"></i></td>
                                <td class="row d-flex justify-content-around">
                                    <form action="<?= $url_eliminar?>" method="post" class=" col-5">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="ID_MENU" value="<?=$menus['ID_MENU'] ?>">
                                        <button class="btn btn-danger  btn-block"><i class="fas fa-trash"></i></button>
                                    </form>
                                    <button class="btn btn-primary col-5 btn-sm" 
                                    onclick="editar_estado(<?= $menus['ID_MENU'] ?>, '<?= $menus['NOMBRE_MENU'] ?>')" 
                                    data-toggle="modal" data-target="#menusModal"><i class="fas fa-edit"></i></button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Menu Padre</th>
                            <th>Ruta</th>
                            <th>Icono</th>
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
<div class="modal" id="menusModal" tabindex="-1" role="dialog" aria-labelledby="menusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="menusModalLabel"><?= $nombre_obj?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= $url_guardar ?>" method="post">
                     <?= csrf_field() ?>
                    <input type="hidden" name="ID_MENU" id="ID_MENU">
                    
                    <div class="form-group">
                        <label for="">Nombre del <?= $nombre_obj?></label>
                        <input name="NOMBRE_MENU" id="NOMBRE_MENU" onkeyup="validar_nombre(this)" onblur="validar_nombre(this)" type="text" class="form-control" id="" placeholder="Nombre de <?= $nombre_obj?>">
                        <div class="invalid-feedback" style="display:none">
                            El nombre no debe comenzar con números ni caracteres especiales
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Icono</label>
                        <select name="ID_ICONO" id="ID_ICONO" class="form-control select2">
                            <?php foreach ($iconos as $index => $icono) : ?>
                                <option value="<?= $icono['ID_ICONO'] ?>"><?= $icono['NOMBRE_ICONO'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                    <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="show-child">
                          <label class="form-check-label">Es Submenú</label>
                    </div>
                    </div>

                    <div class="form-wrapper" style="display: none">
                    <input type="hidden" name="HIJO" id="HIJO">
                    <div class="form-group">
                        <label>Menu Padre</label>
                        <select  name="ID_MENU_PADRE" id="ID_MENU_PADRE" class="form-control select2">
                            <?php foreach ($menusPadre as $index => $menusPadre) : ?>
                                <option value="<?= $menusPadre['ID_MENU'] ?>"><?= $menusPadre['NOMBRE_MENU'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Ruta del <?= $nombre_obj?></label>
                        <input name="RUTA_MENU" id="RUTA_MENU" onkeyup="" onblur="" type="text" class="form-control" placeholder="Ruta del <?= $nombre_obj?>">
                        <div class="invalid-feedback" style="display:none">
                            El nombre no debe comenzar con números ni caracteres especiales
                        </div>
                    </div>

                    </div>

                    <br>
                    <button id="btn_submit" disabled type="submit" class="btn btn-success btn-block">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
$(document).ready(function(){
  $('#show-child').click(function(){
    if(document.getElementById("show-child").checked == true)
    {
        $('.form-wrapper').show(500);
        document.getElementById("HIJO").value = 'true';
    }
    else
    {
        $('.form-wrapper').hide(500);
        document.getElementById("HIJO").value = '';
    }
  });
});
</script>