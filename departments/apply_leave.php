<?php
require_once '../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $employee_id = $_POST['employee_id'];
    $leave_days_requested = $_POST['leave_days'];
    $start_date = $_POST['start_date'];
    $end_date = date('Y-m-d', strtotime($start_date . ' + ' . $leave_days_requested . ' days'));

    // Insert leave application into leave_application table
    $query = "
        INSERT INTO leave_application (employee_id, leave_days_requested, leave_days, maternity_leave_days, leave_status, leave_approval, start_date, end_date)
        VALUES (?, ?, 0, 0, 'Pending', 'Pending', ?, ?)
    ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('iiiss', $employee_id, $leave_days_requested, $start_date, $end_date);
    $stmt->execute();
    $stmt->close();

    header('Location: leave_application.php?success=1');
}
?>
