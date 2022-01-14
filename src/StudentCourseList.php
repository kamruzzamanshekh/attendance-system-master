<?php include('Department/dbconnection.php') ?>
<?php
// error_reporting(1);

$id=$_POST['studentId'];
$level=$_POST['courselevel'];
$id_num = "";

if (!$id || strlen($id) != 11) {
    echo "<option>Invalid ID</option>";
    exit;
} else {
    $upercaseid=strtoupper($id);
    $stuTable="student_info";
    $deptIdQuery="select department_info_iddepartment_info,student_current_batch,student_index,student_name from student_info where student_roll='" . $upercaseid . "'";
    $deptDataArray=mysqli_query($connection, $deptIdQuery);
    if (!$deptDataArray) {
        echo  $deptIdQuery;
        exit;
    }
    $deptData=$deptDataArray->fetch_row();
    $deptId=$deptData[0];
    // echo "<option>" . $deptId . "</option>";
    $sourseListQuery="select course_code from course_info where course_level='" . $level . "' and department_info_iddepartment_info=" . $deptId;
    $courseListArray=mysqli_query($connection, $sourseListQuery);
    $CourseArray=array();
    $index = 0;
    while ($row=$courseListArray->fetch_row()) {
        $CourseArray[$index++]=$row[0];
    }
    //find dept short name
    $dept_snam_query="select department_shortname from department_info where iddepartment_info=" . $deptId;
    $dept_snam=mysqli_query($connection, $dept_snam_query)->fetch_row()[0];
    //find student batch
    $currentBatch=$deptData[1];
    //find table name
    $dept_sname_batch = $dept_snam."_b" . $currentBatch;
    $att_table = "attendance_" . $dept_sname_batch;
    $avgclass=0;
    $assignclass=0;
    $count_temp = count($CourseArray);
    $add_avg_header = 1;

    $table = "";

    for ($i=0; $i < $count_temp; $i++) {
        // echo "<option>" . $CourseArray[$i] . "</option>";
        //course Name
        $courseNameQuery="select idcourse_info,course_title from course_info where course_code='" . $CourseArray[$i] . "'";
        $courseNameData=mysqli_query($connection, $courseNameQuery);
        $couserName=$courseNameData->fetch_row();
        $courseId=$couserName[0];
        $courseTitle=$couserName[1];
        //couserAssignId

        $courseAssignIdQuery="select idcourse_assign from course_assign where course_info_idcourse_info=" . $courseId;
        $courseAssignIdData=mysqli_query($connection, $courseAssignIdQuery);
        // echo $courseAssignIdData->fetch_row()[0];
        // exit;
        $couserAssignId_ = $courseAssignIdData->fetch_row();
        $courseAssignId = $couserAssignId_[0];
        //Total class
        // $totalClassCount = 0;

        if (!$courseAssignId) {
            continue;
        }

        $totalClassQuery="SELECT COUNT(id" . $att_table . ") FROM " . $att_table . " WHERE course_assign_idcourse_assign=" . $courseAssignId;
        $totalClassData=mysqli_query($connection, $totalClassQuery);
        $totalClassCount_ = $totalClassData->fetch_row();
        $totalClassCount = $totalClassCount_[0];

        $individualCourseClass=0;
        if ($totalClassCount==0) {
            $individualCourseClass=0;
        } else {
            $studentIndex=$deptData[2];
            $sum_val = "SUM(" . $studentIndex . ")";
            $att_query = "SELECT " . $sum_val . " FROM " . $att_table . " WHERE course_assign_idcourse_assign=" . $courseAssignId;
            $att_data = mysqli_query($connection, $att_query)->fetch_row();
            $individualCourseClass=$att_data[0];
        }

        //percentage
        $percentage=0;
        if ($individualCourseClass==0 || $totalClassCount==0) {
            $percentage=0;
        } else {
            $percentage=round($individualCourseClass / $totalClassCount, 2);
        }

        if ($totalClassCount>0) {
            $avgclass=$avgclass+$percentage;
            $assignclass++;
        }

        // if (is_nan($percentage)) {
        // $percentage=0;
        // }
        //
        // echo "<tr>";
        // echo "<td>" . $totalClassCount. "</td>";
        // echo "<td>" . $individualCourseClass. "</td>";
        // echo "<td>" . ($percentage) * 100 . "%</td>";
        // echo "<td>" . $avgclass * 100 . "</td>";
        // echo "/tr";
        $table .= "<tr>";
        // echo "<td>" . $upercaseid . "</td>";
        // echo "<td>" . $deptData[3] . "</td>";
        $table .= "<td>" . $CourseArray[$i] . "</td>";
        $table .= "<td>" . $courseTitle . "</td>";
        $table .= "<td>" . $totalClassCount . "/ " . $individualCourseClass . "</td>";
        $table .= "<td>" . ($percentage) * 100 . "%</td>";

        // if ($add_avg_header == 1) {
          // $add_avg_header = 0;
          // $table .= "<td class='' id='avg_percent'>P</td>";
        // }
        // $table .= "</tr>";
    }

    $style = "";
    $avgcalculate= round(($avgclass / $assignclass), 2);
    if ($avgcalculate < 0.7) {
      $style = "bg-danger";
    }

    $table .= "<td class='". $style . "'>" .  $avgcalculate * 100 . "%</td>";

    // $tablehtml = new DOMDocument();
    // $tablehtml->loadHTML($table);
    // $tablehtml->getElementById("avg_percent")->textContent = ($avgcalculate * 100) . "%";

    echo $table;

    // $avgcalculate= round(($avgclass / $assignclass), 2);
    // if ($avgcalculate > 0.7) {
        // echo "<td>" .  $avgcalculate * 100 . "%</td>";
    // } else {
        // echo "<td class='bg-danger'>" .  $avgcalculate * 100 . "%</td>";
    // }

    // echo "</tr>";
}




 ?>
