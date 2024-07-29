<?php
session_start();
require_once '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['employee_id'])) {
        $employee_id = $_POST['employee_id'];

        // Fetch available leave days
        $stmt = $conn->prepare("SELECT leave_days FROM employees WHERE id = ?");
        $stmt->bind_param("i", $employee_id);
        $stmt->execute();
        $stmt->bind_result($leave_days);
        $stmt->fetch();
        $stmt->close();

        // Return the available leave days
        echo $leave_days;
    }
}

$conn->close();
?>
