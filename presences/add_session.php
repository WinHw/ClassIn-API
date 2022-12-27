<?php
  require_once('../open_connection.php');

  $course_id = $_POST['course_id'];
  $start = $_POST['start_datetime'];
  $end = $_POST['end_datetime'];

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

  require_once('../close_connection.php');
?>