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
            case 'Human Resource officers':
                header("Location: departments/human_resource_officers.php");
                break;
            case 'Chief Administrator':
                header("Location: admin/edit_user.php");
                break;
            case 'Director Human Resources and Administration':
                header("Location: departments/director_human_resources_and_administration.php");
                break;
            case 'Deputy Director Human Resources':
                header("Location: departments/deputy_director_human_resources.php");
                break;
            case 'Chief Human Resource Management officer':
                header("Location: departments/chief_human_resource_management_officer.php");
                break;
            case 'Senior Human Resource officers':
                header("Location: departments/senior_human_resource_officers.php");
                break;
            case 'Chief accountant':
                header("Location: departments/chief_accountant.php");
                break;
            case 'Principal accountant':
                header("Location: departments/principal_accountant.php");
                break;
            case 'Senior Accountant':
                header("Location: departments/senior_accountant.php");
                break;
            case 'Accountants':
                header("Location: departments/accountants.php");
                break;
            default:
                header("Location: index.php");
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
