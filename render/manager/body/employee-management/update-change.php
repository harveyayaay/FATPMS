<?php
  $id = $_POST['id'];
  $fname = $_POST['field-fname'];
  $lname = $_POST['field-lname'];
  $email = $_POST['field-email'];
  $contact = $_POST['field-contact'];
  $position = $_POST['field-position'];
  $status = $_POST['field-status'];

  include '../../../../process/create/employee/updateEmployee.php'; 
  include 'change-landing-page.php'; 
?>