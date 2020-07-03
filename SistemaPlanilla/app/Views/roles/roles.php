<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h2 class="card-title"><b>Roles</b></h2>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="row mb-3">
          <div class="col-4">
            <button type="button" class="btn  btn-success col-8" id="nuevo">Nuevo</button>
          </div>
          <div class="col-8">
            <div class="input-group input-group-sm">

        <input class="form-control form-control-navbar" type="search" placeholder="Buscar" aria-label="Search" id="busqueda" onkeyup="Alerta()">
        <div class="input-group-append">
        <button class="btn btn-secondary" disabled>
                    <i class="fas fa-search"></i>
                  </button>
        </div>
      </div>

          </div>
        </div>
        
        <p id="ruta" style="display: none"><?= base_url() ?></p>


<div id="cambio">

<?php echo view('roles/busqueda');?>

</div>

      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>


<?php echo $paginador->links(); ?>

 
<div class="modal" id="rolesModal" tabindex="-1" role="dialog" aria-labelledby="rolesModalLabel" aria-hidden="true">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rolesModalLabel">Crear/Editar Rol</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form  id="formulario" >

                    <input type="hidden" name="ID_ROL" id="ID_ROL">
                    <input type="hidden" id="cantMenus" value="<?= count($menus)?>">
                    <input type="text" id="res">
                    <div class="form-group">
                        <label for="">Nombre del Rol</label>
                        <input name="NOMBRE_ROL" id="NOMBRE_ROL" onkeyup="validar_nombre(this)" onblur="validar_nombre(this)" type="text" class="form-control" id="" placeholder="Nombre del rol">
                        <div class="invalid-feedback" style="display:none">
                            El nombre no debe comenzar con números ni caracteres especiales
                        </div>
                    </div>
                    <label for="">Menús</label>
                    <?php foreach ($menus as $index => $menus) : ?>
                      <div class="card card-body" id="">
                      <div class="form-group card-header">
                        <div class="form-check">
                          <input class="form-check-input padre<?= $index?>" type="checkbox" id="menu-padre" name="menu[]" value="<?= $menus["ID_MENU"] ?>">
                          <label class="form-check-label"><strong><?= $menus["NOMBRE_MENU"] ?></strong></label>
                        </div>
                      </div>
                      <br>
                      <div class="row">
                      <?php foreach ($menus['submenus'] as $submenu): ?>
                        <div class="form-group col-lg-3 col-6">
                          <div class="form-check">
                            <input class="form-check-input hijo<?=$index?>" type="checkbox" name="menu[]" id="menu-hijo" value="<?= $submenu["ID_MENU"] ?>">
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

<script src="<?= base_url() ?>/js/roles/roles.js"></script>


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