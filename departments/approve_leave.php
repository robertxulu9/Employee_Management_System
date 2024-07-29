<?php
require_once '../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $application_id = $_POST['application_id'];
    $approval_status = $_POST['approval_status']; // 'Approved' or 'Rejected'

    // Fetch leave application details
    $query = "
        SELECT employee_id, leave_days_requested, start_date, end_date 
        FROM leave_application 
        WHERE id = ?
    ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $application_id);
    $stmt->execute();
    $stmt->bind_result($employee_id, $leave_days_requested, $start_date, $end_date);
    $stmt->fetch();
    $stmt->close();

    if ($approval_status == 'Approved') {
        // Update leave_days and leave_end_date in employees table
        $query = "
            UPDATE employees 
            SET leave_days = leave_days - ?, leave_status = 'On Leave', leave_end_date = ?
            WHERE id = ?
        ";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('isi', $leave_days_requested, $end_date, $employee_id);
        $stmt->execute();
        $stmt->close();

        // Schedule a script to change leave_status back to 'Active' after leave ends
        // This is a simplified example using a cron job approach
        $cron_command = 'echo "php /path/to/revert_leave_status.php ' . $employee_id . '" | at ' . $end_date . ' 00:00';
        shell_exec($cron_command);

        // Update leave_application table
        $query = "
            UPDATE leave_application 
            SET leave_status = 'Approved', leave_days = ?, leave_approval = 'Approved', start_date = ?, end_date = ?
            WHERE id = ?
        ";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('isss', $leave_days_requested, $start_date, $end_date, $application_id);
        $stmt->execute();
        $stmt->close();
    } else {
        // Update leave_application table for rejection
        $query = "
            UPDATE leave_application 
            SET leave_status = 'Rejected', leave_approval = 'Rejected' 
            WHERE id = ?
        ";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $application_id);
        $stmt->execute();
        $stmt->close();
    }

    header('Location: leave_approval.php?success=1');
}
?>
