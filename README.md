mx.class.php
============

[DEMO]<br />
1.mx.mysql.php<br />
<?php<br />
  require_once('mx.mysql.php');<br />
  $mysql = new mysql();<br />
  $mysql->openDb();<br />
  $mysql->runSQL('CREATE TABLE `test_table`');<br />
  $data = $mysql->getData('SELECT * FROM `test_data` LIMIT 1');<br />
  print_r($data);<br />
  $mysql->closeDb();<br />
?><br />

you can edit mysql connect setting in mx.mysql.php<br />

2.mx.request.php<br />
<?php<br />
  require_once('mx.request.php');<br />
  $ch = new curl();<br />
  $data = array(<br />
    'post'=>'post',<br />
    'get'=>'get'<br />
  );<br />
  $result1 = $ch->POST('http://www.test.com/post',$data);<br />
  $result2 = $ch->GET('http://www.test.com/get',$data);<br />
  $result = array($result1,$result2);<br />
  echo json_encode($result);<br />
?>
