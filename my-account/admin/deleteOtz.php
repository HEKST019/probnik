<?php
  require '../configDB.php';

  $id = $_GET['id'];

  $sql = 'DELETE FROM `st_taskspol` WHERE `id` = ?';
  $query = $pdo->prepare($sql);
  $query->execute([$id]);


  header('Location: ../../отзывы/index.php');
?>
