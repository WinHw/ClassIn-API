<?php
  require_once('../connection.php');

  $username = $_POST['username'];
  $password = $_POST['password'];
  
  $query = mysqli_query($CON,"SELECT id FROM accounts WHERE username='$username' AND password='$password'");
  $result = mysqli_fetch_row($query);
  $data['id'] = $result[0] ?? null;

  if ($data['id']) {
    http_response_code(200);
    echo json_encode($data);
  } else {
    http_response_code(404);
    exit;
  }
?>