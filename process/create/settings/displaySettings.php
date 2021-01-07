<?php
	include_once '../../../process/config/database.php';
	include_once '../../../process/obj/settings.php';

	$conn = new Database();

	$Settings = new Settings($conn->databaseConnection());
?>
	<table class="table">
		<tr>
			<td><input type="text" value="Title" class="title-table" disabled></td>
			<td><input type="text" value="Value" class="title-table" disabled></td>
		</tr>
		<tr>

<?php
	$result_qa = $Settings->getQA();
	if($result_qa_data = $result_qa->fetch(PDO::FETCH_ASSOC))	
	{
		echo '<td>'.$result_qa_data['settings_title'].'</td>';
		echo '<td><input type="text" name="" value="'.$result_qa_data['settings_set'].'"></td>';
	}

	echo '<tr>';

	$result_esc = $Settings->getESC();
	if($result_esc_data = $result_esc->fetch(PDO::FETCH_ASSOC))
	{
		echo '<td>'.$result_esc_data['settings_title'].'</td>';
		echo '<td><input type="text" name="" value="'.$result_esc_data['settings_set'].'"></td>';
	}

	echo '</tr>';

?>

		</tr>
	</table>

<style type="text/css">
	.title-table
	{
		color: #000;
		background-color: #fff;
		border: none;
	}
</style>