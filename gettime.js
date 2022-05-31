$(function(){
  setInterval('nowTime()',1000);
});

function nowTime(){
  $.ajax({
    url: 'time.php',
    type: 'GET',
    timeout: 10000,
  })
  .done(function(result){
    showNowTime(result);
  });
}

function showNowTime(time){
  document.getElementById('nowTime').textContent = time;
}

