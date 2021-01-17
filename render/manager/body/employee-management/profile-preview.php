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
        <form class="form-horizontal form-label-left">
          <div class="form-group row">
            <label class="control-label col-md-3 col-sm-3 ">First Name: </label>
            <div class="col-md-9 col-sm-9 ">
              <input type="text" class="form-control" value="<?php echo $result_emp_data['employee_fname'] ?>" placeholder="First Name" id="field-fname" disabled>
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-3 col-sm-3 ">Last Name: </label>
            <div class="col-md-9 col-sm-9 ">
              <input type="text" class="form-control" value="<?php echo $result_emp_data['employee_lname'] ?>" placeholder="Last Name" id="field-lname" disabled>
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-3 col-sm-3 ">Email: </label>
            <div class="col-md-9 col-sm-9 ">
              <input type="email" class="form-control" value="<?php echo $result_emp_data['employee_email'] ?>" placeholder="Email" id="field-email" disabled>
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-3 col-sm-3 ">Contact: </label>
            <div class="col-md-9 col-sm-9 ">
              <input type="text" class="form-control" value="<?php echo $result_emp_data['employee_contact'] ?>" placeholder="Contact" id="field-contact" disabled>
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-3 col-sm-3 ">Position Title: </label>
            <div class="col-md-9 col-sm-9 ">
              <select class="form-control" id="field-position" disabled>
                <option hidden selected><?php echo $result_emp_data['employee_position_title'] ?></option>
                <option>Frontliner</option>
                <option>Supervisor</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-3 col-sm-3 ">Status: </label>
            <div class="col-md-9 col-sm-9 ">
              <select class="form-control" id="field-status" disabled>
                <option hidden selected><?php echo $result_emp_data['employee_status'] ?></option>
                <option>Active</option>
                <option>Inactive</option>
              </select>
            </div>
          </div>
          <div class="modal-footer" id="change-buttons">
            <div class="col-md-9 col-sm-9  offset-md-3">
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Close</button>
              <button type="button" class="btn btn-primary"  onclick="editViewMode('<?php echo $id; ?>')"><i class="glyphicon glyphicon-pencil"></i> Edit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <?php
  }
?>

