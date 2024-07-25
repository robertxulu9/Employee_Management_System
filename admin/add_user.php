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
                <option value="Registry clerks">Registry clerk</option>
                <option value="Human Resource">Human Resource</option>
                <option value="Accountants">Accountants</option>
            </select>
        </div>
        <div class="form-group">
            <label for="department">Job Title:</label>
            <input type="text" class="form-control" id="job_title" name="job_title" required>
            
        </div>
        <div class="form-group">
            <label for="password">Default Password:</label>
            <input type="password" class="form-control" id="password" name="password" value="defaultpassword" required>
        </div>
        <button type="submit" class="btn btn-primary">Add User</button>
    </form>
</div>

<?php include 'footer.php'; ?>
