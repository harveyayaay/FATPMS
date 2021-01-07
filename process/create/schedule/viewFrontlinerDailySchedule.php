<?php
  include_once '../../../process/config/database.php';
  include_once '../../../process/obj/schedule.php';

  $conn = new Database();

  $Sched = new Schedule($conn->databaseConnection());
?>



<tr>
    <?php
        $count = 0;
        $schedulingId = $Sched->getSchedulingTableId($emp_id, $date);
        if($schedulingId_data = $schedulingId ->fetch( PDO::FETCH_ASSOC))
        {
          $sched_id = $schedulingId_data['scheduling_id'] .'<br>'; 
          ++$count;
        }
        if($count > 0)
        {
          include 'getFrontlinerDaily.php';
        }
        else
        {
          echo '<td>Today is '.date( "F j", strtotime( date('Y-m-d'). " +0day")).' ('.date( "l", strtotime( date('Y-m-d'). " +0day")).'). No schedule Available</td>';
        }
        // include 'getSecondaryFrontliner.php';
        
        // echo'<tr>';
        
      // echo $sched_date[0][0] . '<br>';
      // echo $sched_date[1][0] . '<br>';
      // echo $sched_date[0][1] . '<br>';
      // echo $sched_date[1][1] . '<br>';
      // echo $sched_date[0][2] . '<br>';
      // echo $sched_date[1][2] . '<br>';
      // echo $sched_date[0][3] . '<br>';
      // echo $sched_date[1][3] . '<br>';
      // echo $sched_date[0][4] . '<br>';
      // echo $sched_date[1][4] . '<br>';
      
      // else
      // {
      //   echo '<td style="color: black;" colspan="6" rowspan="1">No Schedule Available <b> (Click the Frontliners Name to Add Schedule)<b></td>';
      // }
    ?>
  </tr>
