<div class="col-md-12 col-sm-12  ">
  <div class="x_panel">
    <div class="x_title">
      <h2>Reports Management <small></small></h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
      <ul class="nav nav-tabs justify-content-end bar_tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#scorecard-list" role="tab" aria-controls="home" aria-selected="true">Employee Scorecard Information</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#metric-list" role="tab" aria-controls="profile" aria-selected="false">Metrics</a>
        </li>
      </ul>
      <div class="x_content">
        <!-- <div class="tab-pane fade show active" id="home1" role="tabpanel" aria-labelledby="home-tab">
          Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher
              synth. Cosby sweater eu banh mi, qui irure terr.
        </div> -->
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="scorecard-list" role="tabpanel" aria-labelledby="home-tab">
          <!-- start accordion -->
            <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
              <p class="text-muted font-13 m-b-30">
                The following cells tabs contains information about each fronliner's scorecard. Click a specific tab to open a scorecard.
              </p>
              <?php
                $collapse_count = 0;
                include '../../../../process/create/employee/getAllFrontliner.php'; 
                while($result_emp_data = $result_emp->fetch(PDO::FETCH_ASSOC))
                {
                  ?>
                  <div class="panel">
                    <a class="panel-heading" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $collapse_count; ?>" aria-expanded="true" aria-controls="collapseOne" onclick="removeScore('score-display-<?php echo $collapse_count; ?>')">
                      <div class="title-tab">
                        <h4 class="panel-title"><?php echo $result_emp_data['employee_lname'].', '.$result_emp_data['employee_fname']; ?></h4>
                        <h4 class="panel-title" id="score-display-<?php echo $collapse_count; ?>">Average Score: 3</h4>
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
          <!-- end of accordion -->
          </div>
          <div class="tab-pane fade" id="metric-list" role="tabpanel" aria-labelledby="profile-tab">
            <p class="text-muted font-13 m-b-30">
              The following are the information of each metric that is used to determine the scorecards of the frontliners.
            </p>
            <?php include 'metric-display.php'; ?>
            <div class="col-md-12 col-sm-12">  
              <div class="x_content">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="card-box table-responsive">
                      <div class="x_panel add-container" id="add-metric">
                        <?php include 'add-metric-div.php'; ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<style type="text/css">
  .label-tab
  {
    display: flex;
    justify-content: space-between;
  }
  .title-tab
  {
    display: flex;
    justify-content: space-between;
  }
  .title-tab:hover
  {
    cursor: pointer;
  }
  .add-container
  {
    background-color: #2A3F54;
    color: #fff;
  }
  .add-link:hover
  {
    cursor: pointer;
    border-bottom: .5px solid #fff;;
  }
</style>

<script type="text/javascript">
  function removeScore(id)
  {
    var display_score = document.getElementById(id);

    if(display_score.style.visibility == 'hidden')
    {
      display_score.style.visibility = 'visible';
    }
    else
    {
      display_score.style.visibility = 'hidden';
    }

  }
</script>