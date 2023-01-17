<?php
  require_once('../open_connection.php');
  
  $result = [];
  $query = mysqli_query($CON,"SELECT * FROM accounts");
  while ($row = mysqli_fetch_assoc($query)) {
    $result[] = $row;
  }
  echo json_encode(array('result'=>$result));

  require_once('../close_connection.php');
?>