<?php

  $login = filter_var(trim($_POST['username']),
  FILTER_SANITIZE_STRING);
  $password = filter_var(trim($_POST['password']),
  FILTER_SANITIZE_STRING);
  $nicename = $login;
  $displayname = $login;
  $currentDateTime = date("Y-m-d H:i:s");

  if (mb_strlen($login) < 5 || mb_strlen($login) > 90) {
    echo "<p>Недопустимая длина логина</p>";
    exit();
  } else if (mb_strlen($password) < 4 || mb_strlen($password) > 40) {
    echo "<p>Недопустимая длина пароля</p>";
    exit();
  }

  require "../blocks/connect.php";

  // Проверка на существование пользователя с таким логином
  $check_query = $mysql->query("SELECT * FROM `st_users` WHERE `user_login` = '$login'");

  if ($check_query->num_rows > 0) {
    echo "<p>Пользователь с таким логином уже существует</p>";
    $mysql->close();
    exit();
  }

  $password = md5($password."dfghwqp4657");

  $mysql->query("INSERT INTO `st_users`( `user_login`, `user_pass`,`user_nicename`,`display_name`, `user_registered`) VALUES ('$login','$password','$nicename','$displayname','$currentDateTime')");

  $mysql->close();

  header('Location: ../');
?>
