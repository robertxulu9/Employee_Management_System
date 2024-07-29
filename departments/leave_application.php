<?php
require_once '../db.php';

// Fetch employees with leave days greater than 0
$query = "
    SELECT id AS employee_id, CONCAT(first_name, ' ', last_name) AS full_name
    FROM employees 
    WHERE leave_days > 0
";
$result = $conn->query($query);

$employees = [];
while ($row = $result->fetch_assoc()) {
    $employees[] = $row;
}

$conn->close();

?>
    <?php include 'header.php'; ?>

    <div class="container mt-4">
        <h2>Apply for Leave</h2>
        <form id="leaveApplicationForm" action="apply_leave.php" method="post">
            <div class="form-group">
                <label for="employee_id">Select Employee</label>
                <select class="form-control" id="employee_id" name="employee_id" required>
                    <option value="">Select Employee</option>
                    <?php foreach ($employees as $employee): ?>
                        <option value="<?php echo htmlspecialchars($employee['employee_id']); ?>">
                            <?php echo htmlspecialchars($employee['full_name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="leave_days">Number of Leave Days</label>
                <input type="number" class="form-control" id="leave_days" name="leave_days" min="1" required>
                <button type="button" class="btn btn-info mt-2" id="checkLeaveDaysBtn">Check Available Leave Days</button>
                <span id="leaveDaysResult" class="ml-3"></span>
            </div>
            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="date" class="form-control" id="start_date" name="start_date" required>
            </div>
            <button type="submit" class="btn btn-primary">Apply for Leave</button>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('#checkLeaveDaysBtn').click(function() {
                var employeeId = $('#employee_id').val();
                if (employeeId) {
                    $.ajax({
                        url: 'check_leave_days.php',
                        method: 'POST',
                        data: { employee_id: employeeId },
                        success: function(response) {
                            $('#leaveDaysResult').text('Available Leave Days: ' + response);
                            
                            // When user types in leave days, validate it
                            $('#leave_days').on('input', function() {
                                var leaveDaysRequested = parseInt($(this).val(), 10);
                                var availableLeaveDays = parseInt(response, 10);

                                if (leaveDaysRequested > availableLeaveDays) {
                                    // Limit the number of leave days to the available leave days
                                    $(this).val(availableLeaveDays);
                                }
                            });
                        },
                        error: function() {
                            $('#leaveDaysResult').text('Error fetching leave days.');
                        }
                    });
                } else {
                    $('#leaveDaysResult').text('Please select an employee.');
                }
            });
        });
    </script>
    <?php include 'footer.php'; ?>
