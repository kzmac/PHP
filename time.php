<?php

  function nowtime(){
    date_default_timezone_set('Asia/Tokyo');

    date_default_timezone_get();
    $now = date('H:i:s');
    return $now;
  }

  echo nowtime();
?>