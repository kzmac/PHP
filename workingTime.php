<?php

function WorkingHour(){
    $date = new DateTime(nowdate(), new DateTimeZone('Asia/Tokyo'));
    $timestamp = $date->format('U');


    $pdo = new PDO("mysql:host=localhost; port=5000; dbname=mydb", "root", "password");

    try{
        // 条件指定したSQL文をセット
        $stmt = $pdo->prepare('SELECT (start_time) FROM date WHERE UNIXTIME = :unix');

        $stmt->bindValue(':unix', $timestamp);
    
        // SQL実行
        $stmt->execute();
    
        // 取得したデータを出力
        foreach ($stmt as $row) {
            $start[]=strtotime($row['start_time']);
        }

        // 条件指定したSQL文をセット
        $stmt = $pdo->prepare('SELECT (finish_time) FROM date WHERE UNIXTIME = :unix');

        $stmt->bindValue(':unix', $timestamp);
    
        // SQL実行
        $stmt->execute();
    
        // 取得したデータを出力
        foreach ($stmt as $row) {
            $finish[]=strtotime($row['finish_time']);
        }

        if(!$stmt=NULL){
            $result = [];
            foreach ($finish as $key => $val) {
                $result[] = $val - $start[$key];

                $sql="UPDATE date SET diff_time = :diff WHERE id = :key";

                $stmt = $pdo ->prepare($sql);

                $params = array(':diff' => $result[$key], ':key' => $key);

                $stmt -> execute($params); 

            }


            return array_sum($result);
        }
  

    }catch(PDOException $e){
        var_dump($e->getMessage());
    }
}

function nowdate(){
    date_default_timezone_set('Asia/Tokyo');

    date_default_timezone_get();
    $now = date('Y-m-d');
    return $now;
}

echo WorkingHour();



?>