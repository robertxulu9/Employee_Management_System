
    <?php include 'header.php'; ?>

    <div class="container mt-5">
        <h2>Add Employee</h2>
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>
        <form action="add_employee_handler.php" method="POST">
            <h4>Basic Information</h4>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="employee_id">Employee ID</label>
                    <input type="text" class="form-control" id="employee_id" name="employee_id" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="first_name">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="middle_name">Middle Name</label>
                    <input type="text" class="form-control" id="middle_name" name="middle_name">
                </div>
                <div class="form-group col-md-6">
                    <label for="dob">Date of Birth</label>
                    <input type="date" class="form-control" id="dob" name="dob" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="gender">Gender</label>
                    <select class="form-control" id="gender" name="gender" required>
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="marital_status">Marital Status</label>
                    <select class="form-control" id="marital_status" name="marital_status" required>
                        <option value="">Select Marital Status</option>
                        <option value="Single">Single</option>
                        <option value="Married">Married</option>
                        <option value="Divorced">Divorced</option>
                        <option value="Widowed">Widowed</option>
                    </select>
                </div>
            </div>
            
            <h4>Contact Information</h4>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="city">City</label>
                    <input type="text" class="form-control" id="city" name="city" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="state">State/Province</label>
                    <input type="text" class="form-control" id="state" name="state" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="postal_code">Postal Code</label>
                    <input type="text" class="form-control" id="postal_code" name="postal_code" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="country">Country</label>
                    <input type="text" class="form-control" id="country" name="country" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="email_address">Email Address</label>
                    <input type="email" class="form-control" id="email_address" name="email_address" required>
                </div>
            </div>

            <h4>Employment Details</h4>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="job_title">Job Title</label>
                    <input type="text" class="form-control" id="job_title" name="job_title" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="department">Department</label>
                    <select class="form-control" id="department" name="department" required>
                        <option value="">Select Department</option>
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
                <div class="form-group col-md-6">
                    <label for="date_of_hire">Date of Hire</label>
                    <input type="date" class="form-control" id="date_of_hire" name="date_of_hire" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="employment_type">Employment Type</label>
                    <select class="form-control" id="employment_type" name="employment_type" required>
                        <option value="">Select Employment Type</option>
                        <option value="Full-time">Full-time</option>
                        <option value="Part-time">Part-time</option>
                        <option value="Contract">Contract</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="work_location">Work Location</label>
                    <input type="text" class="form-control" id="work_location" name="work_location" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="manager_supervisor">Manager/Supervisor</label>
                    <input type="text" class="form-control" id="manager_supervisor" name="manager_supervisor" required>
                </div>
            </div>

            <h4>Compensation and Benefits</h4>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="salary_wage">Salary/Wage</label>
                    <input type="text" class="form-control" id="salary_wage" name="salary_wage" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="pay_frequency">Pay Frequency</label>
                    <select class="form-control" id="pay_frequency" name="pay_frequency" required>
                        <option value="">Select Pay Frequency</option>
                        <option value="Weekly">Weekly</option>
                        <option value="Bi-weekly">Bi-weekly</option>
                        <option value="Monthly">Monthly</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="benefits_enrollment">Benefits Enrollment</label>
                    <textarea class="form-control" id="benefits_enrollment" name="benefits_enrollment" rows="3" required></textarea>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Add Employee</button>
        </form>
    </div>

    <?php include 'footer.php'; ?>
