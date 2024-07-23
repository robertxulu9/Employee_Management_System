<!-- add_user.php -->
<?php include 'header.php'; ?>

<div class="container mt-5">
    <h1>Add New User</h1>
    <form action="add_user_handler.php" method="post">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="department">Department:</label>
            <select class="form-control" id="department" name="department" required>
                <option value="Registry clerks">Registry clerks</option>
                <option value="Human Resource officers">Human Resource officers</option>
                <option value="Chief Administrator">Chief Administrator</option>
                <option value="Director Human Resources and Administration">Director Human Resources and Administration</option>
                <option value="Deputy Director Human Resources">Deputy Director Human Resources</option>
                <option value="Chief Human Resource Management officer">Chief Human Resource Management officer</option>
                <option value="Senior Human Resource officers">Senior Human Resource officers</option>
                <option value="Chief accountant">Chief accountant</option>
                <option value="Principal accountant">Principal accountant</option>
                <option value="Senior Accountant">Senior Accountant</option>
                <option value="Accountants">Accountants</option>
            </select>
        </div>
        <div class="form-group">
            <label for="password">Default Password:</label>
            <input type="password" class="form-control" id="password" name="password" value="defaultpassword" required>
        </div>
        <button type="submit" class="btn btn-primary">Add User</button>
    </form>
</div>

<?php include 'footer.php'; ?>
