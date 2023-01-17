<?php
  require_once('../open_connection.php');

  $course_code = $_POST['course_code'];
  $course_class = $_POST['course_class'];
  $title = $_POST['title'];
  $content = $_POST['content'];

  $query = mysqli_multi_query($CON, "
  INSERT INTO announcement (id_course, title, content, datetime)
  VALUES ((SELECT id FROM courses WHERE code='$course_code' AND class='$course_class'), '$title', '$content', NOW());

  SET @inserted_id = LAST_INSERT_ID();

  INSERT INTO announcement_participants(id_announcements, id_students) 
  SELECT @inserted_id AS id_announcements, student_id AS id_students FROM course_participants WHERE course_id=(SELECT id FROM courses WHERE code='$course_code' AND class='$course_class');
  ");

  if ($query) {
    echo json_encode([
      "error" => false,
      "message" => 'Announcement has been successfully announced!'
    ]);
  } else {
    echo json_encode([
      "error" => true,
      "message" => 'Announcement failed to be announced!'
      // "message" => mysqli_error($CON)
    ]);
  }

  require_once('../close_connection.php');
?>