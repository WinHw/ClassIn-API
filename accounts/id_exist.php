<?php
  require_once('../open_connection.php');

  $id = $_POST['id'];
  
  $query = mysqli_query($CON,"SELECT EXISTS(SELECT * FROM accounts WHERE id = '$id')");
  $result = mysqli_fetch_row($query)[0];
  http_response_code(200);
  echo json_encode($result);

  require_once('../close_connection.php');
?>