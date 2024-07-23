<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username']) || $_SESSION['department'] !== 'Chief Administrator') {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $default_password = password_hash('defaultpassword', PASSWORD_DEFAULT);
    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
    $stmt->bind_param("si", $default_password, $_GET['id']);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Password reset successfully.";
    } else {
        $_SESSION['error'] = "Error resetting password.";
    }

    $stmt->close();
    header("Location: admin.php");
    exit();
}
?>
