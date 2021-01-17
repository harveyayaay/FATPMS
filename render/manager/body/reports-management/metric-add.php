<div id="add-metric">
  <div class="x_content">
    <p><i class="glyphicon glyphicon-plus" style="visibility: hidden;"></i> Add Metric</p>
  </div>
  <div class="x_content">
    <div class="item form-group">
      <label for="a-title" class="col-form-label col-md-4 col-sm-4 label-align">Metric Title</label>
      <div class="col-md-4 col-sm-4 ">
        <input id="a-title" class="form-control" type="text" name="middle-name">
      </div>
    </div>
    <div class="item form-group">
      <label for="a-type" class="col-form-label col-md-4 col-sm-4 label-align">Metric Type</label>
      <div class="col-md-4 col-sm-4 ">
        <select name="" id="a-type" class="form-control">
          <option>Time</option>
          <option>Percentage</option>
        </select>
      </div>
    </div>
    <div class="item form-group">
      <label for="a-goal" class="col-form-label col-md-4 col-sm-4 label-align">Metric Goal</label>
      <div class="col-md-4 col-sm-4 ">
        <input id="a-goal" class="form-control" type="text" name="middle-name" placeholder="hh:mm:ss">
      </div>
    </div>
    <div class="item form-group">
    <label for="a-ref" class="col-form-label col-md-4 col-sm-4 label-align">Reference</label>
      <div class="col-md-4 col-sm-4 ">
        <select id="a-ref" class="form-control">
          <option>All</option>
          <?php
            include '../../../../process/create/task-list/getAllProd.php'; 
            while($result_prod_data = $result_prod->fetch(PDO::FETCH_ASSOC))
            {
              echo '<option>'.$result_prod_data['task_list_title'].'</option>';
            }
          ?>
        </select>
      </div>
    </div>
    <div class="ln_solid"></div>
    <div class="item form-group">
      <div class="col-md-4 col-sm-3 offset-md-5">
        <button class="btn btn-primary btn-sm" type="button" onclick="closeAddMetricFields()">Cancel</button>
        <button class="btn btn-success btn-sm" data-toggle="modal" data-target=".confirm-add-modal">Submit</button>
      </div>
    </div>
  </div>
</div>

<?php include 'confirm-add-modal.php'; ?>


