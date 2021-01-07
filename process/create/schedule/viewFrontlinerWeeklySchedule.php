<?php
  include_once '../../../process/config/database.php';
  include_once '../../../process/obj/schedule.php';

  $conn = new Database();

  $Sched = new Schedule($conn->databaseConnection());

  date_default_timezone_set('Asia/Manila');
  $datenow = date("Y-m-d");

  if($daynow != 'Monday')
      if($daynow != 'Tuesday')
        if($daynow != 'Wednesday')
          if($daynow != 'Thursday')
            if($daynow != 'Friday')
              if($daynow != 'Saturday')
                      $num = -6;
              else $num = -5;
            else $num = -4;
          else $num = -3;
        else $num = -2;
      else $num = -1;
    else $num = 0;

    $initial  = $num;
?>

<tr>
    <?php

      for($i=0; $i < 5; $i++)
      {
          $sched_date[0][$i] = date( "Y-m-d", strtotime($datenow. " +".$num."day"));
          ++$num;
      }

      for($i=0; $i < 5; $i++)
      {
        $schedulingId = $Sched->getSchedulingTableId($emp_id, $sched_date[0][$i]);
        if($schedulingId_data = $schedulingId ->fetch( PDO::FETCH_ASSOC))
        {
          $sched_date[1][$i] = $schedulingId_data['scheduling_id'] .'<br>'; 
        }
      }
          // include 'getFrontlinerWeekly.php';
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
