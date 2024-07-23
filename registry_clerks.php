<?php
 session_start();
if (!isset($_SESSION['username'])) {
    header("Location: /login.php");
    exit();
}
include 'header.php'; 
?>



<?php include 'footer.php'; ?>
