<?php
  $id = $_POST['checkuser'];
  $pass = $_POST['checkpass'];

  include '../../process/create/employee/countEmployeeUsingIdAndPassword.php'; 
  $result_notif_data = $result_notif->fetch(PDO::FETCH_ASSOC);
  if($result_notif_data['counted'] == 0)
  {
    header("Location: login.php");
  }
  else
  {
    include '../../process/create/employee/checkLogAccount.php'; 
    if($result_emp_data = $result_emp->fetch(PDO::FETCH_ASSOC))
    {
      
        session_start();
        $_SESSION['id'] = $id;
        if($result_emp_data['employee_position_title'] === 'Manager')
        {
          header("Location: ../manager/body/dashboard/dashboard.php");
        }
        if($result_emp_data['employee_position_title'] === 'Supervisor')
        {
          header("Location: ../supervisor/body/dashboard/dashboard.php");
        }
        if($result_emp_data['employee_position_title'] === 'Frontliner')
        {
          
          header("Location: ../frontliner/body/dashboard/dashboard.php");
        }
      }
      else
      {
        header("Location: login.php");
      }
    }
  }
  
?>