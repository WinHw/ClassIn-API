<?php
  require_once('../open_connection.php');
  
  $accID = $_GET['accID'];
  $level = $_GET['level'];
  $result = [];
  $query_builder = "
  SELECT DISTINCT
  c.id as course_id,
  c.code as course_code,
  cd.name as course_name,
  c.class as course_class,
  c.semester as course_semester,
  c.year as course_year,
  c.status as course_status,
  c.lecturer_id as lecturer_id,
  a.name as lecturer_name
  FROM courses c
  INNER JOIN course_details cd ON cd.code = c.code
  INNER JOIN course_participants cp ON cp.course_id = c.id
  INNER JOIN accounts a ON a.id = c.lecturer_id
  WHERE ";
  
  switch($level) {
    case 'student':
      $query_builder .= "cp.student_id = '$accID' AND ";
      break;
    case 'lecturer':
      $query_builder .= "c.lecturer_id = '$accID' AND ";
      break;
    default:
      break;
  };

  $query_builder .= "c.status = 'active'";
  $query = mysqli_query($CON, $query_builder);
  while ($row = mysqli_fetch_assoc($query)) $result[] = $row;
  
  echo json_encode($result);

  require_once('../close_connection.php');
?>