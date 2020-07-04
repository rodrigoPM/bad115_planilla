
<div id="tabla">

<table id="" class="table table-bordered table-hover">
  <thead >
    <tr>
    <th>Correlativo</th>
    <th hidden="true">identificador</th>
      <th>Nombre</th>
      <th>Departamento perteneciente</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($areas as $index => $area):?>
    <tr>
    <th scope="row"><?=$index+1?></th>
    <th scope="row" class='idelemento' hidden="true"><?= $area['IDAREA'] ?></th>
    <th scope="row" class='idelemento2' hidden="true"><?= $area['ID_DEPARTAMENTO_EMPRESA'] ?></th>
    
      <td class='id_nombre_depto'><?= $area['NOMBRE_AREA'] ?></td>
      <td><?= $depto_empresa->get($area['ID_DEPARTAMENTO_EMPRESA'])[0]['NOMBRE_DEPARTAMENTO_EMPRESA']?></td>
      <td>
      <button href="#" id="delete" role="button" class="btn btn-danger"><i class="icon fas fa-trash"></i></button>
      <button href="#"  id="edit" role="button" class="btn btn-primary col-5" ><i class="icon fas fa-pen"></i></button>
      
      </td>
    </tr>
    <?php endforeach; ?> 

       
  </tbody>
</table>

</div>