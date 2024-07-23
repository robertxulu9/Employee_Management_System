<!-- change_password_handler.php -->
<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_SESSION['username'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        $_SESSION['error'] = "New passwords do not match.";
        header("Location: change_password.php");
        exit();
    }

    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($hashed_password);
    $stmt->fetch();

    if ($stmt->num_rows == 1 && password_verify($old_password, $hashed_password)) {
        $new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $update_stmt = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");
        $update_stmt->bind_param("ss", $new_hashed_password, $username);

        if ($update_stmt->execute()) {
            $_SESSION['success'] = "Password changed successfully. Please log in again.";
            session_unset();
            session_destroy();
            header("Location: login.php");
            exit();
        } else {
            $_SESSION['error'] = "Error updating password.";
            header("Location: change_password.php");
            exit();
        }

        $update_stmt->close();
    } else {
        $_SESSION['error'] = "Old password is incorrect.";
        header("Location: change_password.php");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
