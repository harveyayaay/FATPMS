<?php
	include_once '../../../process/config/database.php';
	include_once '../../../process/obj/schedule.php';

	$conn = new Database();

	$Sched = new Schedule($conn->databaseConnection());

	$result = $Sched->getMaxDate();
	$result_data = $result->fetch(PDO::FETCH_ASSOC);

	if($result_data['maxdate'] < date('Y-m-d', strtotime($date)))
	{
		echo'
          <div class="table-responsive">
            <form action="../../../process/create/excel/importExcelFile.php" method="POST" enctype="multipart/form-data">
              <input type="file" name="excel">
              <input type="submit" name="submit">
            </form>
          </div>';
	}
?>