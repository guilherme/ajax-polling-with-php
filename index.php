<?php
  require('connection.php');
  $sql = "SELECT * FROM messages ORDER BY id ASC";
  $res = mysql_query($sql,$connection);
  if(!$res) {
   die("Erro ao pegar mensagens enviadas" . mysql_error());
  }
  $user_agent =  $_SERVER['HTTP_USER_AGENT'];
  if(preg_match('/Chrome/i',$user_agent)) {
    $user = "chrome";
  } else {
    $user = 'firefox';
  };

?>
<html>
<head>
<title>Teste</title>
<script type='text/javascript' src='javascripts/jquery.min.js'></script>
</head>
<html>
<body>
<div id="chat">
<ul id="messages">
<?php if(mysql_num_rows($res)) { ?>
  <?php while($message = mysql_fetch_array($res)) { ?>
    <li>
      <span><?php echo $message['user']; ?></span>
      <span><?php echo $message['time'];   ?></span>
      <span><?php echo $message['message']; ?></span>
    </li>
  <?php }; ?>
<?php } else { ?>
  <li> Nenhuma mensagem enviada ainda </li>
<?php }; ?>
</ul>

</div>
<div id="message">
  <form action="send_message.php" method="POST">
    <input type='hidden' name='user' id='user' value="<?php echo $user; ?>">
    <textarea id="message" name="message" rows=4 cols=80></textarea>
    <input type="submit" value="Enviar" />
  </form>
</div>

</body>
