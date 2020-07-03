
<style>

  #calendar {
    max-width: 1100px;
    margin: 0 auto;
  }
</style>

  <div id='calendar' class="mb-5"></div>

  <script>      
      let my_events = <?= $eventos?>;
      function eliminar(arg){
        Swal.fire({
          title: 'Eliminar?',
          text: "El evento sera eliminado permanentemente!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText: 'Cancelar',
          confirmButtonText: 'Si, Eliminar'
        }).then((result) => {
          if (result.value) {
            $.post("<?= $url_eliminar?>",
                {
                    'ID_EVENTO': arg.event._def.publicId,
                },
                function(data, status){
                    console.log(data);
                    if(status == 'success'){
                      arg.event.remove()

                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Eliminacion Exitosa',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                });
          }
        })

      }

      function get_fecha(fecha){
        let year = fecha.getFullYear();
        let mes = fecha.getMonth() +1;
        let dia = fecha.getDate();
        return year + '-' +mes + '-'+dia;
      }

      function crear(arg){
        Swal.fire({
            title: 'Titulo del evento',
            input: 'text',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Crear',
            showLoaderOnConfirm: true,
            preConfirm: (titulo) => {
                $.post("<?= $url_guardar?>",
                {
                    'FECHA_INICIO': get_fecha(arg.start),
                    'FECHA_FIN':  get_fecha(arg.end),
                    'TITULO': titulo,
                },
                function(data, status){
                    console.log(data);
                    if(status == 'success'){
                        calendar.addEvent({
                            id : data,
                            title: titulo,
                            start: arg.start,
                            end: arg.end,
                            allDay: arg.allDay
                        })

                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Exito',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                    
                });
            },
            allowOutsideClick: () => !Swal.isLoading()
        });
        calendar.unselect()
      }     
  </script>