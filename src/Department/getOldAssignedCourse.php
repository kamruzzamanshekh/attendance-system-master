<?php
include_once('checkdepartment.php');

$session = $_POST['session'];
$term = $_POST['term'];

if (!$session || !$term) {
    echo "Session or term empty.";
    return;
}

$batch = explode("-", $session)[1] - 2005;

$query = "SELECT t.idteacher_info, t.teacher_name, c.idcourse_info, c.course_code, c.course_title
          FROM course_info c, teacher_info t, course_assign ca WHERE t.department_info_iddepartment_info=" . $id_department . " AND
          c.department_info_iddepartment_info=" . $id_department . " AND t.idteacher_info = ca.teacher_info_idteacher_info AND
          c.idcourse_info=ca.course_info_idcourse_info AND ca_batch='" . $batch . "' AND ca_term='" . $term . "'
          ORDER BY CAST(RIGHT(c.course_code, 4) AS INT)";

$data = mysqli_query($connection, $query);
if ($data) {
    echo "<thead class='thead-dark'>
          <tr>
            <th hidden>Teacher ID</th>
            <th>Teacher Name</th>
            <th hidden>Course ID</th>
            <th>Course Name</th>
            <th></th>
          </tr>
        </thead>
        <tbody id='tbody_already_assigned_course'>";

    while ($row = $data->fetch_row()) {
        echo "<tr>";
        echo "<td hidden>" . $row[0] . "</td>";
        echo "<td>" . $row[1] . "</td>";
        echo "<td hidden>" . $row[2] . "</td>";
        echo "<td>" . $row[3] . "-" . $row[4] . "</td>";
        echo "<td><button type=\"button\" class=\"btn btn-outline-danger\" onclick=\"deleteOldAssigned(this)\">Delete</button></td>";
        echo "</tr>";
    }
    echo "</tbody>";
}

?>
