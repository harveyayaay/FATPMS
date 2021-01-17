<div class="col-md-12 col-sm-12 ">
  <div class="x_panel">

    <div class="x_title">
      <h2>Employee Management <small></small></h2>
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
        <?php 
          include '../../../../process/create/employee/getAllFrontliner.php'; 
          while($result_emp_data = $result_emp->fetch(PDO::FETCH_ASSOC))
          {
            ?>
            <div class="col-md-4 col-sm-4  profile_details">
              <div class="x_panel">
                <div class="col-sm-12">
                  <h4 class="brief"><i><?php echo $result_emp_data['employee_position_title']; ?></i></h4>
                  <div class="left col-sm-7">
                    <h2><?php echo $result_emp_data['employee_fname'].' '.$result_emp_data['employee_lname']; ?></h2>
                    <p><i class="fa fa-circle" style="color: green;"></i>  Active </p>
                    <ul class="list-unstyled">
                      <li><i class="fa fa-envelope"></i> Email: <?php echo $result_emp_data['employee_email']; ?></li>
                      <li><i class="fa fa-phone"></i> Phone: <?php echo $result_emp_data['employee_contact']; ?></li>
                    </ul>
                  </div>
                  <div class="right col-sm-5 text-center">
                    <img src="../../../../components/production/images/user.png" alt="" class="img-circle img-fluid">
                  </div>
                  <div class=" col-sm-6 emphasis">
                    <!-- <button type="button" class="btn btn-success btn-sm"> 
                      <i class="fa fa-user"></i> <i class="fa fa-comments-o"></i>
                    </button> -->
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".profile-view-modal" onclick="viewSpecificProfile('<?php echo $result_emp_data['employee_id']; ?>')">
                      <i class="fa fa-user"></i> View Profile
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <?php
          }
        ?>

        <!-- offline -->
        <div class="col-md-4 col-sm-4  profile_details">
              <div class="x_panel">
                <div class="col-sm-12">
                  <h4 class="brief"><i>Frontliner</i></h4>
                  <div class="left col-sm-7">
                    <h2>Ghetto Filipino</h2>
                    <p><i class="fa fa-circle" style="color: gray;"></i>  Offline </p>
                    <ul class="list-unstyled">
                      <li><i class="fa fa-envelope"></i> Email: ghettofilipino@gmail.com</li>
                      <li><i class="fa fa-phone"></i> Phone: 09922342345</li>
                    </ul>
                  </div>
                  <div class="right col-sm-5 text-center">
                    <img src="../../../../components/production/images/user.png" alt="" class="img-circle img-fluid">
                  </div>
                  <div class=" col-sm-6 emphasis">
                    <!-- <button type="button" class="btn btn-success btn-sm"> 
                      <i class="fa fa-user"></i> <i class="fa fa-comments-o"></i>
                    </button> -->
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".profile-view-modal" onclick="viewSpecificProfile('<?php echo $result_emp_data['employee_id']; ?>')">
                      <i class="fa fa-user"></i> View Profile
                    </button>
                  </div>
                </div>
              </div>
            </div>
      </div>
    </div>
  </div>
</div>

<?php include 'profile-view-modal.php'; ?>



