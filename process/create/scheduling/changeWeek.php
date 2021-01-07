<?php
    $start = $_POST['start'];
    $num = $start;
    date_default_timezone_set('Asia/Manila');

    $date = date( "Y-m-d"); 
?>
<table class="table" id="t1">
  <thead class=" text-primary">
    <tr>
      <td><button href="" onmousedown="prevWeek(<?php echo $start; ?>)" class="dates">< Prev</button></td>
      <?php
          for($i = 0; $i<5; $i++)
          {
             echo'<td><button class="dates" onmousedown="changeSchedulingDate('.date( "Y", strtotime( $date. " +".$num."day")).', '.date('m', strtotime( $date. " +".$num."day")).', '.date('d', strtotime( $date. " +".$num."day")).')">'.date("F j", strtotime( $date. " +".$num."day")) .' ('.date( "l", strtotime( $date. " +".$num."day")).')</button></td>';
                          ++$num;
          }
      ?>
      <td><button href="" onmousedown="nextWeek(<?php echo $start; ?>)" class="dates">Next ></button></td>
    </tr>
  </thead>
</table>  