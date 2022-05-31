function finishTime(){
    $.ajax({
        url: 'date.php',
        type: 'GET',
        timeout: 10000,
      })
      .done(function(date){
          $.ajax({
              url: 'time.php',
              type: 'GET',
              timeout: 10000,
            })
            .done(function(time){
                finish(date,time);
                $.ajax({
                  url: 'get.php',
                  type: 'POST',
                  timeout: 10000,
                  data : {"finishTime":time}
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
  
  function finish(date,time){
    document.getElementById("finishTime").style.display = "block";
    document.getElementById('finishTime').textContent = "退勤時刻:"+date+" "+time;
  }