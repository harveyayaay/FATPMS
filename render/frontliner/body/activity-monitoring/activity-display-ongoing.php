<!-- page content -->

<div class="col-md-12 col-sm-12  ">
  <div class="x_panel">
    <div class="x_title">
      <h2>Ongoing Activities</h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <p class="text-muted font-13 m-b-30">
        (Caption .. )
      </p>
      <div class="col-md-12 col-sm-12 ">
        <div class="row">
          <div class="col-sm-12">
            <div class="card-box table-responsive">
              <table class="table table-bordered" style="width:100%">
                <thead>
                  <tr>
                    <th>Task Name</th>
                    <th>Client ID</th>
                    <th>Date and Time Received</th>
                    <th>Start Time</th>
                    <th style="width: 20%">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    include '../../../../process/create/task/getOngoingTaskUsingEmployeeId.php'; 
                    if($result_ongoing_task_data = $result_ongoing_task->fetch(PDO::FETCH_ASSOC))
                    {
                      $tid = $result_ongoing_task_data['task_type'];  
                      include '../../../../process/create/task-list/getTaskListUsingId.php'; 
                      if($result_task_data = $result_task->fetch(PDO::FETCH_ASSOC))
                      {
                        ?>
                        <tr>
                          <td><?php echo $result_task_data['task_list_title']; ?></td>
                          <td><?php echo $result_ongoing_task_data['task_client_id']; ?></td>
                          <td><?php echo $result_ongoing_task_data['task_date_received']; ?></td>
                          <td><?php echo $result_ongoing_task_data['task_start_time']; ?></td>
                          <td>
                            <button type="button" class="btn btn-warning" onclick="updateActivity('<?php echo $result_ongoing_task_data['task_id']; ?>', 'hold')"><i class="fa fa-pause"></i> Hold</button>
                            <button type="button" class="btn btn-success" onclick="updateActivity('<?php echo $result_ongoing_task_data['task_id']; ?>', 'complete')"><i class="fa fa-check"></i> Complete</button>
                          </td>
                        </tr>
                        <?php
                      }
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
</div>
        <!-- /page content -->