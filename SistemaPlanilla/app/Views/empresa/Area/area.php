<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h2 class="card-title"><b>Area</b></h2>
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

echo view('empresa/Area/Busqueda');


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
                <h5 class="modal-title" id="generoModalLabel">Crear nueva unidad</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form  id="formulario" >

                    <input type="hidden" name="IDAREA" id="IDAREA">
                    <div class="form-group">
                        <label for="">Nombre del area</label>
                        <input name="NOMBRE_AREA" id="NOMBRE_AREA" onkeyup="validar_nombre(this)" onblur="validar_nombre(this)" type="text" class="form-control" placeholder="Nombre del area">
                        <div class="invalid-feedback" style="display:none">
                            El nombre no debe comenzar con números ni caracteres especiales
                        </div>
                    </div><div class="form-group">
                    <label>Departamentos</label>
                    <select required name="ID_DEPARTAMENTO_EMPRESA" id="ID_DEPARTAMENTO_EMPRESA"  class="form-control select2" style="width: 100%;">
                        <?php foreach ($lista_u as $index => $l_unidades) : ?>
                            <option value="<?= $l_unidades['ID_DEPARTAMENTO_EMPRESA'] ?>"><?= $l_unidades['NOMBRE_DEPARTAMENTO_EMPRESA'] ?></option>
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
<script src="<?= base_url() ?>/js/depto_empresa/area.js"></script>
 