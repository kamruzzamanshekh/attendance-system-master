<?php
include('header.php');
$page = 'editattendance';
?>

<body>
	<?php include('navbar.php'); ?>

	<script type="text/javascript">
		var single_att_id = -1;

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

		function viewSingle(atten_id, dept_sname_batch) {
			single_att_id = atten_id;
			$('#edit_single_attendance_section').show();
			$.ajax({
				type: "POST",
				url: "editSingleAttendanceTable.php",
				data: {
					attendance_id: atten_id,
					department_sname_batch: dept_sname_batch
				},
				success: function(msg) {
					$('#edit_single_attendance_table').html(msg);
				}
			});
		}

		$(document).ready(function() {
			$('#edit_single_attendance_section').hide();

			$.ajax({
				type: "POST",
				url: "CourseList.php",
				success: function(msg) {
					$('#sel_course_code').html(msg);
				}
			});

			$('#generate_attendance_list').click(function() {
				$.ajax({
					type: "POST",
					url: "editAttendanceTable.php",
					data: {
						course_code: $('#sel_course_code').val()
					},
					success: function(msg) {
						$('#attendance_data').show();
						$('#attendance_list_table').html(msg);
					}
				});
			});

			$('#update_att').click(function() {
				// alert(single_att_id);
				if (single_att_id < 0) {
					alert("Not an ID");
					return;
				}

				var check_part = "";
				var boxes = document.querySelectorAll('input[type="checkbox"]');
				var present = 0;
				var total = boxes.length - 1;
				var stulist = document.getElementById("edit_single_attendance_table").getElementsByTagName("td");
				for (var i = 1, j = 2; i < boxes.length; i++, j += 5) {
					var ischecked = boxes[i].checked;
					var sep = ",";
					if (i === (boxes.length - 1)) {
						sep = "";
					}
					if (ischecked === true) {
						check_part = check_part + "`" + stulist[j].innerHTML + "`=1" + sep + " "; // + "`s" + i + "`='1'" + sep + " ";
						present++;
					} else {
						check_part = check_part + "`" + stulist[j].innerHTML + "`=0" + sep + " "; //+ "`s" + i + "`='0'" + sep + " ";
					}
				}
			//	alert(check_part);
				check_part = check_part + ",`present_count`='" + present + "/" + total + "'";


			//	alert($('#session').html());
			// alert($('#sessionStr').val());
			var table_batch = $('#sessionStr').val();
			table_batch = table_batch.split('-')[1] - 2005;
				var table = "`idattendance_iit_b" + table_batch + "`"
				var table_name = "`attendance_iit_b" + table_batch + "`";
			//	alert(table_name);

				// var table_name = "attendance_iit_b13";
				var query = "UPDATE " + table_name + " SET " + check_part + " WHERE " + table + "=" + single_att_id;
				// alert(query);

				$.ajax({
					type: "POST",
					url: "updateAttendance.php",
					data: {
						query_val: query
					},
					success: function(msg) {
						$('#edit_single_attendance_section').hide();
						$('#attendance_data').hide();
						alert(msg);
					}
				});
			});
		});
	</script>

	<section>
		<div class="container">

			<div class="row">
				<div class="col form-group">
					<label><b>Session</b></label>
					<select id="sessionStr" class="form-control custom-select border border-dark" onchange="getCourseListBySession(this.value)" autofocus>
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
				<div class="col form-group">
					<label><b>Course</b></label>
					<select id="sel_course_code" class="form-control custom-select  border border-dark">
						<?php
						// include('CourseList.php');
						$query = "SELECT ci.course_code, ca.ca_batch from course_info ci, course_assign ca WHERE ci.idcourse_info=ca.course_info_idcourse_info AND ca.teacher_info_idteacher_info=" . $id_teacher;
						$batch = "";
						$data = mysqli_query($conn, $query);
						if ($data) {
						  while ($row = $data->fetch_row()) {
								$batch = $row[1];
						    echo "<option value='" . $row[0] . "'>" . $row[0] . "</option>";
						  }
						} else {
						  echo "<option selected disabled>No course found</option>";
						}
						 ?>
					</select>
				</div>
			</div>

			<div class="row">
				<button id="generate_attendance_list" type="button" class="btn btn-info btn-lg btn-block mt-5 bg-primary">Go For Edit</button>
			</div>
		</div>
	</section>

	<div id="attendance_data">
		<div align="center" id="" class="container">
			<div class="">
				<table class="table table-striped table-hover table-sm table-bordered" id="attendance_list_table">
				</table>
			</div>
		</div>
	</div>

	<div id="edit_single_attendance_section">
		<div class="container" align="center">
			<div class="row">
				<!-- <label id="session" hidden><?php //echo $batch; ?></label> -->
				<label>Edit attendance</label>
				<table class="table table-striped table-hover table-sm table-bordered mb-5">
					<thead class="thead-dark">
						<tr>
							<th width="3%"><input type="checkbox" class="" name="" id="selectall" onclick="selectAll(this)" value=""></th>
							<th width="2%">Roll</th>
							<th width="5%">Student ID</th>
							<th>Name</th>
						</tr>
					</thead>
					<tbody id="edit_single_attendance_table">
					</tbody>
				</table>
			</div>
			<div class="col mb-5">
				<input id="update_att" type="button" class="btn btn-primary btn-lg btn-inline mt-2 mb-5" name="" value="Done" style="" onclick="ok">
			</div>
		</div>
	</div>

	<?php include('../footer.php'); ?>

</body>
</html>
