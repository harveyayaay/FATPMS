<!-- page content -->

<div class="col-md-12 col-sm-12  ">
  <div class="x_panel">
    <div class="x_title">
      <h2>Add Activity</h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <p class="text-muted font-13 m-b-30">
        (Add your current activity)
      </p>
      <form action="add-change.php" method="post">  
        <div class="form-horizontal form-label-left">
          <div class="form-group">
            <div class="col-md-4">
              <select name="a-task" class="form-control" id="a-task">
                <option hidden>- Select Activity -</option>
                <option>Application</option>
                <option>Urgent</option>
              </select>
              <!-- <input type="text" id="ex3" class="form-control" placeholder="Enter Case No."> -->
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-3">
              <input type="text" name="a-caseno" id="a-caseno" class="form-control" placeholder="Enter Case No.">
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-3">
              <input type="text" name="a-datetime" id="a-datetime" class="form-control" placeholder="Enter Date and Time Received">
            </div>
          </div>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".confirm-add-modal"><i class="fa fa-plus"></i> Add Task</button>
        </div>
        <?php include 'confirm-add-modal.php'; ?>
      </form>
    </div>
  </div>
</div>
<!-- /page content -->
