<?php
include('header.php');
$page = 'assignteacher';
 ?>

<body>
  <script type="text/javascript">
    function changeStatus(t) {
      var t_id = t.split("-")[0];
      $.ajax({
        type: "POST",
        url: "getTeacherStatus.php",
        data: {
          teacher_id: t_id
        },
        success: function(msg) {
          $('#teacherStatus').html(msg);
        }
      });
    }

    function deleteOldAssigned(row) {
      var td = row.parentNode.parentNode.getElementsByTagName("td");
      var teacher_id_val = td[0].innerHTML;
      var course_id_val = td[2].innerHTML;

      $.ajax({
        type: "POST",
        url: "deleteOldAssigned.php",
        data: {
          teacher_id: teacher_id_val,
          course_id: course_id_val
        },
        success: function(msg) {
          $('#message').html(msg);
          var index = row.parentNode.parentNode.rowIndex;
          document.getElementById("table_old_assigned").deleteRow(index);
        }
      });
    }

    function deleteAssigned(row) {
      var index = row.parentNode.parentNode.rowIndex;
      document.getElementById("table_new_course_assigned").deleteRow(index);
    }

    function changeDepartment(id) {
      $.ajax({
        type: "POST",
        url: "getTeachersNameList.php",
        data: {
          dept_id: id
        },
        success: function(msg) {
          $('#teacher_list').html(msg);
          $('#teacher_list').onchange();
        }
      });
    }

    $(document).ready(function() {
      var session = $('#session').val();
      var term = $('#term').val();
      var year = $('#year').val();
      if (!session || !term || !year) {
        $('#sec_assign_new_course').hide();
      }

      $('#btn_assign_new_course').click(function() {
        // document.getElementById("sec_assign_new_course").style.display = "block";
        // // document.getElementById("sec_already_assigned").style.display = "none";
        // changeDepartment($('#department_name').val());
        // $.ajax({
        //   type: "POST",
        //   url: "getCourseList.php",
        //   data: {
        //     year: $('#year').val(),
        //     term: $('#term').val()
        //   },
        //   success: function(msg) {
        //     $('#course_list').html(msg);
        //   }
        // });
      });

      $('#get_old_assigned_course_list').click(function() {
        var session = $('#session').val();
        var term = $('#term').val();
        var year = $('#year').val();
        if (!session || !term || !year) {
          return;
        }

        $.ajax({
          type: "POST",
          url: "getOldAssignedCourse.php",
          data: {
            session: $('#session').val(),
            term: $('#term').val()
          },
          success: function(msg) {
            $('#tbody_already_assigned_course').html(msg);
          }
        });
        $('#sec_assign_new_course').show();
        changeDepartment($('#department_name').val());
        // document.getElementById("sec_assign_new_course").style.display = "block";
        // document.getElementById("sec_already_assigned").style.display = "none";

        $.ajax({
          type: "POST",
          url: "getCourseList.php",
          data: {
            year: $('#year').val(),
            term: $('#term').val()
          },
          success: function(msg) {
            $('#courses_list').html(msg);
          }
        });
      });

      $('#add_course').click(function() {
        // Check values are present
        var t = $('#teacher_list').val();
        var c = $('#courses_list').val();
        if (c) {
          var teacher = t.split("-");
          var course = c.split("-");

          var teacher_id = teacher[0];
          var teacher_name = teacher[1];
          var course_id = course[0];
          var course_code = course[1];
          var tempCount = course.length;
          var course_title = course[2];
          if (tempCount === 4) {
            course_title = course[2] + " " + course[3];
          }
          var old = $('#tbody_new_course_assigned').html();
          var html = "<tr><td hidden=\"\">" + teacher_id + "</td><td>" + teacher_name +
            "</td><td hidden=\"\">" + course_id + "</td><td>" + course_code + "-" + course_title +
            "</td><td><button type=\"button\" class=\"btn btn-outline-danger\" onclick=\"deleteAssigned(this)\">Delete</button></td></tr>";

          if (old.trim().indexOf(html.trim()) === -1) {
            $('#tbody_new_course_assigned').html(old + html);
          }
        }
      });

      $('#assign_course').click(function() {
        var x = document.getElementById("table_new_course_assigned").rows.length;
        alert("X " + x);
        for (var i = 1; i < x; i++) {
          var tr = document.getElementById("table_new_course_assigned").getElementsByTagName("tr")[i];
          var tdl = tr.getElementsByTagName("td").length;
          var teacher_id_val = tr.getElementsByTagName("td")[0].innerHTML;
          var course_id_val = tr.getElementsByTagName("td")[2].innerHTML;
          var ca_year_val = "2020";
          var ca_term_val = $('#term').val();
          var ca_batch_val = $('#session').val().split('-')[1] - 2005;
          var val = "'" + course_id_val + "', '" + teacher_id_val + "', '" + ca_year_val + "', '" + ca_term_val + "', '" + ca_batch_val + "', '0'";
          var result = "";
          $.ajax({
            type: "POST",
            url: "insertAssignedCourse.php",
            data: {
              vals: val
            },
            success: function(msg) {
              alert(msg);
              $('#sec_assign_new_course').hide();
              // $('#assign_course_submit')[0].reset();

              // if (msg === "Successful") {
              //   location.href = "AssignTeacher.php";
              // }
            }
          });

          // location.href = "AssignTeacher.php";
        }
      });
    });
  </script>

  <?php include('navbar.php'); ?>

  <section id="sec_already_assigned">
    <div class="container">
      <!-- <form id="select_opt" method="post"> -->
      <div class="row">
        <div class="form-group col">
          <label>Session</label>
          <select class="custom-select" id="session" name="session" required>
            <option disabled selected>Select session</option>
            <?php
            $query = "SELECT batch_count FROM department_info where iddepartment_info=" . $id_department;
            $data = mysqli_query($connection, $query);
            if ($data) {
              $row = $data->fetch_row();
              $currYear = date('Y');
              $prevYear = $currYear - 1;
              $oSession = "";
              if (isset($_POST['session'])) {
                $oSession = $_POST['session'];
              }
              if ($row) {
                $count = $row[0];
                $attr = "";
                for ($i=0; $i < $count; $i++) {
                    $session = ($prevYear - $i) . "-" . ($currYear - $i);
                    if ($oSession) {
                      if ($session == $oSession) {
                        $attr = "selected";
                      } else {
                        $attr = "";
                      }
                    }
                    echo "<option " . $attr . " value='" . $session . "'>" . $session . "</option>";
                }
              } else {
                echo "<option selected disabled>No session found</option>";
              }
            } else {
              echo "<option selected disabled>No session found</option>";
            }
             ?>

          </select>
        </div>

        <div class="form-group col">
          <label>Year</label>
          <select class="custom-select" id="year" name="year" required>
            <option disabled selected>Select year</option>
            <?php
            $oyear = "";
            if (isset($_POST['year'])) {
              $oyear = $_POST['year'];
            }
             ?>
            <option value="1" <?php if ($oyear == 1) {echo "selected";} ?>>1st</option>
            <option value="2" <?php if ($oyear == 2) {echo "selected";} ?>>2nd</option>
            <option value="3" <?php if ($oyear == 3) {echo "selected";} ?>>3rd</option>
            <option value="4" <?php if ($oyear == 4) {echo "selected";} ?>>4th</option>
          </select>
        </div>

        <div class="form-group col">
          <label>Term</label>
          <select class="custom-select" id="term" name="term" required>
            <?php
            $oterm = "";
            if (isset($_POST['term'])) {
              $oterm = $_POST['term'];
            }
             ?>
            <option disabled selected>Select term</option>
            <option value="1" <?php if ($oterm == 1) {echo "selected";} ?>>1st</option>
            <option value="2" <?php if ($oterm == 2) {echo "selected";} ?>>2nd</option>
          </select>
        </div>
      </div>

      <div align="center" class="row">
        <div class="form-group col">
          <button type="submit" class="btn btn-primary mt-4" id="get_old_assigned_course_list">Get old assigned course</button>
        </div>
      </div>
      <!-- </form> -->

      <div id="div_old_assigned" class="row">
        <div class="col-lg-8 mx-auto">
          <h2>Course already Assigned</h2>
          <table id="table_old_assigned" class="table table-stripped table-bordered">
            <thead class="thead-dark">
              <tr>
                <th hidden>Teacher ID</th>
                <th>Teacher Name</th>
                <th hidden>Course ID</th>
                <th>Course Name</th>
                <th></th>
              </tr>
            </thead>
            <tbody id="tbody_already_assigned_course">

            </tbody>
          </table>
        </div>
      </div>

      <div class="row">
        <p id="status"></p>
      </div>

    </div>
    <!-- </section> -->

    <div id="sec_assign_new_course" class="container" <?php //if (isset($_POST['session']) && isset($_POST['year']) && isset($_POST['term'])) {echo "";} else {echo "hidden";} ?>>

      <!-- <form class="" action="#course_assign" method="POST"> -->
      <!-- <div align="center" class="row">
              <div class="form-group col">
                <button type="submit" class="btn btn-primary mt-5" id="btn_assign_new_course">Assign New Course</button>
                <p id="message"></p>
              </div>
            </div> -->
      <!-- </form> -->
      <div class="row">
        <div class="form-group col">
          <h3>Assign new course</h3>
          <label>Department/Institute</label>
          <select class="custom-select" name="department_name" id="department_name">
            <?php
            $query = "SELECT iddepartment_info, department_name FROM department_info";
            $data = mysqli_query($connection, $query);
            if ($data) {
              while ($row = $data->fetch_row()) {
                $sel = "";
                if ($row[0] == $id_department) {
                  $sel = "selected";
                }
                echo "<option " . $sel . " onclick='changeDepartment(" . $row[0] . ")' value='" . $row[0] . "'>" . $row[1] . "</option>";
              }
            } else {
              echo "<option selected disabled>No department found</option>";
            }
             ?>
          </select>
        </div>
      </div>

      <div class="row">
        <div class="form-group col">
          <label>Teacher</label>
          <select class="custom-select" name="teacher_name" id="teacher_list" onchange="changeStatus(this.value)">
          </select>
          <label id="teacherStatus"></label>

        </div>
      </div>

      <div class="row">
        <div class="form-group col">
          <label>Course List</label>
          <select class="custom-select" id="courses_list">
            <option disabled selected>Select course</option>
          </select>
        </div>
      </div>

      <div align="center" class="row">
        <div class="form-group col">
          <button type="submit" class="btn btn-primary mt-5" id="add_course">Add</button>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-8 mx-auto">
          <h2>Course Going to be Assigned</h2>
          <h1 id="test"></h1>
          <table id="table_new_course_assigned" class="table table-stripped table-bordered">
            <thead class="thead-dark">
              <tr>
                <th hidden>Teacher ID</th>
                <th>Teacher Name</th>
                <th hidden>Course ID</th>
                <th>Course Name</th>
                <th></th>
              </tr>
            </thead>
            <tbody id="tbody_new_course_assigned">

            </tbody>
          </table>
        </div>
      </div>

      <!-- <form id="assign_course_submit" method="post" onsubmit="return false"> -->

      <div align="center" class="row">
        <div class="form-group col">
          <button type="submit" class="btn btn-primary mt-5" id="assign_course">Assign</button>
        </div>
      </div>

      <!-- </form> -->

    </div>
  </section>

  <?php include('../footer.php'); ?>
</body>

</html>
