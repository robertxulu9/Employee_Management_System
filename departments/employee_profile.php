<?php
require_once '../db.php';

if (!isset($_GET['id'])) {
    die("Invalid request.");
}

$employee_id = $_GET['id'];
$query = "SELECT * FROM employees WHERE employee_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $employee_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows != 1) {
    die("Employee not found.");
}

$employee = $result->fetch_assoc();

// Calculate leave days
$current_date = new DateTime();
$date_of_hire = new DateTime($employee['date_of_hire']);
$interval = $date_of_hire->diff($current_date);
$total_months = ($interval->y * 12) + $interval->m;
$total_leave_days = $total_months * 2;
$available_leave_days = $total_leave_days - $employee['used_leave_days'];

// Handle leave approval
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['approve_leave'])) {
    $approved_days = intval($_POST['approved_days']);
    if ($approved_days <= $available_leave_days && $approved_days > 0) {
        $employee['used_leave_days'] += $approved_days;
        $employee['leave_status'] = 'On Leave';

        $update_query = "UPDATE employees SET used_leave_days = ?, leave_status = ? WHERE employee_id = ?";
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bind_param("iss", $employee['used_leave_days'], $employee['leave_status'], $employee_id);
        $update_stmt->execute();
    }
}

// Handle maternity leave
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['maternity_leave'])) {
    if ($employee['gender'] == 'Female') {
        $employee['on_maternity_leave'] = 'Yes';
        $maternity_leave_days = intval($_POST['maternity_leave_days']);
        $employee['maternity_leave_days'] += $maternity_leave_days;

        $update_query = "UPDATE employees SET on_maternity_leave = 'Yes', maternity_leave_days = ? WHERE employee_id = ?";
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bind_param("is", $employee['maternity_leave_days'], $employee_id);
        $update_stmt->execute();
    }
}

// Handle information update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_info'])) {
    $phone_number = $_POST['phone_number'];
    $email_address = $_POST['email_address'];
    $job_title = $_POST['job_title'];
    $department = $_POST['department'];
    $marital_status = $_POST['marital_status'];
    $address = $_POST['address'];
    $salary_wage = $_POST['salary_wage'];

    $update_query = "UPDATE employees SET phone_number = ?, email_address = ?, job_title = ?, department = ?, marital_status = ?, address = ?, salary_wage = ? WHERE employee_id = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("ssssssss", $phone_number, $email_address, $job_title, $department, $marital_status, $address, $salary_wage, $employee_id);
    $update_stmt->execute();
}

?>

<?php include 'header.php'; // Include your header file ?>

<div class="container mt-5">
    <h1>Employee Profile</h1>
    <h3><?php echo htmlspecialchars($employee['first_name'] . ' ' . $employee['middle_name'] . ' ' . $employee['last_name']); ?></h3>
    
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header">
                    Basic Information
                </div>
                <div class="card-body">
                    <p><strong>Employee ID:</strong> <?php echo htmlspecialchars($employee['employee_id']); ?></p>
                    <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($employee['dob']); ?></p>
                    <p><strong>Gender:</strong> <?php echo htmlspecialchars($employee['gender']); ?></p>
                    <p><strong>Marital Status:</strong> <?php echo htmlspecialchars($employee['marital_status']); ?></p>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    Employment Details
                </div>
                <div class="card-body">
                    <p><strong>Job Title:</strong> <?php echo htmlspecialchars($employee['job_title']); ?></p>
                    <p><strong>Department:</strong> <?php echo htmlspecialchars($employee['department']); ?></p>
                    <p><strong>Date of Hire:</strong> <?php echo htmlspecialchars($employee['date_of_hire']); ?></p>
                    <p><strong>Salary/Wage:</strong> <?php echo htmlspecialchars($employee['salary_wage']); ?></p>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header">
                    Contact Information
                </div>
                <div class="card-body">
                    <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($employee['phone_number']); ?></p>
                    <p><strong>Email Address:</strong> <?php echo htmlspecialchars($employee['email_address']); ?></p>
                    <p><strong>Address:</strong> <?php echo htmlspecialchars($employee['address']); ?></p>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    Leave Information
                </div>
                <div class="card-body">
                    <p><strong>Leave Status:</strong> <?php echo htmlspecialchars($employee['leave_status']); ?></p>
                    <p><strong>Used Leave Days:</strong> <?php echo htmlspecialchars($employee['used_leave_days']); ?></p>
                    <p><strong>Available Leave Days:</strong> <?php echo htmlspecialchars($available_leave_days); ?></p>
                    
                    <?php if ($employee['gender'] == 'Female'): ?>
                        <p><strong>Maternity Leave Days:</strong> <?php echo htmlspecialchars($employee['maternity_leave_days']); ?></p>
                        <p><strong>On Maternity Leave:</strong> <?php echo htmlspecialchars($employee['on_maternity_leave']); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <?php if ($department === 'Human Resource'): ?>
            <div class="card mb-3">
                <div class="card-header">
                    Approve Leave
                </div>
                <div class="card-body">
                    <form action="employee_profile.php?id=<?php echo htmlspecialchars($employee['employee_id']); ?>" method="post">
                        <div class="form-group">
                            <label for="approved_days">Approve Leave Days:</label>
                            <input type="number" class="form-control" id="approved_days" name="approved_days" min="1" max="<?php echo $available_leave_days; ?>">
                        </div>
                        <button type="submit" name="approve_leave" class="btn btn-primary">Approve Leave</button>
                    </form>
                </div>
            </div>

            <?php if ($employee['gender'] == 'Female'): ?>
                <div class="card mb-3">
                    <div class="card-header">
                        Approve Maternity Leave
                    </div>
                    <div class="card-body">
                        <form action="employee_profile.php?id=<?php echo htmlspecialchars($employee['employee_id']); ?>" method="post">
                            <div class="form-group">
                                <label for="maternity_leave_days">Maternity Leave Days:</label>
                                <input type="number" class="form-control" id="maternity_leave_days" name="maternity_leave_days" min="1">
                            </div>
                            <button type="submit" name="maternity_leave" class="btn btn-primary">Approve Maternity Leave</button>
                        </form>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>


        <div class="card mb-3">
            <div class="card-header">
                Edit Information
            </div>
            <div class="card-body">
                <form action="employee_profile.php?id=<?php echo htmlspecialchars($employee['employee_id']); ?>" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="phone_number">Phone Number:</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo htmlspecialchars($employee['phone_number']); ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email_address">Email Address:</label>
                            <input type="email" class="form-control" id="email_address" name="email_address" value="<?php echo htmlspecialchars($employee['email_address']); ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="job_title">Job Title:</label>
                            <input type="text" class="form-control" id="job_title" name="job_title" value="<?php echo htmlspecialchars($employee['job_title']); ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="department">Department:</label>
                            <input type="text" class="form-control" id="department" name="department" value="<?php echo htmlspecialchars($employee['department']); ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="marital_status">Marital Status:</label>
                            <input type="text" class="form-control" id="marital_status" name="marital_status" value="<?php echo htmlspecialchars($employee['marital_status']); ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="address">Address:</label>
                            <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars($employee['address']); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="salary_wage">Salary/Wage:</label>
                        <input type="text" class="form-control" id="salary_wage" name="salary_wage" value="<?php echo htmlspecialchars($employee['salary_wage']); ?>">
                    </div>
                    <button type="submit" name="update_info" class="btn btn-primary">Update Information</button>
                </form>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php include 'footer.php';?> 
