<?php
  if($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("location: index.php");
    exit(0);
  }
  require('connection.php');

  $user = $_POST['user'];
  $message = $_POST['message'];
  $sql = "INSERT INTO messages (user,time,message) VALUES('$user',now(),'$message');";
  $res = mysql_query($sql,$connection);
  if(!$res) {
    die("Erro ao enviar mensagem:".mysql_error());
  }

  flush();
  header("location: index.php");
?>
