<?php
include('header.php');
$page = 'report';
 ?>

<body>
  <?php include('navbar.php'); ?>
  <script type="text/javascript">
    function getCourseListBySession(val) {
      val = val.split("-")[1] - 2005;
      $.ajax({
        type: "POST",
        url: "CourseList.php",
        data: {
          batch: val
        },
        success: function(msg) {
          $('#sel_course_code').html(msg);
        }
      });
    };

    $(document).ready(function() {
      $('#showOrHide').hide();

      $.ajax({
        type: "POST",
        url: "CourseList.php",
        success: function(msg) {
          $('#sel_course_code').html(msg);
        }
      });

      $('#student_report_generate').click(function() {
        $('#showOrHide').show();
        $.ajax({
          type: "POST",
          url: "reportFile.php",
          data: {
            session: $('#session').val(),
            course: $('#sel_course_code').val(),
            marks: $('#Attendance-marks').val()
          },
          success: function(msg) {
            $('#showOrHide').show();
            $('#reportTable').html(msg);
          }
        });

        $.ajax({
          type: "POST",
          url: "reportSheet.php",
          data: {
            session: $('#session').val(),
            course: $('#sel_course_code').val()
          },
          success: function(msg) {
            $('#reportsheet').html(msg);
          }
        });

        $('#generate_excel_report').click(function() {
          $('#table_html').attr("value", $('#table_report').html());
          $('#sessionStr').attr("value", $('#session').val());
          $('#courseStr').attr("value", $('#sel_course_code').val());
          $('#passData').submit();
        });

      });
    });
  </script>

  <section>
    <div id="Atten-Genarate-section" class="container">
      <div class="row">
        <div class="col form-group">
          <label for=""><b>Session</b></label>
          <select id="session" class="form-control custom-select  border border-dark" onchange="getCourseListBySession(this.value)" required autofocus>
            <option selected disabled>Select Session</option>
            <?php
						$query = "SELECT di.batch_count FROM department_info di, teacher_info ti where ti.idteacher_info=" . $id_teacher . " AND di.iddepartment_info=ti.department_info_iddepartment_info";
						$data = mysqli_query($conn, $query);

						if ($data) {
							$row = $data->fetch_row();
							$currYear = date('Y');
							$prevYear = $currYear - 1;

							if ($row) {
								$count = $row[0];
								for ($i=0; $i < $count; $i++) {
										$session = ($prevYear - $i) . "-" . ($currYear - $i);
										echo "<option value='" . $session . "'>" . $session . "</option>";
								}
							} else {
								echo "<option selected disabled>No session found 1</option>";
							}
						} else {
							echo "<option selected disabled>No session found</option>";
						}
						 ?>
          </select>
        </div>

        <div class="col">
          <label for=""><b>Course</b></label>
          <select id="sel_course_code" class="form-control custom-select  border border-dark" name="" required>
          </select>
        </div>
        <div class="col">
          <label for=""><b>Attentance Marks</b></label>
          <input type="number" name="" value="" class="form-control  border border-dark" id="Attendance-marks" required>
        </div>
      </div>
      <div class="">
        <button id="student_report_generate" type="button" class="btn btn-info btn-lg btn-block mt-5 bg-primary" name="student-report-generate-button">Show Report</button>
      </div>
    </div>
  </section>

  <div class="container" id="showOrHide">
    <div class="border-primary" id="reportsheet" style='text-align: center;'>
    </div>
    <div class="row">
      <table id="table_report" class="table table-striped table-bordered mb-5">
        <thead class="thead-dark">
          <tr>
            <th width="2%">Serial No</th>
            <th width="5%">Student ID</th>
            <th width="10%">Name</th>
            <th width="5%">Number of classes attended</th>
            <th width="5%">Percentage</th>
            <th width="5%">Marks</th>
          </tr>
        </thead>
        <tbody id="reportTable">
        </tbody>
      </table>
    </div>
    <div class="row mt-5 mb-5">
      <form id="passData" class="" action="getTeacherExcelReport.php" method="post">
        <input type="hidden" id="table_html" name="table_html" value="">
        <input type="hidden" id="sessionStr" name="sessionStr" value="">
        <input type="hidden" id="courseStr" name="courseStr" value="">
        <a id="generate_excel_report" href="javascript:void(0)" class="btn-link mb-5">Download report to excel worksheet</a>
      </form>
    </div>
  </div>
  <?php include('../footer.php'); ?>
</body>

</html>
