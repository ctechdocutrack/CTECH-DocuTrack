
<?php
session_start();
include '../config/dbconn.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../views/login.php");
    exit;
}

// Allow POST requests only
if (isset($_POST['add_faculty'])) {
    // Escape values before using them in SQL
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name'] ?? '');
    $username  = mysqli_real_escape_string($conn, $_POST['username'] ?? '');
    $email     = mysqli_real_escape_string($conn, $_POST['email'] ?? '');
    $password  = $_POST['password'] ?? '';
    $role   = mysqli_real_escape_string($conn, $_POST['role'] ?? '');
    $status = 'active';

    // Check if email already exists
    $sql = "SELECT user_id FROM users WHERE email = '$email' LIMIT 1";
    $sql_run = mysqli_query($conn, $sql);

    if ($sql_run) {
        // Create faculty account
        $sql = "INSERT INTO users (full_name, username, email, password, role, status)
                VALUES ('$full_name', '$username', '$email', '$password', '$role', '$status')";
        $sql_run = mysqli_query($conn, $sql);

        if ($sql_run) {
            header("Location: ../views/profile.php?account=created");
            exit;
        }else {
            header("Location: ../views/profile.php?account=error");
            exit;
        } 
    }else {
        header("Location: ../views/profile.php?account=exists");
        exit;
    }
}else {
    header("Location: ../views/profile.php");
    exit;
}
?>
