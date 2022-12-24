<?php
  require_once('../connection.php');

  $username = $_POST['username'];
  $password = $_POST['password'];

  if (!$username || !$password) {
    echo json_encode(array('message'=>'required field is empty.'));
  } else {
    $query = mysqli_query($CON, "INSERT INTO accounts VALUES ('', '$username','$password')");
    if ($query) {
      echo json_encode(array('message'=>'account data successfully added.'));
    } else {
      echo json_encode(array('message'=>'account data failed to add.'));
    }
  }
?>