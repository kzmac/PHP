function lapTime(){
    $.ajax({
      url: 'date.php',
      type: 'GET',
      timeout: 10000,
    })
    .done(function(date){
        $.ajax({
            url: 'time.php',
            type: 'GET',
            timeout: 10000
          })
          .done(function(time){
            lap(date,time);
            $.ajax({
              url: 'get.php',
              type: 'POST',
              timeout: 10000,
              data : {"startTime":time}
            })
            .done(function(){
                console.log(time);
            })
            .fail(function(){
              console.log("ng");
            })
          });
    });
  }
  
  function lap(date,time){
    document.getElementById("lapTime").style.display = "block";
    document.getElementById('lapTime').textContent = "打刻時刻:"+date+" "+time;
  }