<?php
  require_once('../open_connection.php');

  $username = $_POST['username'];
  $password = $_POST['password'];
  
  $query = mysqli_query($CON,"SELECT id, name, level FROM accounts WHERE username='$username' AND password='$password'");
  $result = mysqli_fetch_assoc($query);

  if ($result) {
    http_response_code(200);
    echo json_encode($result);
  } else {
    http_response_code(404);
    exit;
  }

  require_once('../close_connection.php');
?>