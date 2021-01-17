<div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel">
    <div class="panel-heading"> 
      <div class="label-tab">
        <h4 class="panel-title"><b>Metric Title</b></h4>
        <h4 class="panel-title"><b>Metric Type</b></h4>
      </div>
    </div>
  </div>
  <!-- style="background-color: #2A3F54; color: #fff" -->
  <?php
    $collapse_count = 0;
    include '../../../../process/create/metric/getAllMetric.php'; 
    while($result_metric_data = $result_metric->fetch(PDO::FETCH_ASSOC))
    {
      ?>
      <div class="panel">
        <a class="panel-heading" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $collapse_count; ?>" aria-expanded="true" aria-controls="collapseOne">
          <div class="title-tab">
            <h4 class="panel-title"><?php echo $result_metric_data['metric_title']; ?></h4>
            <h4 class="panel-title"><?php echo $result_metric_data['metric_type']; ?></h4>
          </div>
        </a>
        <div id="collapse<?php echo $collapse_count; ?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
          <div class="panel-body">
            <table class="table table-bordered jambo_table">
              <thead>
                <tr>
                  <th>Metric</th>
                  <th>Actual</th>
                  <th>Goal</th>
                  <th>Performance Percentage</th>
                  <th>Score</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">Volume</th>
                  <td>0</td>
                  <td>1500</td>
                  <td>0%</td>
                  <td>1</td>
                </tr>
                <tr>
                  <th scope="row" colspan="4">Average Score:</th>
                  <td>0</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <?php
      $collapse_count++;
    }
  ?>
</div>