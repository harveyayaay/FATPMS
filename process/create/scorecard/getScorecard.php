<?php

  include_once '../../../process/config/database.php';
  include_once '../../../process/obj/scorecard.php';

  $conn = new Database();
  date_default_timezone_set('Asia/Manila');

  $Score = new Scorecard($conn->databaseConnection());

  $id = 'GMF0001';
  $date1 = '2020-09-18';
  $date2 = date('Y-m-d');

  echo
    '<table class="table">
      <thead class=" text-primary">
        <tr class="table-bordered">
          <td>Metric</td>
          <td>Actual</td>
          <td>Score</td>
        </tr>
      </thead>';
  // Volume
  $vol_score = $Score->getVolumeScore($id, $date1, $date2);
  $vol_score_data = $vol_score ->fetch( PDO::FETCH_ASSOC);

  $pending_task = 2000;
  $done_task = $vol_score_data['count'];

  $percentage = ($done_task / $pending_task) * 100;

  if($percentage > 75)
    if($percentage > 100)
      if($percentage > 111)
        if($percentage > 126) 
          $score1 = '3.0';
        else $score1 = '2.5';
      else $score1 = '2.0';
    else $score1 = '1.5';
  else $score1 = '1.0';

  // Application Processing Time
  $app_proc_time = $Score->getAppProcessTime($id, $date1, $date2);
  $app_proc_time_data = $app_proc_time ->fetch( PDO::FETCH_ASSOC);
  $avg_app_proc_time = $app_proc_time_data['avg'];

  if($avg_app_proc_time > 6.16)
    if($avg_app_proc_time > 4.93)
      if($avg_app_proc_time > 4.43)
        if($avg_app_proc_time > 4.18)
          $score2 = '3.0';
        else $score2 = '2.5';
      else $score2 = '2.0';
    else $score2 = '1.5';
  else $score2 = '1.0';

  // Urgent Processing Time
  $urgent_proc_time = $Score->getUrgentProcessTime($id, $date1, $date2);
  $urgent_proc_time_data = $urgent_proc_time ->fetch( PDO::FETCH_ASSOC);
  $avg_urgent_proc_time = $urgent_proc_time_data['avg'];

  if($avg_urgent_proc_time > 4.39)
    if($avg_urgent_proc_time > 3.51)
      if($avg_urgent_proc_time > 3.15)
        if($avg_urgent_proc_time > 2.98)
          $score3 = '3.0';
        else $score3 = '2.5';
      else $score3 = '2.0';
    else $score3 = '1.5';
  else $score3 = '1.0';

  // Final Scorecard
  $final_score = ($score1 + $score2 + $score3) / 3;
  $final_score_value = number_format($final_score, 1);

  echo
    '<tr class="table-bordered">
      <td>Volume</td>
      <td>'.$percentage .'%</td>
      <td>'.$score1.'</td>
    </tr>
    <tr class="table-bordered">
      <td>Application Processing Time</td>
      <td>'.$avg_app_proc_time.'</td>
      <td>'.$score2.'</td>
    </tr>
    <tr class="table-bordered">
      <td>Urgent Processing Time</td>
      <td>'.$avg_urgent_proc_time.'</td>
      <td>'.$score3.'</td>
    </tr>
    <tr>
      <th>Final Score</th>
      <td></td>
      <th>'.$final_score_value.'</th>
    </tr>'
    ;
  //   <tr>
  //     <td>Quality Assurance</td>
  //     <td></td>
  //     <td></td>
  //   </tr>
  //   <tr>
  //     <td>Escalation</td>
  //     <td></td>
  //     <td></td>
  // </tr>';

  echo '</table>'

?>
