<?php 
  $title = $_POST['activity_title'];
  include '../../../../process/create/task-list/getProdUsingTitle.php'; 
  while($result_prod_data = $result_prod->fetch(PDO::FETCH_ASSOC))
  {
    ?>
      <tr>
        <td><input type="" name="" class="form-control" value="<?php echo $result_prod_data['task_list_title']; ?>"></div></td>
        <td><input type="" name="" class="form-control" value="<?php echo $result_prod_data['task_list_process_time']; ?>"></td>
        <td><input type="" name="" class="form-control" value="<?php echo $result_prod_data['task_list_sla']; ?>"></td>
        <td><input type="" name="" class="form-control" value="<?php echo $result_prod_data['task_list_importance']; ?>"></td>
        <td>
          <!-- <div style="display: flex; justify-content: space-around; "> -->
            <a data-toggle="modal" data-target=".confirmation-modal"><i class="fa fa-check"></i> Save</a>
            <a onclick="cancelProdEdit()"><i class="fa fa-close (alias)"></i> Cancel</a>

          <!-- </div> -->
        </td>
      </tr>
    <?php
  }
?>

<?php include 'confirmation-modal.php'; ?>

