<!-- add_user_handler.php -->
<?php
include 'db.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $department = $_POST['department'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO users (username, email, department, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $email, $department, $password);

    // Execute the statement
    if ($stmt->execute()) {
        echo "New user added successfully";
        echo "<script type='text/javascript'>
                setTimeout(function() {
                    window.location.href = 'edit_user.php';
                }, 2000); // 2000 milliseconds = 2 seconds
              </script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
