<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username']) || $_SESSION['department'] !== 'Chief Administrator') {
    header("Location: ../login.php");
    exit();
}

include 'header.php'; 

$users = $conn->query("SELECT id, username, email, department FROM users");
?>

<div class="container mt-5">
    <h1>Admin Panel</h1>
    <?php if (isset($_SESSION['success'])): ?>
        <div class="toast show" style="position: absolute; top: 20px; right: 20px;">
            <div class="toast-header">
                <strong class="mr-auto">Success</strong>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
            </div>
            <div class="toast-body">
                <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
        </div>
    <?php endif; ?>
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
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Department</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($user = $users->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $user['username']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo $user['department']; ?></td>
                    <td>
                        <a href="edit_user.php?id=<?php echo $user['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="reset_password.php?id=<?php echo $user['id']; ?>" class="btn btn-info btn-sm">Reset Password</a>
                        <a href="delete_user.php?id=<?php echo $user['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>
