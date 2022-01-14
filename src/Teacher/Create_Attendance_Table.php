<div>
  <table class="table table-dark  table-striped table-hover table-sm  table-bordered">
    <thead class="thead-dark">
      <tr>
        <th>Present</th>
        <th>Student ID</th>
        <th class="col">Name</th>
      </tr>
    </thead>
    <?php while ($rows=$result->fetch_assoc()) {

    ?>
    <tbody>
      <tr>
        <td scope="row"><input type="checkbox" name="check" value=""></td>
        <td><?php echo $rows['student_roll']; ?></td>
        <td><?php echo $rows['student_name']; ?></td>
      </tr>
    </tbody>
    <?php
    }
    ?>
  </table>
</div>
