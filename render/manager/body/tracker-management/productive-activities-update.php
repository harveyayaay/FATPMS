<?php 
  $title = $_POST['activity_title'];
  include '../../../../process/create/task-list/getProdUsingTitle.php'; 
  while($result_prod_data = $result_prod->fetch(PDO::FETCH_ASSOC))
  {
    ?>
    <input id="u-tid" type="" name="" class="form-control" value="<?php echo $result_prod_data['task_list_id']; ?>" hidden>
    <tr>
      <td><input id="u-title" type="" name="" class="form-control" value="<?php echo $result_prod_data['task_list_title']; ?>"></div></td>
      <td><input id="u-ptime" type="" name="" class="form-control" value="<?php echo $result_prod_data['task_list_process_time']; ?>"></td>
      <td><input id="u-sla" type="" name="" class="form-control" value="<?php echo $result_prod_data['task_list_sla']; ?>"></td>
      <td>
        <select id="u-level" class="form-control">
          <option selected hidden value="<?php echo $result_prod_data['task_list_importance']; ?>"><?php echo $result_prod_data['task_list_importance']; ?></option>
          <option>Primary</option>
          <option>Secondary</option>
        </select>
      </td>
      <td>
        <!-- <div style="display: flex; justify-content: space-around; "> -->
        <a data-toggle="modal" data-target=".confirm-update-modal"><i class="fa fa-check"></i> Save</a>
        <a onclick="cancelProdEdit()"><i class="fa fa-close (alias)"></i> Cancel</a>
        <!-- </div> -->
      </td>
    </tr>
    <?php
  }
?>

