$(document).on("click","#presupuesto_fecha",function(){ 
    //codigo
   
  
    var desde=     $('#desde').val();
    var hasta  =  $('#hasta').val();

    window.open('../generar_presupuesto/imprimir/'+desde+'/'+hasta+'/');
  
  
      });
  
  