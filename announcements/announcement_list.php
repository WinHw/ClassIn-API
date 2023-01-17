<?php
  require_once('../open_connection.php');
  
  $accID = $_GET['accID'];

  $result = [];

  $query_builder = "
  SELECT 
  a.id_announcement AS announcementID,
  c.id AS courseID,
  c.code AS courseCode,
  c.class AS courseClass,
  a.title AS title,
  a.content AS content,
  a.datetime AS dateTime
  FROM announcement a JOIN courses c ON a.id_course = c.id
  WHERE c.lecturer_id = '$accID'
  ORDER BY dateTime DESC;";

  $query = mysqli_query($CON, $query_builder);

  while ($row = mysqli_fetch_assoc($query)) $result[] = $row;
  
  echo json_encode($result);

  require_once('../close_connection.php');
?>