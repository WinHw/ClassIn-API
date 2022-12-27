<?php
  require_once('../open_connection.php');
  
  $accID = $_GET['accID'];
  $level = $_GET['level'];
  $result = [];
  $query_builder = "";

  $update = mysqli_query($CON, "UPDATE course_presences set status = 'closed' WHERE end < sysdate()");
  if ($update) {
    switch($level) {
      case 'student':
        $query_builder .= "
        SELECT DISTINCT
        cpr.id as course_id,
        cd.name as course_name,
        c.class as course_class,
        a.name as course_lecturer,
        cpr.id as presence_id,
        cpr.start as presence_start,
        cpr.end as presence_end,
        cpr.description as presence_description
        FROM course_presences cpr
        INNER JOIN courses c ON c.id = cpr.course_id
        INNER JOIN course_details cd ON cd.code = c.code
        INNER JOIN accounts a ON a.id = c.lecturer_id
        INNER JOIN participants_presences pp ON pp.course_presence_id = cpr.id
        INNER JOIN course_participants cp ON cp.id = pp.participant_id
        WHERE c.status = 'active' AND cpr.status = 'opened' AND cp.student_id = '$accID'";
        break;
      case 'lecturer':
        $query_builder .= "
        SELECT DISTINCT
        cpr.id as course_id,
        cd.name as course_name,
        c.class as course_class,
        a.name as course_lecturer,
        cpr.id as presence_id,
        cpr.start as presence_start,
        cpr.end as presence_end,
        cpr.description as presence_description
        FROM course_presences cpr
        INNER JOIN courses c ON c.id = cpr.course_id
        INNER JOIN course_details cd ON cd.code = c.code
        INNER JOIN accounts a ON a.id = c.lecturer_id
        WHERE c.status = 'active' AND cpr.status = 'opened' AND c.lecturer_id = '$accID'";
        break;
      default:
        break;
    };
  
    $query_builder .= " ORDER BY cpr.start ASC";
    $query = mysqli_query($CON, $query_builder);
    while ($row = mysqli_fetch_assoc($query)) $result[] = $row;
    
    echo json_encode($result);
  } else {
    http_response_code(500);
    echo mysqli_error($CON);
  }
  

  require_once('../close_connection.php');
?>