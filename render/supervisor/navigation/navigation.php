<div class="col-md-3 left_col">
  <div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
      <a href="index.html" class="site_title"><i class="fa fa-spinner"></i> <span>GEMINI</span></a>
    </div>

    <div class="clearfix"></div>

    <!-- menu profile quick info -->
    <div class="profile clearfix">
      <div class="profile_pic">
        <img src="../../../../components/production/images/img.jpg" alt="..." class="img-circle profile_img">
      </div>
      <div class="profile_info">
        <span>Welcome,</span>
        <h2><?php echo $result_emp_data['employee_fname'].' '.$result_emp_data['employee_lname']; ?></h2>
      </div>
    </div>

    <br/>

    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">
          <li>
            <a href="../dashboard/dashboard.php">
              <i class="fa fa-home"></i>
              Dashboard 
            </a>
          </li>
          <li>
            <a href="../activity-monitoring/activity-monitoring.php">
              <i class="fa fa-home"></i>
              Activity Monitoring
            </a>
          </li>
          <li><a><i class="fa fa-edit"></i> Performance Report <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="../scorecard/scorecard.php">Scorecard</a></li>
              <li><a href="../productivity-report/productivity-report.php">Productivity Report</a></li>
            </ul>
          </li>
          <li>
            <a href="../scheduling/scheduling.php">
              <i class="fa fa-home"></i>
              Scheduling
            </a>
          </li>
        </ul>
      </div>
      <div class="sidebar-footer hidden-small">
        <a data-toggle="tooltip" data-placement="top" title="Settings">
          <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
        </a>
        <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
          <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
        </a>
      </div>
    </div>
  </div>
</div>

            