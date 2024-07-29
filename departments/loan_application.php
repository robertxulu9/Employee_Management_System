<?php
require_once '../db.php';

// Fetch employees excluding those with pending loans
$query = "SELECT e.id, e.first_name, e.last_name
          FROM employees e
          LEFT JOIN loans l ON e.id = l.employee_id AND l.status = 'Pending'
          WHERE l.id IS NULL";

$result = $conn->query($query);

include 'header.php';  // Include the header
?>

<div class="container mt-5">
    <h1>Loan Application Form</h1>
    <form id="loanForm" action="apply_loan.php" method="post">
        <div class="form-group">
            <label for="employee_id">Select Employee:</label>
            <select class="form-control" id="employee_id" name="employee_id" required>
                <option value="">Select Employee</option>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <option value="<?php echo htmlspecialchars($row['id']); ?>"><?php echo htmlspecialchars($row['first_name'] . ' ' . $row['last_name']); ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="loan_amount">Loan Amount:</label>
            <input type="number" class="form-control" id="loan_amount" name="loan_amount" min="100" max="10000" required>
        </div>
        <div class="form-group">
            <label for="payment_method">Payment Method (% of salary per month):</label>
            <input type="range" class="form-control" id="payment_method" name="payment_method" min="50" max="100" step="1" required>
            <span id="payment_method_value">75%</span>
        </div>
        <button type="submit" class="btn btn-primary" id="applyButton">Apply for Loan</button>
    </form>
    <div id="loanStatus" class="mt-3"></div>
</div>


<?php include 'footer.php'; // Include the footer ?>
