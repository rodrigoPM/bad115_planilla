function Buscar() {

    var par = document.getElementById("codigo").value;
    
   if (par === ""){
   
   
   
     var xmlhttp = new XMLHttpRequest();
     xmlhttp.onreadystatechange = function() {
       if (this.readyState == 4 && this.status == 200) {
   
   
         document.getElementById("cambio").innerHTML = this.responseText;
   
       
       }
     };
     xmlhttp.open("GET", "../boleta_pago/view/", true);
     xmlhttp.send();  
   
   }
   else{
     var xmlhttp = new XMLHttpRequest();
     xmlhttp.onreadystatechange = function() {
       if (this.readyState == 4 && this.status == 200) {
   
   
         document.getElementById("cambio").innerHTML = this.responseText;
   
       
       }
     };
     xmlhttp.open("GET", "../boleta_pago/view/"+par, true);
     xmlhttp.send();  
     
   }
   }





   $(document).on("click","tr td #imprimir",function(){ 
    //codigo
   
  
    var ident=   $(this).parents('tr').find('th.idelemento').text();
    var codigo  =  $(this).parents('tr').find('td.codigo_p').text();

    window.open('../boleta_pago/imprimir/'+ident+'/'+codigo+'/');
  
  
      });