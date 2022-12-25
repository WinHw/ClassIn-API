<?php
  require_once('../open_connection.php');
  
  $id = $_GET['id'];
  $query = mysqli_query($CON,"SELECT * FROM accounts WHERE id = '$id'");
  $result = mysqli_fetch_assoc($query);
  echo json_encode($result);

  require_once('../close_connection.php');
?>