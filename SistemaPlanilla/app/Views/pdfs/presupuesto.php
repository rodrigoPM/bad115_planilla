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
    <center><h3>                                                       Presupuesto</h3></center>    
        <h3><span style=" float:right;">Fecha de consulta:<?= date('d/m/Y') ?></span></h3>

        <br>
        <h3> Periodo Desde <span><?=  date('d/m/Y', strtotime($desde))  ?></span>   <span style=" float:right;">Hasta  <?= date('d/m/Y', strtotime($hasta)) ?></span></h3>
        
    </div>
    <div>
         <table class="table table-bordered table-striped table-sm">
         
    <tr>

      <th>Nombre_Departamento</th>
      <th>Monto_ejecutado</th>
      <th>MontoPresupuestado</th>
      <th>Pendiente_Ejecutar</th>
        
    </tr>
  </thead>
  <tbody>
  <?php foreach ($presupuestos as $p ):?>
    <tr>

      
      <td ><?= $p['Nombre_Departamento_Empresa'] ?></td>
      <td ><?= $p['Monto_Ejecutado'] ?></td>
      <td ><?= $p['MontoPresupuestado'] ?></td>
      <td ><?= $p['Pendiente_Ejecutar'] ?></td>
 
          </tr>
    <?php endforeach; ?> 

       
  </tbody>
</table>


     <center>

     <br> 
     <strong> ______________________</strong>
     <br>
     
     <strong>           FIRMA DEL Gerente de finanzas </strong>
    
    </center>
  
    
    
                   
    </div>
    <div id="pie"><img   src="img/sin_backup.png"  alt="encabezado" text-align:center></div>   
</body>
</html>
