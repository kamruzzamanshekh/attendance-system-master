<?php
include('checkteacher.php');
$val=$_POST['session_str'];
$query="select student_roll,student_name,student_index from student_info where student_session='" . $val . "' ORDER BY CAST(SUBSTRING(student_roll, 4, 2) AS INT) DESC, CAST(SUBSTRING(student_roll, 6, 5) AS INT)";
echo $query;
$data=mysqli_query($conn, $query);

while ($row=$data->fetch_row()) {
  $serialNo=substr($row[0],8,2);
    echo "<tr>";
    echo "<td scope='row'><input type='checkbox' name='check'></td>";
    echo "<td>".  $serialNo  ."</td>";
    echo "<td hidden>". $row[2] ."</td>";
    echo "<td style='text-align: left;'>" . $row[0] . "</td>";
    echo "<td style='text-align: left;'>" . ucwords(strtolower($row[1])) . "</td>";
    echo "</tr>";
}
 ?>
