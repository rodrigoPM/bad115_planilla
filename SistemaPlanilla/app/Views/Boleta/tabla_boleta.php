<table id="" class="table table-bordered table-hover">
  <thead >
    <tr>

      <th>Nombre</th>
      <th>Numero de documento</th>
	  <th>Codigo de la planilla correspondiente</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($boletas as $boleta): ?>
    <tr>
  
      <td><?= $boleta['nombre_c'] ?></td>
      <td><?= $boleta['NUMERO_DOCUMENTO'] ?></td>
	  <td><?= $boleta['CODIGO'] ?></td>
      <td>
      <button href="#" id="imprimir" role="button" class="btn btn-danger"><i class="icon fas fa-book"></i></button>
     
      </td>
    </tr>
    <?php endforeach; ?> 

       
  </tbody>
</table>