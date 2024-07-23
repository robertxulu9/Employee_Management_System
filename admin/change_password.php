<!-- change_password.php -->
<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
include 'header.php'; 
?>

<div class="container mt-5">
    <h1>Change Password</h1>
    <?php if (isset($_SESSION['error'])): ?>
        <div class="toast show" style="position: absolute; top: 20px; right: 20px;">
            <div class="toast-header">
                <strong class="mr-auto">Error</strong>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
            </div>
            <div class="toast-body">
                <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        </div>
    <?php endif; ?>
    <form action="change_password_handler.php" method="post">
        <div class="form-group">
            <label for="old_password">Old Password:</label>
            <input type="password" class="form-control" id="old_password" name="old_password" required>
        </div>
        <div class="form-group">
            <label for="new_password">New Password:</label>
            <input type="password" class="form-control" id="new_password" name="new_password" required>
        </div>
        <div class="form-group">
            <label for="confirm_password">Confirm New Password:</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Change Password</button>
    </form>
</div>

<?php include 'footer.php'; ?>
