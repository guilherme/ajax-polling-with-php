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
      <li id="<?php echo $message['id']; ?>">
        <span><?php echo $message['user']; ?></span>
        <span><?php echo $message['time'];   ?></span>
        <span><?php echo $message['message']; ?></span>
      </li>
    <?php }; ?>
  <?php } else { ?>
    <li id="0"> Nenhuma mensagem enviada ainda </li>
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
<script type='text/javascript'>
  var format_message = function(json) {
    var user    = '<span>'+json.user+'</span>';
    var time    = '<span>'+json.time+'</span>';
    var message = '<span>'+json.message+'</span>';
    return '<li id="'+json.id+'">' +
                  user +
                  time +
                  message +
                  '</li>';

  };
  var getChatMessages = function() {
    var since_id = $("#messages li:last-child").attr('id');
    $.ajax({
      url: 'get_messages.php',
      type: 'GET',
      data: { 'since_id': since_id },
      success: function(data,textStatus) {
        if(data.length) {
          $.each(data, function(i) {
            var msg = format_message(this);
            $("#messages").append(msg);
          });
        }
      },
      dataType: "json"
    });
  };
  var polling = setInterval(getChatMessages,1000);

</script>
</body>
