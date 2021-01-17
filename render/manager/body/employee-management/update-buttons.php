<?php $id = $_POST['id']; ?>
<div class="col-md-9 col-sm-9  offset-md-3">
  <button type="button" class="btn btn-danger" onclick="editViewMode()"><i class="glyphicon glyphicon-remove"></i> Cancel</button>
  <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="updateMode('<?php echo $id; ?>')"><i class="glyphicon glyphicon-pencil"></i> Save</button>
</div>