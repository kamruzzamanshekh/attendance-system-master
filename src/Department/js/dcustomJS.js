//
// // <script type="text/javascript">
//   $(document).ready(function() {
//     // $('#batch_dropdown').hover(function() {
//       $.ajax({
//         'type': 'post',
//         'url': 'getDropdownBatch.php',
//         'success': function(data) {
//           $('#batch_dropdown').html(data);
//         }
//       });
//     // });
//   });
// // </script>


// $(document).ready(function() {
//     $.ajax ({
//       type: "POST",
//       url: "getDropdownBatch.php",
//       success: function(msg) {
//         $('#batch_dropdown').html(msg);
//         // $('#report_dropdown').html(msg);
//       }
//     });
// });
//
function getDepartmentNameFunc() {
  $.ajax({
    type: "POST",
    url: "getDepartmentName.php",
    success: function(msg) {
      $('#department_name').html(msg);
    }
  });
};


//
// function doThis() {
//   var xmlhttp = new XMLHttpRequest();
//   xmlhttp.onreadystatechange = function() {
//     if (this.readyState == 4 && this.status == 200) {
//       document.getElementById('test').innerHTML = this.responseText;
//     }
//   }
//   xmlhttp.open("POST", "getDropdownBatch.php", true);
//   xmlhttp.send();
// }
