<?php
include('header.php');
$page = "attendance";
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

			document.getElementById('date').valueAsDate = new Date();
			$('#showOrHide').hide();
			// $.ajax({
			// 	type: "POST",
			// 	url: "getBatchCount.php",
			// 	success: function(msg) {
			// 		$('#sessionStr').html(msg);
			// 	}
			// });

			// Not passing the batch data while loading
			$.ajax({
				type: "POST",
				url: "CourseList.php",
				success: function(msg) {
					$('#sel_course_code').html(msg);
				}
			});

			$('#generate_student_list').click(function() {
				$('#showOrHide').show();
				$.ajax({
					type: "POST",
					url: "getstudentlist.php",
					data: {
						session_str: $('#sessionStr').val()
					},
					success: function(msg) {
						document.getElementById("selectall").checked = true;
						$('#student_att_list').html(msg);
						selectAll(document.getElementById("selectall"));
					}
				});
			});

			$('#add_att').click(function() {
				var course_assign_id = -1;
				$.ajax({
					type: "POST",
					url: "getCourseID.php",
					data: {
						course_code: $('#sel_course_code').val()
					},
					async: false,
					success: function(msg) {
						course_assign_id = msg;
					}
				});

				var part1 = "'" + $('#date').val() + "', '" + course_assign_id.trim() + "'";
				var part2 = "";
				var boxes = document.querySelectorAll('input[type="checkbox"]');
				var present = 0;
				var total = boxes.length - 1;
				for (var i = 1; i < boxes.length; i++) {
					var ischecked = boxes[i].checked;
					var sep = ",";
					if (i === (boxes.length - 1)) {
						sep = "";
					}
					if (ischecked === true) {
						part2 = part2 + "'1'" + sep + " ";
						present++;
					} else {
						part2 = part2 + "'0'" + sep + " ";
					}
				}

				var stulist = document.getElementById("student_att_list").getElementsByTagName("td");
				var val = part1 + ", '" + present + "/" + total + "'" + ", " + part2;
				var col = "";
				for (var i = 1, j = 2; i <= boxes.length - 1; i++, j += 5) {
					var sep = ", ";
					if (i === 1) {
						sep = "";
					}
					col = col + sep + stulist[j].innerHTML; //"`s" + i + "`"
				}

				var splitted = $('#sessionStr').val().split("-")[1] - 2005;
				var table = "`attendance_iit_b" + splitted + "`";
				var q = "insert into " + table + " (`attendance_date`, `course_assign_idcourse_assign`, `present_count`, " + col + ") values (" + val + ");\n";
				var query = "";
				var h = $('#hour').val();
				for (var i = 0; i < h; i++) {
					query = query + q;
				}

				$.ajax({
					type: "POST",
					url: "insertattendance.php",
					data: {
						query_val: query,
						date: $('#date').val()
					},
					success: function(msg) {
						$('#showOrHide').hide();
						$('#message').html(msg);
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
					<select id="sessionStr" class="form-control custom-select border border-dark" onchange="getCourseListBySession(this.value)">
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
					<label for=""><b>Course</b></label>
					<select id="sel_course_code" class="form-control custom-select border border-dark">
					</select>
				</div>

				<div class="col form-group">
					<label for=""><b>Class Hour</b></label>
					<select id="hour" class="form-control custom-select border border-dark " name="">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
					</select>
				</div>

				<div class="col form-group">
					<label for=""><b>Date</b></label>
					<input id="date" class="form-control custom-select border border-dark " type="date" name="" value="">
				</div>
			</div>
			<div class="row">
				<button id="generate_student_list" type="button" class="btn btn-info btn-lg btn-block mt-5 bg-primary">Generate student list</button>
			</div>
		</div>
	</section>
	<p id="message" class="text-center"></p>
	<div align="center" id="showOrHide" class="container pb-3">
		<div class="container-fluid">
			<table class="table table-sm  table-bordered table-hover">
				<thead class="thead-dark">
					<tr>
						<th width="3%"><input type="checkbox" class="" name="" id="selectall" onclick="selectAll(this)" value=""></th>
						<th width="2%">Roll</th>
						<th width="5%">Student ID</th>
						<th style='text-align: left;'>Name</th>
					</tr>
				</thead>
				<tbody id="student_att_list" class="showOrHideTable">
				</tbody>
			</table>
			<div class="col">
				<input id="add_att" type="button" class="showOrHideButton btn btn-primary btn-lg btn-inline mt-2" name="" value="Done" style="">
			</div>
		</div>
	</div>

	<?php include('../footer.php'); ?>
</body>

</html>
