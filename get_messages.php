<?php
  require("connection.php");
  $sql = "SELECT * FROM messages WHERE id >= ".(int)$_GET['since_id']." ORDER BY id ASC";
  $res = mysql_query($sql,$connection);
  if(!$res) {
    die("Erro ao executar a query $res ".mysql_error());
  }
  header('content-type: application/json');
  if(mysql_num_rows($res)) {
    while($message = mysql_fetch_array($res)) {
      echo '{ "user": "'.$message['user'].'", "time": '.$message['time'].', "message": "'.$message['message'].'" },';
    }
  } else {
    echo '{}';
  }
?>
