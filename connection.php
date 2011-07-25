<?php
$connection = mysql_connect('localhost', 'root', '');
if (!$connection) {
    die('Could not connect: ' . mysql_error());
}
$db = mysql_select_db('chat_development',$connection);
if(!$db) {
    die('Could select database: ' . mysql_error());
}

?>
