<?php
  $mysql = new mysqli('localhost', 'root', 'root', 'wordpress');
  if ($mysql ->connect_echo) exit('ошибка подключения');
  $mysql ->set_charset('utf8');

?>
