<?php
  $status = $_POST['status'];
  $current_user = $_POST['order_ID'];



  require '../../configDB.php';

  // SQL запрос для UPDATE с использованием логина из куки
  $sql = 'UPDATE st_order_stats SET
          status = :status
          WHERE order_id = :order_ID';

  $query = $pdo->prepare($sql);
  $query->execute([
      'status' => $status,
      'order_ID' => $current_user // Используем логин из куки
  ]);


  header('Location: status.php');
?>
