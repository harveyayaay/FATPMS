<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">
    <div class="x_title">
      <h2>Tracker Management <small></small></h2>
      <ul class="nav navbar-right panel_toolbox">
        <li>
          <a class="collapse-link">
            <i class="fa fa-chevron-up"></i>
          </a>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <div class="row">
        <div class="col-sm-12">
          <div class="card-box table-responsive">
            <p class="text-muted font-13 m-b-30">
              (Caption..)
            </p>

            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Task</th>
                  <th>Process Time</th>
                  <th>SLA</th>
                  <th>Level</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody id=tbody>
                <?php 
                  include '../../../../process/create/task-list/getAllProd.php'; 
                  while($result_prod_data = $result_prod->fetch(PDO::FETCH_ASSOC))
                  {
                    ?>
                    <tr id="id-<?php echo $result_prod_data['task_list_title']; ?>">
                      <td><?php echo $result_prod_data['task_list_title']; ?></div></td>
                      <td><?php echo $result_prod_data['task_list_process_time']; ?></td>
                      <td><?php echo $result_prod_data['task_list_sla']; ?></td>
                      <td><?php echo $result_prod_data['task_list_importance']; ?></td>
                      <td>
                        <!-- <div style="display: flex; justify-content: space-around; "> -->
                          <a onclick="editProd('<?php echo $result_prod_data['task_list_title']; ?>', 'id-<?php echo $result_prod_data['task_list_title']; ?>')"><i class="fa fa-edit (alias)"></i> Update</a> | 
                          <a ><i class="fa fa-trash"></i> Remove</a>
                        <!-- </div> -->
                      </td>
                    </tr>
                    <?php
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="col-md-12 col-sm-12 ">  
  <div class="x_content">
    <div class="row">
      <div class="col-sm-12">
        <div class="card-box table-responsive">
          <table id="datatable-responsive" class="table table-striped jambo_table dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <td><p class="add-link"><i class="glyphicon glyphicon-plus"></i> Add Activity</p></td>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<style type="text/css">
  .add-link
  {
    color: #fff;
  }
  .add-link:hover
  {
    cursor: pointer;
  }

</style>
