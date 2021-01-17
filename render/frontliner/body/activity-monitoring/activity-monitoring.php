<?php include '../../header/header.php'; ?>
<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <!-- sidebar menu -->
        <?php include '../../navigation/navigation.php'; ?>
      <!-- /sidebar menu -->

      <!-- top navigation -->
        <?php include '../../navigation/top-navigation.php'; ?>
      <!-- /top navigation -->

      <!-- page content -->
      <div class="right_col" role="main">
        <div class="">
          <div class="clearfix"></div>
            <div class="row" id="page-change">

              <?php
                include '../../../../process/create/task/checkActivityOngoingCurrent.php'; 
                $result_ongoing_data = $result_ongoing->fetch(PDO::FETCH_ASSOC);
                if($result_ongoing_data['count_ongoing'] > 0)
                {
                  include 'activity-display-ongoing.php';
                }
                else
                {
                  include 'activity-display-add.php';

                  include '../../../../process/create/task/checkActivityOnholdCurrent.php'; 
                  $result_onhold_data = $result_onhold->fetch(PDO::FETCH_ASSOC);
                  if($result_onhold_data['count_onhold'] > 0)
                  {
                    include 'activity-display-onhold.php';
                  }

                  include '../../../../process/create/task/checkActivityCompletedCurrent.php'; 
                  $result_completed_data = $result_completed->fetch(PDO::FETCH_ASSOC);
                  if($result_completed_data['count_completed'] > 0)
                  {
                    include 'activity-display-completed.php';}
                  }
              ?>

            </div>
          </div>
        </div>
      </div>
      <!-- /page content -->
     
    </div>
  </div>
</body>
<?php include '../../footer/footer.php'; ?>