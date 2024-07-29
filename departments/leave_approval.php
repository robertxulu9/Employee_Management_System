<?php
require_once '../db.php';

// Fetch pending leave applications
$query = "
    SELECT la.id AS application_id, e.id AS employee_id, CONCAT(e.first_name, ' ', e.last_name) AS full_name, la.leave_days_requested, la.leave_status, la.start_date, la.end_date
    FROM leave_application la
    JOIN employees e ON la.employee_id = e.id
    WHERE la.leave_approval = 'Pending'
";
$result = $conn->query($query);

$applications = [];
while ($row = $result->fetch_assoc()) {
    $applications[] = $row;
}

$conn->close();
?>

<?php include 'header.php'; ?>

<div class="container mt-4">
    <h2>Approve Leave Applications</h2>
    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success">Leave application updated successfully.</div>
    <?php endif; ?>
    <form id="leaveApprovalForm" action="approve_leave.php" method="post">
        <table class="table">
            <thead>
                <tr>
                    <th>Employee Name</th>
                    <th>Leave Days Requested</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($applications as $application): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($application['full_name']); ?></td>
                        <td><?php echo htmlspecialchars($application['leave_days_requested']); ?></td>
                        <td><?php echo htmlspecialchars($application['start_date']); ?></td>
                        <td><?php echo htmlspecialchars($application['end_date']); ?></td>
                        <td><?php echo htmlspecialchars($application['leave_status']); ?></td>
                        <td>
                            <form action="approve_leave.php" method="post" style="display: inline;">
                                <input type="hidden" name="application_id" value="<?php echo htmlspecialchars($application['application_id']); ?>">
                                <button type="submit" name="approval_status" value="Approved" class="btn btn-success">Approve</button>
                            </form>
                            <form action="approve_leave.php" method="post" style="display: inline;">
                                <input type="hidden" name="application_id" value="<?php echo htmlspecialchars($application['application_id']); ?>">
                                <button type="submit" name="approval_status" value="Rejected" class="btn btn-danger">Reject</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </form>
</div>

<?php include 'footer.php'; ?>
