<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username']) || $_SESSION['department'] !== 'Chief Administrator') {
    header("Location: ../login.php");
    exit();
}

if (isset($_GET['id'])) {
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $_GET['id']);

    if ($stmt->execute()) {
        $_SESSION['success'] = "User deleted successfully.";
    } else {
        $_SESSION['error'] = "Error deleting user.";
    }

    $stmt->close();
    header("Location: edit_user.php");
    exit();
}
?>
