<table class="table table-hover">
  <thead>
    <tr>
      <th>Task List</th>
      <th>Average Processing Time</th>
      <th>Volume</th>
    </tr>
  </thead>
  <tbody>
    <?php
      include '../../../../process/create/task-list/getAllProd.php'; 
      while($result_prod_data = $result_prod->fetch(PDO::FETCH_ASSOC))
      {

        $tid = $result_prod_data['task_list_id'];
        $date1 = $_POST['date1'];
        $date2 = $_POST['date2'];
        include '../../../../process/create/task/countTaskUsingDatesAndType.php'; 
        if($result_count_task_data = $result_count_task->fetch(PDO::FETCH_ASSOC))
        {
          $volume += $result_count_task_data['counted'];
        }

        if($volume > 0)
        {
        ?>
          <tr>
            <th scope="row"><?php echo $result_prod_data['task_list_title']; ?></th>
            <td><?php echo $volume; ?></td>
            <td>Otto</td>
          </tr>
          <?php
        }
      }
    ?>
  </tbody>
</table>