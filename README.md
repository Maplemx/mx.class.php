mx.class.php
============

[DEMO]
1. mx.mysql.php
<?php
  require_once('mx.mysql.php');
  $mysql = new mysql();
  $mysql->openDb();
  $mysql->runSQL('CREATE TABLE `test_table`');
  $data = $mysql->getData('SELECT * FROM `test_data` LIMIT 1');
  print_r($data);
  $mysql->closeDb();
?>
//you can edit mysql connect setting in mx.mysql.php

2. mx.request.php
<?php
  require_once('mx.request.php');
  $ch = new curl();
  $data = array(
    'post'=>'post',
    'get'=>'get'
  );
  $result1 = $ch->POST('http://www.test.com/post',$data);
  $result2 = $ch->GET('http://www.test.com/get',$data);
  $result = array($result1,$result2);
  echo json_encode($result);
?>
