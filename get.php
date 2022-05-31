<?php

    $startDateTime  = $_POST["startTime"];
    $finishDateTime = $_POST["finishTime"];
    $date = new DateTime(nowdate(), new DateTimeZone('Asia/Tokyo'));
    $timestamp = $date->format('U');
    $id= 1;


    $pdo = new PDO("mysql:host=localhost; port=5000; dbname=mydb", "root", "password");

    try{
        if(!$startDateTime==null){
            /*ここから*/
            $stmt = $pdo->prepare('SELECT * FROM date WHERE UNIXTIME = :UNIX');

            $stmt -> bindValue(':UNIX',$timestamp);

            $stmt ->execute();
        
            foreach ($stmt as $row) {
                $id+=1;
            }
            /*ここまで*/

            $nuwFinishDateTime = $startDateTime;

            $sql = "INSERT INTO date (UNIXTIME,id,start_time,finish_time) VALUES (:unix,:id,:start,:finish)";

            $stmt = $pdo->prepare($sql);

            // 挿入する値を配列に格納する
            $params = array( ':unix' => $timestamp , ':id' => $id , ':start' => $startDateTime , ':finish' => $nuwFinishDateTime);

            // 挿入する値が入った変数をexecuteにセットしてSQLを実行
            $stmt->execute($params);

        }elseif(!$finishDateTime==null){
            $stmt = $pdo->prepare('SELECT * FROM date WHERE UNIXTIME = :UNIX');

            $stmt -> bindValue(':UNIX',$timestamp);

            $stmt ->execute();
        
            foreach ($stmt as $row) {
                $id+=1;
            }

            $id-=1;

            $stmt = $pdo->prepare('SELECT * FROM date WHERE id = :id');

            $stmt -> bindValue(':id',$id);

            $stmt ->execute();
        
            foreach ($stmt as $row) {
                $row['start_time']=$start;
                $row['finish_time']=$finish;
            }

            if($start==$finish){
                $sql="UPDATE date SET finish_time = :finishTime WHERE id = :id";

                $stmt = $pdo ->prepare($sql);

                $params = array(':finishTime' => $finishDateTime, ':id' => $id);

                $stmt -> execute($params);  

            }
   
        }
    }catch(PDOException $e){
        var_dump($e->getMessage());
    }

    function nowdate(){
        date_default_timezone_set('Asia/Tokyo');
    
        date_default_timezone_get();
        $now = date('Y-m-d');
        return $now;
      }
?>