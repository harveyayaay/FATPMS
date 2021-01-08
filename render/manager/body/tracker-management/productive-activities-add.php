<div id="add-activity">
  <div class="x_content">
    <p><i class="glyphicon glyphicon-plus" style="visibility: hidden;"></i> Add Activity</p>
  </div>
  <div class="x_content">
    <div class="item form-group">
      <label for="middle-name" class="col-form-label col-md-4 col-sm-4 label-align">Activity Title</label>
      <div class="col-md-4 col-sm-4 ">
        <input id="middle-name" class="form-control" type="text" name="middle-name">
      </div>
    </div>
    <div class="item form-group">
      <label for="middle-name" class="col-form-label col-md-4 col-sm-4 label-align">Process Time</label>
      <div class="col-md-4 col-sm-4 ">
        <input id="middle-name" class="form-control" type="text" name="middle-name" placeholder="hh:mm:ss">
      </div>
    </div>
    <div class="item form-group">
      <label for="middle-name" class="col-form-label col-md-4 col-sm-4 label-align">LSA</label>
      <div class="col-md-4 col-sm-4 ">
        <input id="middle-name" class="form-control" type="text" name="middle-name" placeholder="hh:mm:ss">
      </div>
    </div>
    <div class="item form-group">
    <label for="middle-name" class="col-form-label col-md-4 col-sm-4 label-align">Level</label>
      <div class="col-md-4 col-sm-4 ">
        <select class="form-control">
          <option>Primary</option>
          <option>Secondary</option>
        </select>
      </div>
    </div>
    <div class="ln_solid"></div>
    <div class="item form-group">
      <div class="col-md-4 col-sm-3 offset-md-5">
        <button class="btn btn-primary btn-sm" type="button" onclick="closeAddActivityFields()">Cancel</button>
        <button class="btn btn-primary btn-sm" type="reset">Reset</button>
        <button class="btn btn-success btn-sm" data-toggle="modal" data-target=".confirmation-modal">Submit</button>
      </div>
    </div>
  </div>
</div>
<?php include 'confirmation-modal.php'; ?>
