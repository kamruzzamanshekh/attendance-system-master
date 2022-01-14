 function selectAll(source) {
   var boxes = document.querySelectorAll('input[type="checkbox"]');
   for (var i = 0; i < boxes.length; i++) {
     if (boxes[i] != source) {
       boxes[i].checked = source.checked;
     }
   }
 };

 function unchecked() {
   document.getElementById("check").checked = true;
 };
