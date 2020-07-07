<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h2 class="card-title"><b>Subsecciones</b></h2>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="row mb-3">
          <div class="col-4">
            <button type="button" class="btn  btn-success col-8" id="nuevo">Nuevo</button>
          </div>
          <div class="col-8">


<div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Buscar" aria-label="Search" id="busqueda" onkeyup="Buscar()">
        <div class="input-group-append">
        <button class="btn btn-secondary" disabled>
                    <i class="fas fa-search"></i>
                  </button>
        </div>
      </div>



          </div>
        </div>


<div id="cambio">
<?php

echo view('empresa/subsecciones/busqueda');


?>





</div>



      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>




<div class="modal" id="unidadesModal" tabindex="-1" role="dialog" aria-labelledby="unidadesModalLabel" aria-hidden="true">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="generoModalLabel">Crear nueva subseccion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form  id="formulario" >

                <input type="hidden" name="ID_SUB_SECCION" id="ID_SUB_SECCION">
                    <div class="form-group">
                        <label for="">Nombre de la Subseccion</label>
                        <input name="NOMBRE_SUB_SECCION" id="NOMBRE_SUB_SECCION" onkeyup="validar_nombre(this)" onblur="validar_nombre(this)" type="text" class="form-control" require placeholder="ingrese el nombre de la seccion">
                        <div class="invalid-feedback" style="display:none">
                        El nombre no debe comenzar con números ni caracteres especiales
                        </div>
                    </div>
                    
                                              <div class="form-group">
                    <label>Seccion</label>
                    <select required name="ID_SECCION" id="ID_SECCION"  class="form-control select2" style="width: 100%;">
                        <?php foreach ($lista_s as $index => $l_seccion) : ?>
                            <option value="<?= $l_seccion['ID_SECCION'] ?>"> <?= $l_seccion['NOMBRE_SECCION'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>




                    <button id="btn_submit" disabled  type="submit" class="btn btn-success btn-block">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>



<?php echo $paginador->links(); ?>
<script src="<?= base_url() ?>/js/empleados/subsecciones.js"></script>
 