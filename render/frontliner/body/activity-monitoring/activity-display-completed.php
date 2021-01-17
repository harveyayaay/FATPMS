<!-- page content -->

<div class="col-md-12 col-sm-12  ">
  <div class="x_panel">
    <div class="x_title">
      <h2>Completed Activities: <?php echo $result_completed_data['count_completed']; ?></h2>
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
              <table class="table table-striped table-bordered" style="width:100%">
                <thead>
                  <tr>
                    <th>Task Name</th>
                    <th>Client ID</th>
                    <th>Date and Time Received</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Hold Duration</th>
                    <th>Process Duration</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    include '../../../../process/create/task/getCompletedTaskUsingEmployeeIdAndDate.php'; 
                    while($result_completed_task_data = $result_completed_task->fetch(PDO::FETCH_ASSOC))
                    {
                      $tid = $result_completed_task_data['task_type'];  
                      include '../../../../process/create/task-list/getTaskListUsingId.php'; 
                      if($result_task_data = $result_task->fetch(PDO::FETCH_ASSOC))
                      {
                        $dtst = date('Y-m-d').' '.$result_completed_task_data['task_start_time'];
                        $dthst = date('Y-m-d').' '.$result_completed_task_data['task_hold_start_time'];

                        $dthet = date('Y-m-d').' '.$result_completed_task_data['task_hold_end_time'];
                        $dtet = date('Y-m-d').' '.$result_completed_task_data['task_end_time'];

                        $time1 = new DateTime($dtst);
                        $time2 = new DateTime($dthst);
                        $ptdiff1 = $time1->diff($time2);
                        $ptime1 = $ptdiff1->format('%H:%I:%S');

                        $time3 = new DateTime($dthet);
                        $time4 = new DateTime($dtet);
                        $ptdiff2 = $time3->diff($time4);

                        $time5 = new DateTime($dthst);
                        $time6 = new DateTime($dthet);
                        $htdiff = $time5->diff($time6);
                        $ptime2 = $ptdiff2->format('%H:%I:%S');

                        $hours = date('h',strtotime($ptime1)) + date('h',strtotime($ptime2));
                        $minutes = date('i',strtotime($ptime1)) + date('i',strtotime($ptime2));
                        $seconds = date('s',strtotime($ptime1)) + date('s',strtotime($ptime2));
                        $holdtime = $hours.':'.$minutes.':'.$seconds;

                        ?>
                        <tr>
                          <td><?php echo $result_task_data['task_list_title']; ?></td>
                          <td><?php echo $result_completed_task_data['task_client_id']; ?></td>
                          <td><?php echo $result_completed_task_data['task_date_received']; ?></td>
                          <td><?php echo $result_completed_task_data['task_start_time']; ?></td>
                          <td><?php echo $result_completed_task_data['task_end_time']; ?></td>
                          <td><?php echo date('H:i:s', strtotime($holdtime)); ?></td>
                          <td><?php echo $ptdiff1->format('%H:%I:%S'); ?></td>
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