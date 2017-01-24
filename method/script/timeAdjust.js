$( function() {
    //時段
    $("#appearTime").timepicker({
          timeFormat: 'H',//24小時
          minTime:'08',
           interval: 60,
           dynamic: false,
          maxTime:'6:00pm',
          startTime:'09:00',
          defaultTime:'08'
       });
 } );
    $( function() {
        $( "#endDate" ).datepicker();
      } );
