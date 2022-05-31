<?php

  function nowdate(){
    date_default_timezone_set('Asia/Tokyo');

    date_default_timezone_get();
    $now = date('Y/m/d');
    return $now;
  }

  echo nowdate();
?>