<?php
  require_once('../open_connection.php');

  $id = $_GET['id'];
  if(!$id){
    echo json_encode(array('message'=>'required field is empty'));
  } else {
    $query = mysqli_query($CON, "DELETE FROM accounts WHERE id='$id'");
    if ($query) {
      echo json_encode(array('message'=>'accounts data successfully deleted.'));
    } else {
      echo json_encode(array('message'=>'accounts data failed to delete.'));
    }
  }

  require_once('../close_connection.php');
?>