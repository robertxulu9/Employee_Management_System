<?php
session_start();
require_once '../db.php';

// Fetch the Chief Administrator's user ID from the users table
$admin_id_query = $conn->query("SELECT id FROM users WHERE job_title = 'Chief Administrator'");
$admin_id = $admin_id_query->fetch_assoc()['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employee_id = $_POST['employee_id'];
    $loan_amount = $_POST['loan_amount'];
    $payment_method = $_POST['payment_method'];

    // Fetch employee information
    $query = "SELECT * FROM employees WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $employee_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $employee = $result->fetch_assoc();

    if ($employee) {
        $first_name = $employee['first_name'];
        $last_name = $employee['last_name'];

        // Check if the employee already has a pending loan
        $stmt = $conn->prepare("SELECT id FROM loans WHERE employee_id = ? AND status = 'Pending'");
        $stmt->bind_param("i", $employee_id);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Employee already has a pending loan
            echo "<script type='text/javascript'>
                    alert('The employee already has a pending loan.');
                    window.location.href = 'loan_application.php';
                  </script>";
        } else {
            // Insert the loan application into the loans table
            $stmt = $conn->prepare("INSERT INTO loans (employee_id, amount, payment_method, status) VALUES (?, ?, ?, 'Pending')");
            $stmt->bind_param("ids", $employee_id, $loan_amount, $payment_method);
            $stmt->execute();

            // Insert the loan application into the loan_applications table
            $stmt = $conn->prepare("INSERT INTO loan_applications (employee_id, loan_amount, payment_method) VALUES (?, ?, ?)");
            $stmt->bind_param("idd", $employee_id, $loan_amount, $payment_method);

            if ($stmt->execute()) {
                $loan_id = $stmt->insert_id;

                // Insert notification for Chief Administrator
                $message = "Loan application request from $first_name $last_name for $$loan_amount with $payment_method% of salary per month.";
                $stmt = $conn->prepare("INSERT INTO notifications (sender_id, receiver_id, reference_id, type, message) VALUES (?, ?, ?, 'loan_application', ?)");
                $stmt->bind_param("iiis", $_SESSION['user_id'], $admin_id, $loan_id, $message);
                $stmt->execute();
                $stmt->close();

                // Success message with redirect
                echo "<script type='text/javascript'>
                        alert('Loan application submitted successfully.');
                        setTimeout(function() {
                            window.location.href = 'form.php';
                        }, 000);
                      </script>";
            } else {
                // Error message
                $message = 'Failed to submit loan application.';
                echo "<script type='text/javascript'>
                        alert('$message');
                        window.location.href = 'loan_application.php';
                      </script>";
            }
        }
    } else {
        echo "<script type='text/javascript'>
                alert('Employee not found.');
                window.location.href = 'loan_application.php';
              </script>";
    }

    
}

$conn->close();
?>
