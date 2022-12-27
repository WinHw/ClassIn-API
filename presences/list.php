<?php
  require_once('../open_connection.php');
  
  $courseID = $_GET['course_id'];
  $result = [];

  $update = mysqli_query($CON, "UPDATE course_presences set status = 'closed' WHERE end < sysdate()");
  if ($update) {
    $query = mysqli_query($CON, "SELECT * FROM course_presences WHERE course_id = '$courseID' ORDER BY start DESC");
    while ($row = mysqli_fetch_assoc($query)) $result[] = $row;
    echo json_encode($result);
  } else {
    http_response_code(500);
    echo mysqli_error($CON);
  }

  require_once('../close_connection.php');
?>