<?php

try {
    // MySQLサーバへ接続
    $pdo = new PDO("mysql:host=localhost; port=5000; dbname=mydb", "root", "password");

    $sql = "INSERT INTO date (start_time,finish_time) VALUES (:start,:finish)";

    $stmt = $pdo->prepare($sql);

    // 挿入する値を配列に格納する
    $params = array(':start' => '10:00:00' , ':finish' => '19:00:00');
    
    // 挿入する値が入った変数をexecuteにセットしてSQLを実行
    $stmt->execute($params);
    
    // 登録完了のメッセージ
    echo '登録完了しました';

} catch(PDOException $e){
    var_dump($e->getMessage());
}

?>