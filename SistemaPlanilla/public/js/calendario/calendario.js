    var initialLocaleCode = 'es';
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,listMonth'
      },
      initialDate: new Date(),
      locale: initialLocaleCode,
      navLinks: true, // can click day/week names to navigate views
      selectable: true,
      selectMirror: true,
      select: crear,
      eventClick: eliminar,
      editable: true,
      dayMaxEvents: true, // allow "more" link when too many events
      events: my_events,
      
    });

    calendar.render();

let contador = 0;


    $('.fc-button-group .fc-prev-button span').click(function(){
        contador--;
        console.log('mes anterior', contador);
        
     });

     $('.fc-button-group .fc-next-button span').click(function(){
        contador++;
        console.log('mes siguiente', contador);
        
     });
     
