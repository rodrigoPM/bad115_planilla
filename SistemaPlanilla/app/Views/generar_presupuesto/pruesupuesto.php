<div>
    <div class="text-center bg-primary p-1">
      <h2>Reporte </h2>
      <h4>para</h4>
      <h3>Manejo de Presupuesto</h3>
      
    </div>

<center>

<div class="rounded" style="background:lightblue;" >
      
          
        <div class="col-6">
          <div class="form-group">
            <label >Ingrese una fecha para consultar el estado del presupuesto</label>
              <input class="form-control" type="date" placeholder="ingrese a partir del segundo del mes" name="f_fin" id="hasta">
              
          </div>
        </div>

        <div class="col-12 text-center mt-5">
          <button class="btn btn-success btn-block" id="presupuesto_fecha"><b>Generar Reporte</b></button>
        </div>
      
    </div>
</center>
    
  </div>


  <script>
  


$(document).on("click","#presupuesto_fecha",function(){ 
    //codigo
   //codigo para imprimir
   //mandar a imprimir presupuesto
   
    var hasta  =  $('#hasta').val();


      window.open('../generar_presupuesto/imprimir/'+hasta);
  

  
      });






  
  
  
  </script>