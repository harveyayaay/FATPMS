<?php
	include_once '../../../process/config/database.php';
	include_once '../../../process/obj/employee.php';

	$conn = new Database();

	$Employee = new Employee($conn->databaseConnection());
?>
	<div class="card-body">
    <div class="row">
    	<div class="card-reports">
    		<div class="card col-md-12">
				<?php
					$count = 0;
					$result_emp = $Employee->getAllFrontliner();
					while($result_emp_data = $result_emp->fetch(PDO::FETCH_ASSOC))
					{
						?>
							<a href="#" class="anchor" data-target="#viewModal" onclick="changeScorecard(<?php echo $result_emp_data['employee_id'].', '.$count; ?>)">
								<div class="scorecard-list">
									<p><?php echo $result_emp_data['employee_fname'].' '.$result_emp_data['employee_lname']; ?></p>
								</div>
							</a>
							<div class="scorecard-view" id="scorecardView<?php echo $count; ?>">
								<table class="table table-bordered">
									<tr>
										<td>Metric</td>
										<td>Actual</td>
										<td>Goal</td>
										<td>Performance Percentage</td>
										<td>Score</td>
									</tr>
									<tr>
										<td>Volume</td>
									</tr>
									<tr>
										<td>Average Processing Time (Gemini)</td>
									</tr>
									<tr>
										<td>Average Processing Time (OIG/GSA)</td>
									</tr>
									<tr>
										<td>Quality</td>
									</tr>
								</table>
							</div>
						<?php
							++$count;
					}
				?>
				</div>
				
    	</div>
		</div>
  </div>

<div id="viewModal" class="modal fade">
  <div class="modal-dialog modal-xl">
    <div class="card container modal-content">
      <form action="" method="post">
      	<div id=changeScorecard>
      		
      	</div>
      </form>
    </div>
  </div>
</div>
