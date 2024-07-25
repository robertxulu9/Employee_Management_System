<?php
session_start();
include '../db.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Basic Information
    $employee_id = $_POST['employee_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $middle_name = $_POST['middle_name'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $marital_status = $_POST['marital_status'];
    
    // Contact Information
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $postal_code = $_POST['postal_code'];
    $country = $_POST['country'];
    $phone_number = $_POST['phone_number'];
    $email_address = $_POST['email_address'];
    
    // Employment Details
    $job_title = $_POST['job_title'];
    $department = $_POST['department'];
    $date_of_hire = $_POST['date_of_hire'];
    $employment_type = $_POST['employment_type'];
    $work_location = $_POST['work_location'];
    $manager_supervisor = $_POST['manager_supervisor'];
    
    // Compensation and Benefits
    $salary_wage = $_POST['salary_wage'];
    $pay_frequency = $_POST['pay_frequency'];
    $benefits_enrollment = $_POST['benefits_enrollment'];
    
    // Insert data into database
    $stmt = $conn->prepare("INSERT INTO employees (employee_id, first_name, last_name, middle_name, dob, gender, marital_status, address, city, state, postal_code, country, phone_number, email_address, job_title, department, date_of_hire, employment_type, work_location, manager_supervisor, salary_wage, pay_frequency, benefits_enrollment) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssssssssssssssss", $employee_id, $first_name, $last_name, $middle_name, $dob, $gender, $marital_status, $address, $city, $state, $postal_code, $country, $phone_number, $email_address, $job_title, $department, $date_of_hire, $employment_type, $work_location, $manager_supervisor, $salary_wage, $pay_frequency, $benefits_enrollment);
    
    if ($stmt->execute()) {
        $_SESSION['success'] = "Employee added successfully!";
    } else {
        $_SESSION['error'] = "Error adding employee. Please try again.";
    }
    
    $stmt->close();
    $conn->close();
    
    // Redirect back to the form page
    header("Location: add_employee.php");
    exit();
}
