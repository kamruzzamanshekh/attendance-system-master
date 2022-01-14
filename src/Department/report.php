<?php
include('header.php');
$page = 'report';
 ?>

<body>
  <?php include('navbar.php'); ?>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#table_report_div').hide();

      $('#generate_report').click(function() {
        $.ajax({
          type: "POST",
          url: "departmentReport.php",
          data: {
            session: $('#session').val(),
            year_term: $('#year_term').val()
          },
          success: function(msg) {
            $('#table_report_div').show();
            $('#table_report').html(msg);

            var temp = $('#year_term').val().split("-");
            var year = temp[0];
            var term = temp[1];

            $('#report_session').html($('#session').val());
            $('#report_year').html(year);
            $('#report_term').html(term);
          }
        });
      });
      $('#generate_excel_report').click(function() {
        $('#table_html').attr("value", $('#table_report').html());
        $('#sessionStr').attr("value", $('#session').val());
        $('#year_termStr').attr("value", $('#year_term').val());
        $('#passData').submit();
      });
    });
  </script>

  <section>
    <div class="container">
      <div class="container-fluid">
        <div class="row">
          <div class="col form-group">
            <label for="session">Select Session</label>
            <select id="session" class="form-control custom-select" required autofocus>
              <option selected disabled>Select Session</option>
              <?php

              $query = "SELECT batch_count FROM department_info where iddepartment_info=" . $id_department;
              $data = mysqli_query($connection, $query);
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
                  echo "<option selected disabled>No session found</option>";
                }
              } else {
                echo "<option selected disabled>No session found</option>";
              }
               ?>
            </select>
          </div>

          <div class="col form-group">
            <label for="year_term">Select Year - Term: </label>
            <select id="year_term" class="form-control custom-select" required>
              <option value="1-1">1 - 1</option>
              <option value="1-2">1 - 2</option>
              <option value="2-1">2 - 1</option>
              <option value="2-2">2 - 2</option>
              <option value="3-1">3 - 1</option>
              <option value="3-2">3 - 2</option>
              <option value="4-1">4 - 1</option>
              <option value="4-2">4 - 2</option>
            </select>
          </div>
        </div>

        <div class="row">
          <button id="generate_report" type="button" class="btn btn-info btn-block mt-5" name="show_report">Show Report</button>
        </div>

        <div id="table_report_div" class="col form-group">
          <div class="row mt-5">
            <div class="col text-center mt-5">
              <h2 class="pl-3"><b>Noakhali Science and Technology University</b></h2>
              <h3 class="pl-3"><b>
                <?php
                $query = "SELECT department_name FROM department_info WHERE iddepartment_info=" . $id_department;
                $data = mysqli_query($connection, $query)->fetch_row()[0];
                echo $data;
                ?>
             </b></h3>
             <h3><b>Session: </b><i id="report_session"></i>, <b>Year: </b><i id="report_year"></i>, <b>Term: </b><i id="report_term"></i></h3>
            </div>
          </div>

          <div class="row">
            <table id="table_report" class="table table-striped table-bordered" style="margin-left: -3.5rem;">
            </table>
          </div>

          <div class="row mt-5">
            <form id="passData" class="" action="genarateDepartmentReport.php" method="post">
              <input type="hidden" id="table_html" name="table_html" value="">
              <input type="hidden" id="sessionStr" name="sessionStr" value="">
              <input type="hidden" id="year_termStr" name="year_termStr" value="">
              <a id="generate_excel_report" href="javascript:void(0)" class="btn-link">Download report to excel worksheet</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php include('../footer.php'); ?>
</body>

</html>
