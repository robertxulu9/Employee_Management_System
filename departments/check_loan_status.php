<?php
require_once '../db.php';

if (isset($_POST['employee_id'])) {
    $employee_id = $_POST['employee_id'];

    // Check loan status
    $query = "SELECT * FROM loans WHERE employee_id = ? AND status = 'pending'";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $employee_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo 'has_loan';
    } else {
        echo 'no_loan';
    }
}
?>
