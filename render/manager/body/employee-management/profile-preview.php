<?php 
  $id = $_POST['id'];
  include '../../../../process/create/employee/getEmployeeUsingId.php'; 
  if($result_emp_data = $result_emp->fetch(PDO::FETCH_ASSOC))
  {
    ?>
      <div id="update-info">
        <div class="x_content">
          <div class="col-md-3 col-sm-3  profile_left">
            <div class="profile_img">
              <div id="crop-avatar">
                <!-- Current avatar -->
                <img class="img-responsive avatar-view" src="../../../../components/production/images/picture.jpg" alt="Avatar" title="Change the avatar">
              </div>
            </div>
          </div>
        </div>
        <div class="x_content">
          <br/>
          <div class="col-md-9 col-sm-9  profile_right">
            <div class="col-md-6 col-sm-6  form-group has-feedback">
              <input type="text" class="form-control has-feedback-left" id="field-fname" placeholder="First Name" value="<?php echo $result_emp_data['employee_fname'] ?>" disabled>
              <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
            </div>

            <div class="col-md-6 col-sm-6  form-group has-feedback">
              <input type="text" class="form-control" id="field-lname" placeholder="Last Name" value="<?php echo $result_emp_data['employee_lname'] ?>" disabled>
              <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
            </div>

            <div class="col-md-6 col-sm-6  form-group has-feedback">
              <input type="email" class="form-control has-feedback-left" id="field-email" placeholder="Email" value="<?php echo $result_emp_data['employee_email'] ?>" disabled>
              <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
            </div>

            <div class="col-md-6 col-sm-6  form-group has-feedback">
              <input type="tel" class="form-control" id="field-contact" placeholder="Phone" value="<?php echo $result_emp_data['employee_contact'] ?>" disabled>
              <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
            </div>
          </div>
        </div>
        <div class="modal-footer" id="change-buttons">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Close</button>
          <button type="button" class="btn btn-primary" onclick="editviewMode()"><i class="glyphicon glyphicon-pencil"></i> Edit</button>
        </div>
      </div>
    <?php
  }
?>

