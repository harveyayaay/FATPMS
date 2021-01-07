<?php

  echo $_SESSION['employee_id'];

  $Y = $_POST['Y'];
  $m = $_POST['m'];
  $d = $_POST['d'];

  $date = $Y.'-'.$m.'-'.$d;
  $date = date( "F j", strtotime( $date. " +0day"));
  $day = date( "l", strtotime( $date. " +0day"));
?>
<table class="table" id="t2"> 
  <thead>
    <tr>
      <th></th>
      <th colspan="13"><h6><?php echo $date .' ('.$day. ')'; ?></h6></th>
    </tr>
  </thead>
  <tbody class=" text-primary">
    <tr>
      <th>Frontliners</th>
      <?php 

      // for($c=0; $c<5; $c++)
      // {
        for($i=4; $i<17; $i++)
        {
          $hour = $i;
          
          if($hour > 12)
          {
            $hour = $hour - 12;
            $ampm = 'AM';
          }
          else
          {
            $ampm = 'PM';
          }
          if($hour < 10)
          {
            if($i < 16)
            {
              echo '<td>0'.$hour.':00 '.$ampm.'</td>';
              echo '<td>0'.$hour.':30 '.$ampm.'</td>';
            }
            else
            {
              echo '<td>0'.$hour.':00 '.$ampm.'</td>';
            }
            
          }
          else
          {
            echo '<td>'.$hour.':00 '.$ampm.'</td>';
            echo '<td>'.$hour.':30 '.$ampm.'</td>';
          }
        }
      // }
        
      ?>
      
    </tr> <!-- end of coltime -->

    <?php include '../../../process/create/schedule/getEmployeeName.php' ?>
     
  </tbody>
</table>