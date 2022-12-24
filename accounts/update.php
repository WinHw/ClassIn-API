<?php
  require_once('../connection.php');

  $id = $_POST['id'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  if(!$username || !$password || !$id){
    echo json_encode(array('message'=>'required field is empty.'));
  } else {
    $query = mysqli_query($CON, "UPDATE accounts SET username='$username', password='$password' WHERE id = '$id'");
    if($query){
      echo json_encode(array('message'=>'account data successfully updated.'));
    }else{
      echo json_encode(array('message'=>'account data failed to update.'));
    }
  }
?>