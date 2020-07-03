

<div id="tabla">

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <center>
    <img class="navbar-brand-full" src="img/sin_backup.png"  alt="encabezado" text-align:center>
    </center>
    <style>
        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            font-size: 0.875rem;
            font-weight: normal;
            line-height: 1.5;
            color: #151b1e;           
        }
        .table {
            display: table;
            width: 100%;
            max-width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
            border-collapse: collapse;
        }
        .table-bordered {
            border: 1px solid #c2cfd6;
        }
        thead {
            display: table-header-group;
            vertical-align: middle;
            border-color: inherit;
        }
        tr {
            display: table-row;
            vertical-align: inherit;
            border-color: inherit;
        }
        .table th, .table td {

            text-align: center;
            vertical-align: top;
            border-top: 1px solid #c2cfd6;
        }
        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #c2cfd6;
        }
        .table-bordered thead th, .table-bordered thead td {
            border-bottom-width: 2px;
        }
        .table-bordered th, .table-bordered td {
            border: 1px solid #c2cfd6;
        }
        th, td {
            display: table-cell;
            vertical-align: inherit;
        }
        th {
            font-weight: bold;
            text-align: -internal-center;
            text-align: left;
        }
        tbody {
            display: table-row-group;
            vertical-align: middle;
            border-color: inherit;
        }
        tr {
            display: table-row;
            vertical-align: inherit;
            border-color: inherit;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }
        #pie {
        position: fixed;
        width: 100%;
        height: 100px;
        top: auto;
        right: 0;
        bottom: 0px;
        left: 0;

      }
        .izquierda{
            float:left;
        }
        .derecha{
            float:right;
        }
    </style>
</head>
<body>
    <div>
        <h3>Boleta de pago. <span class="derecha">Fecha:<?= date('d/m/Y') ?></span></h3>
        <br>
        <h3>Datos del empleado</h3>
    </div>
    <div>
         <table class="table table-bordered table-striped table-sm">
         
    <tr>

      <th>Nombre</th>
      <th>Direccion</th>
      <th>Telefono</th>
      <th>Numero de documento</th>
      <th>Salario base</th>
      <th>Salario liquido</th>
   
    </tr>
  </thead>
  <tbody>
  <?php foreach ($boletas as $index => $boleta):?>
    <tr>

      
      <td ><?= $boleta['nombre_c'] ?></td>
      <td ><?= $boleta['direccion'] ?></td>
      <td ><?= $boleta['telefonos'] ?></td>
      <td ><?= $boleta['NUMERO_DOCUMENTO'] ?></td>
      <td ><?= $boleta['MONTO'] ?></td>
      <td ><?= $boleta['liquido'] ?></td>
          </tr>
    <?php endforeach; ?> 

       
  </tbody>
</table>

<br>

<h3>Informacion acerca de los descuentos y los ingresos</h3>


     <table class="table table-bordered table-striped table-sm">
         
         <tr>
     
           <th>Concepto</th>
           <th>Tipo</th>
           <th>Monto</th>
          
        
         </tr>
       </thead>
       <tbody>
       <?php foreach ($detalles as $index => $detalle):?>
         <tr>
     
           
           <td ><?= $detalle['NOMBRE_CONCEPTO'] ?></td>
           <?php if ($detalle['TIPO'] =='1'): ?>
           <td>ingreso</td>
    
  <?php else : ?>
    <td>Descuento</td>
    </div>
  <?php endif ?>
           
           <td ><?= $detalle['MONTO'] ?></td>
               </tr>
         <?php endforeach; ?> 
     
            
       </tbody>
     </table>
     







                   
    </div>
    <div id="pie"><img   src="img/sin_backup.png"  alt="encabezado" text-align:center></div>   
</body>
</html>

