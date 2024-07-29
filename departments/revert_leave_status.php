<?php
require_once '../db.php';

if ($argc != 2) {
    die("Usage: php revert_leave_status.php <employee_id>\n");
}

$employee_id = $argv[1];

// Update leave_status in employees table
$query = "
    UPDATE employees 
    SET leave_status = 'Active', leave_end_date = NULL 
    WHERE id = ? AND leave_end_date = CURDATE()
";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $employee_id);
$stmt->execute();
$stmt->close();
?>
