<?php
$login = filter_var(trim($_POST['username']),
FILTER_SANITIZE_STRING);
$pass = filter_var(trim($_POST['password']),
FILTER_SANITIZE_STRING);

$pass = md5($pass."dfghwqp4657");

require "../blocks/connect.php";

$result = $mysql->query("SELECT * FROM `st_users` WHERE `user_login` = '$login'
AND `user_pass` = '$pass'");
$user = $result->fetch_assoc();
if (count($user) == 0) {
  echo "<p>Такой пользователь не найден</p>";
  exit();
}

setcookie('user', $user['user_login'], time() + 3600, "/");
setcookie('user_id', $user['ID'], time() + 3600, "/");

$mysql->close();

header('Location: ../');
?>
