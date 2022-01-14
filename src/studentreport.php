<?php
include_once("Department/dbconnection.php");
include('variables.php');
$page = 'student';
 ?>

<html>

<head>
  <?php include('headData.php') ?>
</head>

<body>
  <?php include('mainnavbar.php'); ?>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#showOrHide').hide();
      $('#showreport').click(function() {
        // var roll=$('#classId').val();

        // $("#sel_course_level").click(function(){
        $.ajax({
          type: "POST",
          url: "StudentCourseList.php",
          data: {
            studentId: $('#classId').val(),
            courselevel: $('#sel_course_level').val()
          },
          success: function(msg) {
            $('#reportTable').html(msg);

// alert("Done 1");
            $.ajax ({
              type: "POST",
              url: "studentReportHeader.php",
              data: {
                student_id: $('#classId').val(),
                course_level: $('#sel_course_level').val()
              },
              success: function(msg) {
                $('#report_header').html(msg);
                // alert('done 2');
                $('#showOrHide').show();
              }
            });

          }
          // });
        });
      });

      $('#generate_excel_report').click(function() {
        $('#table_html').attr("value", $('#table_report').html());
        $('#studentId').attr("value", $('#classId').val());
        $('#year_termStr').attr("value", $('#sel_course_level').val());
        $('#passData').submit();
      });

    });
  </script>

  <section>
    <div id="Atten-Genarate-section" class="container">
      <div class="row">
        <div class="col form-group">
          <label id="idvalidation" for=""></label>
          <label for="">Student ID</label>
          <input type="text" placeholder="ASH1825035M" class="form-control" id="classId" required>
        </div>

        <div class="col">
          <label for="">Course Level</label>
          <select id="sel_course_level" class="form-control custom-select" name="" required onclick="click()">
            <option value="" disabled selected>Select level</option>
            <option value="1-1">1-1</option>
            <option value="1-2">1-2</option>
            <option value="2-1">2-1</option>
            <option value="2-2">2-2</option>
            <option value="3-1">3-1</option>
            <option value="3-2">3-2</option>
            <option value="4-1">4-1</option>
            <option value="4-2">4-2</option>
          </select>
        </div>
      </div>
      <div class="">
        <button id="showreport" type="button" class="btn btn-info btn-lg btn-block mt-5 bg-primary" name="student-report-generate-button">Show Report</button>
      </div>
    </div>
  </section>

  <div class="container" id="showOrHide">
    <div class="border-primary" id="reportsheet" style='text-align: center;'>
      <!-- calling reportSheet.php -->
      <div class="row">
        <div class="col" id=report_header>

        </div>
      </div>
    </div>
    <div class="row">
      <table id="table_report" class="table table-stripped table-bordered mb-5">
        <thead class="thead-dark">
          <tr>
            <!-- <th width="2%">Student ID</th> -->
            <!-- <th width="10%">Name</th> -->
            <!-- <th>Course</th> -->
            <th width="5%">Course Code</th>
            <th width="15%">Course Title</th>
            <th width="5%">Total/Attend Class</th>
            <th width="5%">Percentage</th>
            <th width="5%">Average Attendance</th>
          </tr>
        </thead>
        <tbody id="reportTable">
        </tbody>
      </table>
    </div>
    <div class="row mt-5 mb-5">
      <form id="passData" class="mb-5" action="getStudentExcelReport.php" method="post">
        <input type="hidden" id="table_html" name="table_html" value="">
        <input type="hidden" id="studentId" name="student_id" value="">
        <input type="hidden" id="year_termStr" name="year_termStr" value="">
        <a id="generate_excel_report" href="javascript:void(0)" class="btn-link mb-5">Download report to excel worksheet</a>
      </form>
    </div>
  </div>
  <?php include('footer.php'); ?>
</body>

</html>
