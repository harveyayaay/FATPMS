create database initial_project_database_design;

CREATE TABLE IF NOT EXISTS employee_account (
    employee_id VARCHAR(50),
    employee_password VARCHAR(100),
    employee_fname VARCHAR(100),
    employee_mname VARCHAR(100),
    employee_lname VARCHAR(100),
    employee_email VARCHAR(100),
    employee_contact VARCHAR(100),
    employee_image VARCHAR(100),
    employee_hire_date DATE,
    employee_date_time_creation DATETIME,
    employee_position_title VARCHAR(100),
    employee_status VARCHAR(100),
    PRIMARY KEY (employee_id)
);

CREATE TABLE IF NOT EXISTS task_table (
    task_id INT AUTO_INCREMENT,
    task_datetime DATE,
    task_type VARCHAR(100),
    task_client_name VARCHAR(100),
    task_client_id VARCHAR(100),	
    task_date_received VARCHAR(100),
    task_start_time TIME,
    task_hold_start_time TIME,
    task_hold_end_time TIME,
    task_end_time TIME,
	task_duration TIME,
    task_status VARCHAR(100),
    task_employee_id VARCHAR(50),
    PRIMARY KEY (task_id)
);

CREATE TABLE IF NOT EXISTS scheduling_table (
    scheduling_id INT AUTO_INCREMENT,
    scheduling_emp_id VARCHAR(100),
    scheduling_date DATE,
    scheduling_from TIME,
    scheduling_to TIME,
    PRIMARY KEY (scheduling_id)
  );
  
CREATE TABLE IF NOT EXISTS task_list_table (
    task_list_id INT AUTO_INCREMENT,
    task_list_title VARCHAR(100),
    task_list_process_time VARCHAR(100),
    task_list_sla VARCHAR(100),
    task_list_importance VARCHAR(100),
    PRIMARY KEY (task_list_id)
  );

CREATE TABLE IF NOT EXISTS schedule_table (
	schedule_count_id INT AUTO_INCREMENT,
    schedule_id INT,
    schedule_task_list_id VARCHAR(100),
    schedule_time_from VARCHAR(100),
    schedule_time_to VARCHAR(100),
    PRIMARY KEY (schedule_count_id)
  );
  
CREATE TABLE IF NOT EXISTS settings_admin_table (
	settings_id INT AUTO_INCREMENT,
    settings_title VARCHAR(100),
    settings_set VARCHAR(100),
    PRIMARY KEY (settings_id)
  );
  
CREATE TABLE IF NOT EXISTS notif_table (
	notif_id INT AUTO_INCREMENT,
    notif_message VARCHAR(100),
    notif_date VARCHAR(100),
    notif_time VARCHAR(100),
    notif_receiver VARCHAR(100),
    notif_status VARCHAR(100),
    PRIMARY KEY (notif_id)
  );
  
CREATE TABLE IF NOT EXISTS metric_table (
	metric_id INT AUTO_INCREMENT,
    metric_title VARCHAR(100), 
    metric_type VARCHAR(100),
    metric_goal VARCHAR(100),
    metric_reference VARCHAR(100),
    PRIMARY KEY (metric_id)
  );

CREATE TABLE IF NOT EXISTS performance_table (
	performance_id INT AUTO_INCREMENT,
    performance_metric_id VARCHAR(100), 
    performance_range VARCHAR(100),
    performance_from VARCHAR(100),
    performance_to VARCHAR(100),
    PRIMARY KEY (performance_id)
  );