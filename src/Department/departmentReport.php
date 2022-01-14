<?php
include_once('checkdepartment.php');

$session = $_POST['session'];
$year_term = $_POST['year_term'];
$temp = explode('-', $year_term);
$year = $temp[0];
$term = $temp[1];

$temp = explode('-', $session);
$batch = $temp[1] - 2005;

// Get attendance table name
$attendance_table_name = "attendance_" . $department_short_name . "_b" . $batch;

// Get course code list
$query = "SELECT idcourse_info, course_code FROM course_info WHERE course_level='" . $year_term . "'";
$data = mysqli_query($connection, $query);

if (!$data) {
    echo "Course Data not found";
    exit;
}

// IDCourse, CourseCode
$course_code_list = array(array());
$i = 0;
while ($row = $data->fetch_row()) {
    $course_code_list[$i][0] = $row[0];
    $course_code_list[$i][1] = $row[1];
    $i++;
}
$course_count = count($course_code_list);


// Get Student list
$query = "SELECT student_roll, student_name, student_index FROM student_info WHERE student_session='" . $session . "' ORDER BY LENGTH(student_index), student_index";
$data = mysqli_query($connection, $query);

if (!$data) {
    echo "Student data not found";
    exit;
}

// StudentRoll, StudentName, StudentIndex
$student_list = array(array());
$i = 0;
while ($row = $data->fetch_row()) {
    $student_list[$i][0] = $row[0];
    $student_list[$i][1] = ucwords(strtolower($row[1]));
    $student_list[$i][2] = $row[2];
    $i++;
}
$student_count = count($student_list);

$student_index_sum_str = "";
$sep = ", ";
for ($r=0; $r < $student_count; $r++) {
    if ($r == $student_count - 1) {
        $sep = "";
    }

    $student_index_sum_str .= "SUM(" . $student_list[$r][2] . ")" . $sep;
}

# table header
$table_header = "";

for ($r=0; $r < $course_count; $r++) {
    $table_header .= "<th>" . $course_code_list[$r][1] . "</th>";

    // Get course assign id
    $query = "SELECT idcourse_assign FROM course_assign WHERE course_info_idcourse_info=" . $course_code_list[$r][0] . " AND ca_batch='" . $batch . "'";
    $data = mysqli_query($connection, $query);
    $course_assign_id = $data->fetch_row()[0];

    if (!$data || !$course_assign_id) {
        echo "Course Not assigned\n";
        for ($rr=0; $rr < $student_count; $rr++) {
            $student_list[$rr][$r + 3] = "N/A";
        }
        continue;
    }
    // echo $course_assign_id . " " . $query . "\n";

    // Get attendance
    $col_count = $student_count + 2;
    $query = "SELECT id" . $attendance_table_name . ", COUNT(course_assign_idcourse_assign), " . $student_index_sum_str . " FROM " . $attendance_table_name . " WHERE course_assign_idcourse_assign=" . $course_assign_id;
    $data = mysqli_query($connection, $query);
    // echo $query . "\n";

    $rowData = $data->fetch_row();
    $class_count = $rowData[1];
    for ($rr=2, $index = 0; $rr < $col_count; $rr++, $index++) {
        $cal = "";
        if ($class_count == 0) {
            $cal = "NULL";
        } else {
            $cal = round($rowData[$rr] / $class_count, 2) * 100 . "%";
        }
        $student_list[$index][$r + 3] = $cal;
    }
}

// Create table header
echo "<thead class='thead-dark'>";
echo "<th>Student ID</th>";
echo "<th>Student Name</th>";
echo $table_header;
echo "<th>Average</th>";
echo "</thead>";

// Create table body
echo "<tbody>";
for ($r=0; $r < $student_count; $r++) {

  // // Course Taken count
    $course_taken = $course_count;

    echo "<tr>";
    $total = 0;
    for ($rr=0; $rr < $course_count + 3; $rr++) {
        if ($rr == 2) {
            continue;
        }

        $temp = $student_list[$r][$rr];
        $style = "";

        if ($rr > 2) {
            if ($temp == "NULL" || $temp == "N/A") {
              $course_taken--;
            } else {
                $t = explode('%', $temp)[0];
                if ($t < 70) {
                    $style = "class='bg-danger'";
                }
                $total += $t;//$student_list[$r][$rr];
            }
        }
        echo "<td " . $style . ">" . $temp . "</td>";
    }

    $avg = round($total / $course_taken, 2);
    $styleAvg = "";
    if ($avg < 70) {
        $styleAvg = "class='bg-danger'";
    }
    echo "<td " . $styleAvg . ">" . $avg . "%</td>";
    echo "</tr>";
}
echo "</tbody>";
