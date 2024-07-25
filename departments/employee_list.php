<?php
include '../db.php'; // Include your database connection file

// Initialize variables
$search = isset($_POST['search']) ? $_POST['search'] : '';

// Fetch employees from the database
$sql = "SELECT * FROM employees WHERE CONCAT(first_name, ' ', last_name) LIKE ?";
$stmt = $conn->prepare($sql);
$searchTerm = "%$search%";
$stmt->bind_param('s', $searchTerm);
$stmt->execute();
$result = $stmt->get_result();
?>

<?php include 'header.php'; // Include your header file ?>
        <main>
            <div class="container-fluid">
                <h1 class="mt-0">Employee List</h1>
                
                <!-- Search Form -->
                <form method="POST" class="mb-4">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Search by name" value="<?php echo htmlspecialchars($search); ?>">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </form>

                <!-- Employee Table -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th> Full Name</th>
                                    <th>Date of Birth</th>
                                    <th>Gender</th>
                                    <th>Marital Status</th>
                                    <th>Phone Number</th>
                                    <th>Email Address</th>
                                    <th>Job Title</th>
                                    <th>Department</th>
                                    <th>Date of Hire</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($result->num_rows > 0): ?>
                                    <?php while ($row = $result->fetch_assoc()): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($row['employee_id']); ?></td>
                                            <td><a href="employee_profile.php?id=<?php echo htmlspecialchars($row['employee_id']); ?>">
                                            <?php echo htmlspecialchars($row['first_name']) . " " . htmlspecialchars($row['middle_name']) . " " . htmlspecialchars($row['last_name']); ?>
                                            </a></td>
                                            
                                            <td><?php echo htmlspecialchars($row['dob']); ?></td>
                                            <td><?php echo htmlspecialchars($row['gender']); ?></td>
                                            <td><?php echo htmlspecialchars($row['marital_status']); ?></td>
                                            <td><?php echo htmlspecialchars($row['phone_number']); ?></td>
                                            <td><?php echo htmlspecialchars($row['email_address']); ?></td>
                                            <td><?php echo htmlspecialchars($row['job_title']); ?></td>
                                            <td><?php echo htmlspecialchars($row['department']); ?></td>
                                            <td><?php echo htmlspecialchars($row['date_of_hire']); ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="12" class="text-center">No employees found</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>


    <?php include 'footer.php';?> 