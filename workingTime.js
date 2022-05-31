function workingHours(){
    $.ajax({
        url: 'workingTime.php',
        type: 'GET',
        timeout: 10000,
    }).done(function(result){
        timeOutput(result);
        console.log(result);
    })
};

function timeOutput(time){
    document.getElementById("workingHours").style.display = "block";
    document.getElementById('workingHours').textContent = "勤務時間:"+time+"秒";
}