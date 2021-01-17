<?php $id = $_POST['id']; ?>
<div class="col-md-9 col-sm-9  offset-md-3">
  <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Close</button>
  <button type="button" class="btn btn-primary"  onclick="editViewMode('<?php echo $id; ?>')"><i class="glyphicon glyphicon-pencil"></i> Edit</button>
</div>