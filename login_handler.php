<!-- login_handler.php -->
<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, username, password, department FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $username, $hashed_password, $department);
    $stmt->fetch();

    if ($stmt->num_rows == 1 && password_verify($password, $hashed_password)) {
        $_SESSION['user_id'] = $id;
        $_SESSION['username'] = $username;
        $_SESSION['department'] = $department;

        // Redirect based on department
        switch ($department) {
            case 'Registry clerks':
                header("Location: departments/registry_clerks.php");
                break;
            case 'Chief Administrator':
                header("Location: admin/edit_user.php");
                break;
            case 'Human Resource':
                header("Location: departments/human_resource.php");
                break;
            case 'Accountants':
                header("Location: departments/accountants.php");
                break;
            default:
                header("Location: logout.php");
        }
        exit();
    } else {
        
        // Execute the statement
            if ($stmt->execute()) {
                echo "Invalid username or password";
                echo "<script type='text/javascript'>
                        setTimeout(function() {
                            window.location.href = 'login.php';
                        }, 1000); // 1000 milliseconds = 1 seconds
                    </script>";
            } else {
                echo "Error: " . $stmt->error;
            }
    }

    $stmt->close();
    $conn->close();
}
?>
