<?php
  require_once('../open_connection.php');

  $course_id = $_POST['course_id'];
  $description = $_POST['description'];
  $start = $_POST['start_datetime'];
  $end = $_POST['end_datetime'];
  $location = "";

  $query = mysqli_multi_query($CON, "
  INSERT INTO course_presences (course_id, start, end, location, description)
  VALUES ('$course_id', '$start', '$end', '$location', '$description');
  SET @inserted_id = LAST_INSERT_ID();
  INSERT INTO participants_presences
  (course_presence_id, participant_id)
  SELECT @inserted_id as course_presence_id, id as participant_id FROM course_participants WHERE course_id = '$course_id' ;
  ");

  if ($query) {
    echo json_encode([
      "error" => false,
      "message" => 'Session is successfully added'
    ]);
  } else {
    echo json_encode([
      "error" => true,
      "message" => 'Session is failed to be added'
      // "message" => mysqli_error($CON)
    ]);
  }

  require_once('../close_connection.php');
?>