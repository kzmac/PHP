var not = -1;

function buttonCounter(){
    not++;
    document.getElementById("PUSH").innerHTML = not;
    oddEven = not%2;

    if(oddEven >= 0){
        console.log(oddEven);
        if(oddEven==1){
            finishTime();
            workingHours(); 
        }else{
            if(oddEven==0){
                lapTime(); 
            }
        }
    }else{
        return false
    }
}