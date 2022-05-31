$(function(){
    setInterval('nowDate()',1000);
  });
  
  function nowDate(){
    $.ajax({
      url: 'date.php',
      type: 'GET',
      timeout: 10000,
    })
    .done(function(result){
      showNowDate(result);
    });
  }
  
  function showNowDate(date){
    document.getElementById('nowDate').textContent = date;
  }
  
  